<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Http\Requests\StorePembelianRequest;
use App\Http\Requests\UpdatePembelianRequest;
use App\Models\Barang;
use App\Models\Batch;
use App\Models\DetailPembelian;
use App\Models\Pemasok;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    /**
     * Menampilkan daftar data pembelian
     */
    public function index()
    {
        $data['pembelian'] = Pembelian::with('user', 'pemasok', 'detail_pembelian')->get();
        $data['pemasok'] = Pemasok::all();
        $data['barang'] = Barang::all();
        return view('pembelian.index')->with($data);
    }

    /**
     * Menyimpan data pembelian baru ke dalam basis data
     */
    public function store(StorePembelianRequest $request)
    {
        $validated = $request->validated(); // Validasi data
        DB::beginTransaction(); // Mulai transaksi database

        try {
            // Generate kode pembelian otomatis
            $kode = 'PB' . str_pad(Pembelian::count() + 1, 4, '0', STR_PAD_LEFT);

            // Simpan data pembelian
            $pembelian = Pembelian::create([
                'kode' => $kode,
                'user_id' => Auth::user()->id,
                'pemasok_id' => $validated['pemasok_id'],
                'total' => 0,
                'tanggal_terima' => $validated['tanggal_terima'],
                'tanggal_masuk' => now(),
                'keterangan' => $validated['keterangan'] ?? null,
            ]);

            $total_pembelian = 0; // Variabel untuk menghitung total pembelian

            // Loop untuk menyimpan detail pembelian
            foreach ($validated['details'] as $items) {
                $subtotal = $items['harga_beli'] * $items['jumlah']; // Hitung subtotal
                $total_pembelian += $subtotal; // Tambahkan ke total pembelian

                $detailPembelian = DetailPembelian::create([
                    'kode' => $pembelian->kode . ' ' . str_pad(DetailPembelian::count() + 1, 3, '0', STR_PAD_LEFT),
                    'kode_pembelian' => $pembelian->kode,
                    'kode_barang' => $items['kode_barang'],
                    'jumlah' => $items['jumlah'],
                    'harga_beli' => $items['harga_beli'],
                    'harga_jual' => $items['harga_jual'],
                    'subtotal' => $subtotal,
                ]);

                // Perbarui harga barang di database
                $barang = Barang::where('kode', $items['kode_barang'])->update([
                    'harga_beli' => $items['harga_beli'],
                    'harga_jual' => $items['harga_jual']
                ]);

                Batch::create([
                    'kode' => 'BATCH' . str_pad(Batch::count() + 1, 4, '0', STR_PAD_LEFT),
                    'kode_barang' => $detailPembelian->kode_barang,
                    'tanggal_produksi' => now(),
                    'stok' => $detailPembelian->jumlah,
                    'tanggal_expired' => $items['tanggal_expired'],
                ]);
            }

            // Update total pembelian di database
            $pembelian->update([
                'total' => $total_pembelian
            ]);

            DB::commit(); // Simpan transaksi

            return back()->with('success', 'Pembelian berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan transaksi jika terjadi kesalahan
            return back()->with('error', 'Terjadi kesalahan saat menambahkan pembelian: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan detail pembelian berdasarkan ID
     */
    public function detail($id)
    {
        $data = Pembelian::with('user', 'pemasok', 'detail_pembelian', 'detail_pembelian.barang', 'detail_pembelian.barang.batch')
            ->where('kode', $id)
            ->first();

        return response()->json($data);
    }
}
