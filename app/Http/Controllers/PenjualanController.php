<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Http\Requests\StorePenjualanRequest;
use App\Http\Requests\UpdatePenjualanRequest;
use App\Models\Barang;
use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['penjualan'] = Penjualan::with('user', 'detail_penjualan')->get();
        $data['barang'] = Barang::with('satuan', 'jenis_barang', 'batch')->get();
        return view('penjualan.index')->with($data);
    }

    public function store(StorePenjualanRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            $penjualan = Penjualan::create([
                'kode' => 'PJ' . str_pad(Penjualan::count() + 1, 4, '0', STR_PAD_LEFT),
                'kode_member' => $validated['kode_member'] ?? null,
                'user_id' => Auth::user()->id,
                'total' => 0,
                'tanggal' => now(),
                'keterangan' => 'Telah terjadi transaksi pada tanggal ' . now()->format('Y-m-d') . ' oleh ' . Auth::user()->name,
            ]);

            foreach ($validated['details'] as $items) {
                $batches = Batch::whereIn('kode_barang', array_column($validated['details'], 'kode_barang'))
                    ->orderBy('tanggal_produksi', 'desc')
                    ->get()
                    ->keyBy('kode_barang');

                $penjualan->detail_penjualan()->create([
                    'kode' => $penjualan->kode . ' ' . str_pad($penjualan->detail_penjualan()->count() + 1, 4, '0', STR_PAD_LEFT),
                    'kode_penjualan' => $penjualan->kode,
                    'kode_barang' => $items['kode_barang'],
                    'kode_batch' => $batches[$items['kode_barang']]->kode,
                    'harga_beli' => $items['harga_beli'],
                    'harga_jual' => $items['harga_jual'],
                    'jumlah' => $items['jumlah'],
                    'subtotal' => $items['harga_jual'] * $items['jumlah'],
                ]);

                $batches[$items['kode_barang']]->update([
                    'stok' => $batches[$items['kode_barang']]->stok - $items['jumlah'],
                ]);
            }

            $penjualan->update([
                'total' => $penjualan->detail_penjualan()->sum('subtotal'),
            ]);


            DB::commit();

            return redirect()->back()->with(['success' => 'Penjualan berhasil disimpan.', 'faktur_kode' => $penjualan->kode]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Penjualan gagal: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Penjualan $penjualan)
    {
        //
    }

    public function update(UpdatePenjualanRequest $request, Penjualan $penjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjualan $penjualan)
    {
        //
    }

    public function count()
    {
        $penjualan = Penjualan::selectRaw(
            'DATE(tanggal) as tanggal,
            COUNT(*) as penjualan,
            SUM(total) as pendapatan,
            SUM(
                (SELECT SUM(dp.harga_jual * dp.jumlah) - SUM(dp.harga_beli * dp.jumlah)
                FROM detail_penjualan dp
                WHERE dp.kode_penjualan = penjualan.kode)
            ) as keuntungan'
        )
            ->where('tanggal', '>=', now()->subMonth()) // Ambil data dalam 1 bulan terakhir
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        return response()->json([
            'penjualan' => $penjualan,
            'total_penjualan' => $penjualan->sum('penjualan'),
            'total_pendapatan' => $penjualan->sum('pendapatan'),
            'total_keuntungan' => $penjualan->sum('keuntungan'),
        ]);
    }

    public function laporan(Request $request)
    {
        $tanggal_awal = $request->query('tanggal_awal') ?? now()->subMonth()->format('Y-m-d');
        $tanggal_akhir = $request->query('tanggal_akhir') ?? now()->format('Y-m-d');

        $query = Penjualan::with('user', 'detail_penjualan')
            ->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir])
            ->get();

        $data['penjualan'] = $query;
        $data['barang'] = Barang::with('satuan', 'jenis_barang', 'batch')->get();
        $data['tanggal_awal'] = $tanggal_awal;
        $data['tanggal_akhir'] = $tanggal_akhir;

        return view('laporan.penjualan')->with($data);
    }

    public function faktur($id)
    {
        $data['penjualan'] = Penjualan::with(['detail_penjualan', 'user', 'member'])->find($id);
        return view('penjualan.faktur')->with($data);
    }
}
