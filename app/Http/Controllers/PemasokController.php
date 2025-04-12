<?php

namespace App\Http\Controllers;

use App\Models\Pemasok;
use App\Http\Requests\StorePemasokRequest;
use App\Http\Requests\UpdatePemasokRequest;

class PemasokController extends Controller
{
    public function index()
    {
        $data['pemasok'] = Pemasok::all();
        return view('pemasok.index')->with($data);
    }

    public function store(StorePemasokRequest $request)
    {
        $validated = $request->validated();

        try {
            Pemasok::create([
                'nama' => $validated['nama'],
                'email' => $validated['email'],
                'no_hp' => $validated['no_hp'],
                'alamat' => $validated['alamat'],
            ]);

            return back()->with('success', 'Pemasok berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menambahkan pemasok.');
        }
    }

    public function update(UpdatePemasokRequest $request, $id)
    {
        $validated = $request->validated();

        try {
            Pemasok::where('id', $id)->update([
                'nama' => $validated['nama'],
                'email' => $validated['email'],
                'no_hp' => $validated['no_hp'],
                'alamat' => $validated['alamat'],
            ]);

            return back()->with('success', 'Pemasok berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui pemasok.');
        }
    }

    public function destroy($id)
    {
        $pemasok = Pemasok::with('pembelian')->where('id', $id)->first();

        if ($pemasok->pembelian()->exists()) {
            return back()->with('error', 'Pemasok tidak dapat dihapus karena memiliki relasi dengan data lain.');
        }

        try {
            $pemasok->delete();
            return back()->with('success', 'Pemasok berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus pemasok.');
        }
    }
}
