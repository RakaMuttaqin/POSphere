<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Menampilkan daftar pengguna.
     */

    public function index()
    {
        $data['users'] = User::all();
        return view('users.index')->with($data);
    }

    /**
     * Menyimpan data pengguna baru ke dalam basis data.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'role' => ['required', 'string', 'max:255'],
            ]);

            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make('password'),
                'role' => $validated['role'],
            ]);

            return back()->with("success", "User berhasil ditambahkan");
        } catch (\Exception $e) {
            return back()->with("error", "Terjadi kesalahan saat menambahkan user");
        }
    }

    /**
     * Memperbarui data pengguna yang sudah ada.
     */
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'role' => ['required', 'string', 'max:255'],
            ]);

            User::where('id', $id)->update($validated);

            return back()->with("success", "User berhasil diubah");
        } catch (\Exception $e) {
            return back()->with("error", "Terjadi kesalahan saat mengubah user");
        }
    }

    /**
     * Menghapus data pengguna dari basis data.
     */
    public function destroy($id)
    {
        try {
            User::where('id', $id)->delete();
            return back()->with("success", "User berhasil dihapus");
        } catch (\Exception $e) {
            return back()->with("error", "Terjadi kesalahan saat menghapus user");
        }
    }

    /**
     * Menampilkan profil pengguna yang sedang login.
     */
    public function profile()
    {
        //
    }

    /**
     * Mengubah nama pengguna yang sedang login.
     */
    public function changeUsername(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
            ]);

            User::where('id', Auth::user()->id)->update($validated);

            return back()->with("success", "Username anda berhasil diubah");
        } catch (\Exception $e) {
            return back()->with("error", "Terjadi kesalahan saat mengubah username");
        }
    }

    /**
     * Mengubah password pengguna yang sedang login.
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'confirmed'],
        ]);

        if (! Hash::check($request->current_password, Auth::user()->password)) {
            return back()->with("error", "Password yang anda masukkan salah");
        }

        User::where('id', Auth::user()->id)->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with("success", "Password anda berhasil diubah");
    }
}
