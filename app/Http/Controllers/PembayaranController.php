<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Http\Requests\StorePembayaranRequest;
use App\Http\Requests\UpdatePembayaranRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PembayaranController extends Controller
{
    /**
     * Menampilkan halaman daftar pembayaran
     */
    public function index()
    {
        try {
            // Dapatkan data pembayaran untuk laporan
            $data['pembayaran'] = Pembayaran::all();

            // Kembalikan tampilan dengan data pembayaran
            return view('pembayaran.index')->with($data);
        } catch (\Exception $e) {
            // Tangani error dan catat di log
            Log::error('Error fetching pembayaran data: ' . $e->getMessage());

            // Redirect ke halaman error atau tampilkan pesan error
            return redirect()->route('error.page')->with('error', 'Terjadi kesalahan saat mengambil data pembayaran.');
        }
    }


    /**
     * Menampilkan data pembayaran berdasarkan parameter yang diberikan
     * @param \Illuminate\Http\Request $request
     */
    public function show(Request $request)
    {
        try {
            $data = Pembayaran::orderBy('tanggal', 'desc');

            // Filtering berdasarkan tanggal periode
            if ($request->from_date && $request->to_date) {
                $data = $data->whereBetween('tanggal', [$request->from_date, $request->to_date]);
            }

            // Searching berdasarkan kode, nama pemasok, nama user, dan keterangan
            if ($request->search) {
                $data = $data->where(function ($query) use ($request) {
                    $query->where('kode', 'like', '%' . $request->search . '%')
                        ->orWhere('pemasok.nama', 'like', '%' . $request->search . '%')
                        ->orWhere('user.name', 'like', '%' . $request->search . '%')
                        ->orWhere('keterangan', 'like', '%' . $request->search . '%');
                });
            }

            $data = $data->get();

            // Kembalikan response dalam format JSON
            return response()->json($data);
        } catch (\Exception $e) {
            // Tangani error dan catat di log
            Log::error('Error fetching pembayaran data: ' . $e->getMessage());

            // Redirect ke halaman error atau tampilkan pesan error
            return response()->json(['error' => 'Terjadi kesalahan saat mengambil data pembayaran.'], 422);
        }
    }
}
