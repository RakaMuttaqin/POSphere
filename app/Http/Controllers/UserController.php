<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'role' => ['required', 'string', 'max:255'],
            ]);

            User::create($validated);

            return back()->with("success", "User berhasil ditambahkan");
        } catch (\Exception $e) {
            return back()->with("error", "Terjadi kesalahan saat menambahkan user");
        }
    }

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

    public function destroy($id)
    {
        try {
            User::where('id', $id)->delete();
            return back()->with("success", "User berhasil dihapus");
        } catch (\Exception $e) {
            return back()->with("error", "Terjadi kesalahan saat menghapus user");
        }
    }

    public function profile()
    {
        //
    }

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
