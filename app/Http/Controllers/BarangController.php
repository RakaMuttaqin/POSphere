<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\Models\JenisBarang;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $data['barang'] = Barang::with('jenis_barang', 'satuan')->get();
        $data['jenisBarang'] = JenisBarang::all();
        $data['satuan'] = Satuan::all();

        return view('barang.index')->with($data);
    }

    public function store(StoreBarangRequest $request)
    {
        $validated = $request->validated();

        try {
            $kode = 'BR' . str_pad(Barang::count() + 1, 4, '0', STR_PAD_LEFT);

            $namaGambar = null;
            if ($request->hasFile('gambar')) {
                $gambar = $request->file('gambar');
                $tanggal = date('YmdHis');
                $namaGambar = $tanggal . '_' . $gambar->getClientOriginalName();
                $gambar->storeAs('gambar', $namaGambar, 'public');
            }
            // dd($namaGambar);


            $barang = Barang::create([
                'kode' => $kode,
                'kode_jenis_barang' => $validated['kode_jenis_barang'],
                'barcode' => $validated['barcode'],
                'nama' => $validated['nama'],
                'satuan_id' => $validated['satuan_id'],
                'gambar' => $namaGambar,
                'harga_beli' => 0,
                'harga_jual' => 0,
            ]);

            return back()->with('success', 'Barang berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menambahkan barang.');
        }
    }

    public function update(UpdateBarangRequest $request, $id)
    {
        $validated = $request->validated();

        try {
            $barang = Barang::where('kode', $id)->first();

            // Update data barang (kecuali gambar)
            $barang->fill([
                'kode_jenis_barang' => $validated['kode_jenis_barang'],
                'barcode' => $validated['barcode'],
                'nama' => $validated['nama'],
                'satuan_id' => $validated['satuan_id'],
                'harga_beli' => $validated['harga_beli'],
                'harga_jual' => $validated['harga_jual'],
            ])->save();

            // Jika ada gambar baru yang diupload
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama jika ada
                if ($barang->gambar) {
                    Storage::disk('public')->delete('gambar/' . $barang->gambar);
                }

                // Simpan gambar baru
                $gambar = $request->file('gambar');
                $namaGambar = now()->format('YmdHis') . '_' . $gambar->getClientOriginalName();
                $gambar->storeAs('gambar', $namaGambar, 'public');

                // Update nama gambar di database
                $barang->update(['gambar' => $namaGambar]);
            }

            return back()->with('success', 'Barang berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui barang.');
        }
    }

    public function destroy($id)
    {
        $barang = Barang::with('detail_penjualan', 'detail_pembelian')->where('kode', $id)->first();

        if ($barang->detail_penjualan()->exists() || $barang->detail_pembelian()->exists()) {
            return back()->with('error', 'Barang tidak dapat dihapus karena memiliki relasi dengan data lain.');
        }

        try {
            $barang->delete();
            return back()->with('success', 'Barang berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus barang.');
        }
    }

    public function list(Request $request)
    {
        $query = Barang::whereHas('detail_pembelian')
            ->whereHas('batch');

        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                    ->orWhere('kode', 'like', '%' . $request->search . '%')
                    ->orWhere('barcode', 'like', '%' . $request->search . '%');
            });
        }

        $data = $query->with('jenis_barang', 'satuan', 'batch')->get();
        return response()->json($data);
    }
}
