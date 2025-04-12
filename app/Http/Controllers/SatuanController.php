<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use App\Http\Requests\StoreSatuanRequest;
use App\Http\Requests\UpdateSatuanRequest;

class SatuanController extends Controller
{
    public function index()
    {
        $data['satuan'] = Satuan::all();
        return view('satuan.index')->with($data);
    }

    public function store(StoreSatuanRequest $request)
    {
        $validated = $request->validated();

        try {
            Satuan::create([
                'nama' => $validated['nama']
            ]);

            return back()->with('success', 'Satuan berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Terjadi kesalahan saat menambahkan satuan.');
        }
    }

    public function update(UpdateSatuanRequest $request, $id)
    {
        $validated = $request->validated();

        try {
            Satuan::where('id', $id)->update([
                'nama' => $validated['nama']
            ]);

            return back()->with('success', 'Satuan berhasil diperbarui.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui satuan.');
        }
    }

    public function destroy($id)
    {
        $satuan = Satuan::with('barang')->where('id', $id)->first();

        if ($satuan->barang()->exists()) {
            return back()->with('error', 'Satuan tidak dapat dihapus karena memiliki relasi dengan data lain.');
        }

        try {
            $satuan->delete();
            return back()->with('success', 'Satuan berhasil dihapus');
        } catch (\Throwable $th) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus satuan.');
        }
    }
}
