<?php

namespace App\Http\Controllers;

use App\Models\JenisMember;
use App\Http\Requests\StoreJenisMemberRequest;
use App\Http\Requests\UpdateJenisMemberRequest;

class JenisMemberController extends Controller
{
    /**
     * Menampilkan data jenis member beserta relasinya dengan member
     */
    public function index()
    {
        $data['jenisMember'] = JenisMember::with('member')->get();
        return view('jenis_member.index')->with($data);
    }

    /**
     * Menyimpan data jenis member yang baru
     */
    public function store(StoreJenisMemberRequest $request)
    {
        $validated = $request->validated();

        try {
            $kode = 'JM' . str_pad(JenisMember::count() + 1, 3, '0', STR_PAD_LEFT);

            JenisMember::create([
                'kode' => $kode,
                'nama' => $validated['nama'],
                // 'min_pembelian' => $validated['min_pembelian'],
                // 'diskon' => $validated['diskon'],
            ]);

            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    /**
     * Menampilkan data jenis member berdasarkan ID
     */
    public function show($id)
    {
        return response()->json(JenisMember::where('kode', $id)->first());
    }

    /**
     * Memperbarui data jenis member yang sudah ada
     */
    public function update(UpdateJenisMemberRequest $request, $id)
    {
        $validated = $request->validated();

        try {
            JenisMember::where('kode', $id)->update([
                'nama' => $validated['nama'],
                // 'min_pembelian' => $validated['min_pembelian'],
                // 'diskon' => $validated['diskon'],
            ]);

            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * Menghapus data jenis member yang sudah ada
     */
    public function destroy($id)
    {
        $jenisMember = JenisMember::with('member')->where('kode', $id)->first();

        if ($jenisMember->member()->exists()) {
            return redirect()->back()->with('error', 'Data tidak dapat dihapus karena memiliki relasi dengan data lain');
        }

        try {
            $jenisMember->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data');
        }
    }
}
