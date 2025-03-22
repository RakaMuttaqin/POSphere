<?php

namespace App\Http\Controllers;

use App\Models\JenisMember;
use App\Http\Requests\StoreJenisMemberRequest;
use App\Http\Requests\UpdateJenisMemberRequest;

class JenisMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['jenisMember'] = JenisMember::with('member')->get();
        return view('jenis_member.index')->with($data);
    }

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

    public function show(JenisMember $jenisMember)
    {
        //
    }

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
