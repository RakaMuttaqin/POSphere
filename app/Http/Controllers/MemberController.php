<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\JenisMember;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['member'] = Member::with('jenis_member')->get();
        $data['jenisMember'] = JenisMember::with('member')->get();
        return view('member.index')->with($data);
    }

    public function store(StoreMemberRequest $request)
    {
        $validated = $request->validated();

        try {
            $kode = 'MB' . str_pad(Member::count() + 1, 4, '0', STR_PAD_LEFT);
            Member::create([
                'kode' => $kode,
                'nama' => $validated['nama'],
                'kode_jenis_member' => $validated['jenis_member'],
                'no_hp' => $validated['no_hp'],
                'email' => $validated['email'],
                'alamat' => $validated['alamat'],
                'tanggal_bergabung' => now(),
            ]);

            return back()->with('success', 'Member berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menambahkan member.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $query = Member::query();

        if ($request->has('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('no_hp', 'like', '%' . $request->search . '%');
        }

        $member = $query->with('jenis_member')->get();

        return response()->json($member);
    }

    public function update(UpdateMemberRequest $request, $id)
    {
        $validated = $request->validated();

        try {
            Member::where('kode', $id)->update([
                'nama' => $validated['nama'],
                'kode_jenis_member' => $validated['kode_jenis_member'],
                'no_hp' => $validated['no_hp'],
                'email' => $validated['email'],
                'alamat' => $validated['alamat'],
            ]);

            return back()->with('success', 'Member berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui member.');
        }
    }

    public function destroy($id)
    {
        $member = Member::with('penjualan')->where('kode', $id)->first();

        if ($member->penjualan()->exists()) {
            return back()->with('error', 'Member tidak dapat dihapus karena memiliki relasi dengan data lain.');
        }

        try {
            $member->delete();
            return back()->with('success', 'Member berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus member.');
        }
    }
}
