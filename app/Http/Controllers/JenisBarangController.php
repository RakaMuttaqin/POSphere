<?php

namespace App\Http\Controllers;

use App\Models\JenisBarang;
use App\Http\Requests\StoreJenisBarangRequest;
use App\Http\Requests\UpdateJenisBarangRequest;

class JenisBarangController extends Controller
{
    public function index()
    {
        $data['jenisBarang'] = JenisBarang::all();
        return view('jenis_barang.index')->with($data);
    }

    public function store(StoreJenisBarangRequest $request)
    {
        $validated = $request->validated();

        try {
            $kode = 'JB' . str_pad(JenisBarang::count() + 1, 3, '0', STR_PAD_LEFT);

            JenisBarang::create([
                'kode' => $kode,
                'nama' => ucwords($validated['nama']),
            ]);

            return back()->with('success', 'Jenis barang berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with([
                'error' => 'Terjadi kesalahan saat menyimpan jenis barang.'
            ]);
        }
    }

    public function update(UpdateJenisBarangRequest $request, $id)
    {
        $validated = $request->validated();

        try {
            JenisBarang::where('kode', $id)->update([
                'nama' => ucwords($validated['nama']),
            ]);

            return back()->with('success', 'Jenis barang berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with([
                'error' => 'Terjadi kesalahan saat memperbarui jenis barang.'
            ]);
        }
    }

    public function destroy($id)
    {
        $jenisBarang = JenisBarang::where('kode', $id)->first();

        if ($jenisBarang->barang()->exists()) {
            return back()->with('error', 'Jenis barang tidak dapat dihapus karena memiliki relasi dengan data lain.');
        }

        try {
            $jenisBarang->delete();
            return back()->with('success', 'Jenis barang berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus jenis barang.');
        }
    }
}
