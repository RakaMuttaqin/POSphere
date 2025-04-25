<?php

namespace App\Http\Controllers;

use App\Exports\PengajuanBarangExport;
use App\Models\PengajuanBarang;
use App\Http\Requests\StorePengajuanBarangRequest;
use App\Http\Requests\UpdatePengajuanBarangRequest;
use App\Models\Member;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PengajuanBarangController extends Controller
{
    /**
     * Menampilkan halaman daftar pengajuan barang.
     */
    public function index()
    {
        $data['pengajuanBarang'] = PengajuanBarang::with('member')->get();
        $data['member'] = Member::all();
        return view('pengajuan_barang.index')->with($data);
    }

    /**
     * Menyimpan data pengajuan barang yang baru.
     */
    public function store(StorePengajuanBarangRequest $request)
    {
        $validated = $request->validated();

        try {
            $pengajuanBarang = PengajuanBarang::create([
                'kode_pengajuan' => 'PJB' . str_pad(PengajuanBarang::count() + 1, 4, '0', STR_PAD_LEFT),
                'kode_member' => $validated['kode_member'],
                'nama_barang' => $validated['nama_barang'],
                'tanggal_pengajuan' => date('Y-m-d'),
                'qty' => $validated['qty'],
                'status' => '0',
            ]);

            return back()->with('success', 'Pengajuan barang berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menambahkan pengajuan barang.');
        }
    }

    /**
     * Memperbarui data pengajuan barang yang sudah ada.
     */
    public function update(UpdatePengajuanBarangRequest $request, $id)
    {
        $validated = $request->validated();

        try {
            $pengajuanBarang = PengajuanBarang::where('kode_pengajuan', $id)->update([
                'kode_member' => $validated['kode_member'],
                'nama_barang' => $validated['nama_barang'],
                'qty' => $validated['qty'],
            ]);

            return back()->with('success', 'Pengajuan barang berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui pengajuan barang.');
        }
    }

    /**
     * Memperbarui status pengajuan barang.
     */
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'in:0,1',
        ]);

        try {
            $pengajuanBarang = PengajuanBarang::where('kode_pengajuan', $id)->update([
                'status' => $validated['status'],
            ]);

            return back()->with('success', 'Status pengajuan barang berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui status pengajuan barang.' . $e->getMessage());
        }
    }

    /**
     * Menghapus data pengajuan barang yang sudah ada.
     */
    public function destroy($id)
    {
        try {
            PengajuanBarang::where('kode_pengajuan', $id)->delete();
            return back()->with('success', 'Pengajuan barang berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus pengajuan barang.');
        }
    }

    /**
     * Mengekspor data pengajuan barang ke dalam format Excel.
     */
    public function export()
    {
        return Excel::download(new PengajuanBarangExport, 'pengajuan_barang.xlsx');
    }

    /**
     * Membuat PDF dari data pengajuan barang.
     */
    public function generatePDF()
    {
        // Ambil data barang dari database
        $data = PengajuanBarang::with('member')->get();

        // Load view untuk PDF dengan data barang
        $pdf = Pdf::loadView('exports.pengajuan_barang', compact('data'));

        // Unduh PDF
        return $pdf->download('barang.pdf');
    }
}
