<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Http\Requests\StorePenjualanRequest;
use App\Http\Requests\UpdatePenjualanRequest;
use App\Models\Barang;
use App\Models\Batch;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

class PenjualanController extends Controller
{
    /**
     * Fungsi ini menampilkan daftar sumber daya.
     */
    public function index()
    {
        $data['penjualan'] = Penjualan::with('user', 'detail_penjualan')->get();
        $data['barang'] = Barang::with('satuan', 'jenis_barang', 'batch')->get();
        return view('penjualan.index')->with($data);
    }

    /**
     * Fungsi ini menyimpan data penjualan baru ke dalam basis data, termasuk
     * detail penjualan, pembaruan stok, dan pembayaran. Setelah itu, mencetak
     * faktur penjualan menggunakan printer POS.
     *
     * @param  \App\Http\Requests\StorePenjualanRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

            $jumlah_bayar = $validated['jumlah_bayar'];
            if ($penjualan->kode_member) {
                $diskon = $penjualan->member->jenis_member->diskon;
                $penjualan->update(['total' => $penjualan->total - ($penjualan->total * $diskon / 100)]);
            }
            if ($jumlah_bayar > $penjualan->total) {
                $kembalian = $jumlah_bayar - $penjualan->total;
                $penjualan->pembayaran()->create([
                    'kode' => $penjualan->kode . ' ' . str_pad($penjualan->pembayaran()->count() + 1, 4, '0', STR_PAD_LEFT),
                    'kode_penjualan' => $penjualan->kode,
                    'total_bayar' => $jumlah_bayar,
                    'kembalian' => $kembalian,
                    'metode_pembayaran' => 'Cash',
                    'tanggal_bayar' => now(),
                ]);
            }

            try {
                $connector = new WindowsPrintConnector("POS-58");
                $printer = new Printer($connector);

                // Header toko
                $printer->setJustification(Printer::JUSTIFY_CENTER);
                $printer->text("POSPHERE\n");
                $printer->text("Jl. Bambu\n");
                $printer->text("Kota Bandung\n");
                $printer->text("Telp. 022-2222222\n");
                $printer->text("------------------------------\n");
                $printer->text("FAKTUR PENJUALAN\n");
                $printer->text("------------------------------\n");

                // Info transaksi
                $printer->setJustification(Printer::JUSTIFY_LEFT);
                $printer->text("Kode      : " . $penjualan->kode . "\n");
                $printer->text("Tanggal   : " . now()->format('Y-m-d') . "\n");
                $printer->text("Kasir     : " . Auth::user()->name . "\n");
                $printer->text("Metode    : " . $penjualan->pembayaran->first()->metode_pembayaran . "\n");
                $printer->text("------------------------------\n");

                // Detail barang
                foreach ($penjualan->detail_penjualan as $detail) {
                    $nama = $detail->barang->nama;
                    $jumlah = $detail->jumlah;
                    $harga = number_format($detail->harga_jual, 0, ',', '.');
                    $subtotal = number_format($detail->subtotal, 0, ',', '.');

                    // Nama Barang (maks 32 karakter biar nggak kepotong)
                    $printer->text(substr($nama, 0, 32) . "\n");

                    // Format: 2x12000        24.000
                    $left = $jumlah . " x " . $harga;
                    $right = $subtotal;
                    $printer->text(str_pad($left, 20) . str_pad("Rp" . $right, 12, ' ', STR_PAD_LEFT) . "\n");
                }

                $printer->text("------------------------------\n");

                // Total pembayaran
                $total = number_format($penjualan->total, 0, ',', '.');
                $bayar = number_format($validated['jumlah_bayar'], 0, ',', '.');
                $kembali = number_format($penjualan->pembayaran->first()->kembalian, 0, ',', '.');

                $printer->setEmphasis(true);
                $printer->setJustification(Printer::JUSTIFY_RIGHT);
                $printer->text("TOTAL      : Rp" . $total . "\n");
                $printer->text("BAYAR      : Rp" . $bayar . "\n");
                $printer->text("KEMBALIAN  : Rp" . $kembali . "\n");
                $printer->setEmphasis(false);

                $printer->text("------------------------------\n");
                $printer->setJustification(Printer::JUSTIFY_CENTER);
                $printer->text("~ TERIMA KASIH ~\n");
                $printer->text("Barang yang sudah dibeli\n");
                $printer->text("tidak dapat dikembalikan.\n");

                $printer->pulse();
                $printer->cut();
                $printer->close();
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
                return back()->with('error', 'Penjualan gagal: ' . $th->getMessage());
            }

            DB::commit();
            return redirect()->back()->with(['success' => 'Penjualan berhasil disimpan.', 'faktur_kode' => $penjualan->kode]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Penjualan gagal: ' . $e->getMessage());
        }
    }

    /**
     * Menghitung jumlah penjualan, pendapatan, dan keuntungan perhari
     * dalam 1 bulan terakhir.
     *
     * Fungsi ini digunakan untuk membuat laporan penjualan
     * di halaman dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function count(Request $request)
    {
        // Ambil tanggal dari query param, default ke awal dan akhir bulan ini
        $tanggal_awal = $request->query('tanggal_awal') ?? now()->startOfMonth()->format('Y-m-d');
        $tanggal_akhir = $request->query('tanggal_akhir') ?? now()->endOfMonth()->format('Y-m-d');

        // Ambil data penjualan harian beserta total & keuntungan
        $penjualan = Penjualan::selectRaw("
            DATE(tanggal) as tanggal,
            COUNT(*) as penjualan,
            SUM(total) as pendapatan,
            SUM((
                SELECT SUM(dp.harga_jual * dp.jumlah) - SUM(dp.harga_beli * dp.jumlah)
                FROM detail_penjualan dp
                WHERE dp.kode_penjualan = penjualan.kode
            )) as keuntungan
        ")
            ->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir])
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        // Balikin response dalam format JSON
        return response()->json([
            'penjualan'         => $penjualan,
            'total_penjualan'   => $penjualan->sum('penjualan'),
            'total_pendapatan'  => $penjualan->sum('pendapatan'),
            'total_keuntungan'  => $penjualan->sum('keuntungan'),
        ]);
    }

    /**
     * Menampilkan laporan penjualan dalam rentang tanggal tertentu.
     * Fungsi ini digunakan untuk membuat laporan penjualan
     * di halaman laporan.
     *
     * @param  \Illuminate\Http\Request  $request
     */
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

    /**
     * Menampilkan detail penjualan berdasarkan kode penjualan.
     *
     * Fungsi ini digunakan untuk menampilkan detail penjualan
     * di halaman laporan.
     *
     * @param  string  $id Kode penjualan
     */
    public function detail($id)
    {
        try {
            $penjualan = Penjualan::with('user', 'detail_penjualan.barang.satuan', 'detail_penjualan.barang.jenis_barang', 'member', 'pembayaran')->where('kode', $id)->firstOrFail();

            return response()->json($penjualan);
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Data penjualan tidak ditemukan');
        }
    }

    private function getDiskon($totalPembelian): array
    {
        $kelipatan = $totalPembelian / 20000;
        $poin = $kelipatan;

        $diskon = $kelipatan * 2;

        $totalAkhir = $totalPembelian - $diskon;

        return [
            'total' => $totalPembelian,
            'poin' => $poin,
            'diskon' => $diskon,
            'total_akhir' => $totalAkhir,
        ];
    }
}
