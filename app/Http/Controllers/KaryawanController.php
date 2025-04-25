<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Http\Requests\StoreKaryawanRequest;
use App\Http\Requests\UpdateKaryawanRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class KaryawanController extends Controller
{

    /**
     * Menampilkan halaman data karyawan.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data['karyawan'] = Karyawan::with('user', 'absensi_kerja')->get();
        return view('karyawan.index')->with($data);
    }

    /**
     * Menyimpan data karyawan yang baru.
     *
     * @param \App\Http\Requests\StoreKaryawanRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreKaryawanRequest $request)
    {
        $validated = $request->validated();
        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => strtolower($validated['nama_depan'] . $validated['nama_belakang']),
                'email' => $validated['email'],
                'role' => 'Kasir',
                'password' => Hash::make('password'),
            ]);

            $karyawan = Karyawan::create([
                'user_id' => $user->id,
                'nama_depan' => $validated['nama_depan'],
                'nama_belakang' => $validated['nama_belakang'],
                'no_hp' => $validated['no_hp'],
                'email' => $validated['email'],
                'alamat' => $validated['alamat'],
                'tanggal' => $validated['tanggal'],
            ]);

            // dd($karyawan);

            DB::commit();

            return back()->with('success', 'Karyawan berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();

            return back()->with([
                'error' => 'Terjadi kesalahan saat menyimpan karyawan.'
            ]);
        }
    }

    /**
     * Memperbarui data karyawan yang sudah ada.
     *
     * @param UpdateKaryawanRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateKaryawanRequest $request, $id)
    {
        $validated = $request->validated();
        DB::beginTransaction();
        try {
            $karyawan = Karyawan::where('id', $id);

            // dd($validated);

            $karyawan->update([
                'nama_depan' => $validated['nama_depan'],
                'nama_belakang' => $validated['nama_belakang'],
                'no_hp' => $validated['no_hp'],
                'alamat' => $validated['alamat'],
            ]);

            DB::commit();
            return back()->with('success', 'Karyawan berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            return back()->with([
                'error' => 'Terjadi kesalahan saat memperbarui karyawan.'
            ]);
        }
    }

    /**
     * Hapus karyawan yang sudah ada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $karyawan = Karyawan::findOrFail($id);

            if ($karyawan->user->penjualan()->exists() || $karyawan->user->pembelian()->exists()) {
                return back()->with('error', 'Karyawan tidak dapat dihapus karena memiliki relasi dengan tabel lain.');
            }

            $user = $karyawan->user;
            $karyawan->delete();
            $user->delete();
            return back()->with('success', 'Karyawan berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus karyawan.');
        }
    }
}
