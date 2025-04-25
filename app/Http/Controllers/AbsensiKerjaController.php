<?php

namespace App\Http\Controllers;

use App\Exports\AbsensiKerjaExport;
use App\Exports\FormatAbsensiKerjaExport;
use App\Models\AbsensiKerja;
use App\Http\Requests\StoreAbsensiKerjaRequest;
use App\Http\Requests\UpdateAbsensiKerjaRequest;
use App\Imports\AbsensiKerjaImport;
use App\Models\Karyawan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiKerjaController extends Controller
{

    /**
     * Menampilkan halaman data absensi kerja.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data['absensi'] = AbsensiKerja::with('karyawan')->get();
        $data['karyawan'] = Karyawan::with('absensi_kerja')->get();
        return view('absensi_kerja.index')->with($data);
    }


    /**
     * Menyimpan data absensi kerja yang baru.
     *
     * @param  \App\Http\Requests\StoreAbsensiKerjaRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreAbsensiKerjaRequest $request)
    {
        $validated = $request->validated();

        try {
            if ($validated['status'] == 'cuti' || $validated['status'] == 'sakit') {
                $waktu_masuk = '00:00:00';
                $waktu_selesai_kerja = '00:00:00';
            } else {
                $waktu_masuk = now()->format('H:i:s');
                $waktu_selesai_kerja = '00:00:00';
            }

            AbsensiKerja::create([
                'karyawan_id' => $validated['karyawan_id'],
                'tanggal_masuk' => $validated['tanggal_masuk'],
                'waktu_masuk' => $waktu_masuk,
                'status' => $validated['status'],
                'waktu_selesai_kerja' => $waktu_selesai_kerja,
            ]);

            return back()->with('success', 'Absensi berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with([
                'error' => 'Terjadi kesalahan saat menyimpan absensi.'
            ]);
        }
    }

    public function show($id)
    {
        //
    }

    /**
     * Memperbarui data absensi yang sudah ada.
     *
     * @param  \App\Http\Requests\UpdateAbsensiKerjaRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateAbsensiKerjaRequest $request, $id)
    {
        $validated = $request->validated();
        // dd($validated);

        try {
            AbsensiKerja::where('id', $id)->update([
                'karyawan_id' => $validated['karyawan_id'],
                'tanggal_masuk' => $validated['tanggal_masuk'],
            ]);

            return back()->with('success', 'Absensi berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with([
                'error' => 'Terjadi kesalahan saat memperbarui absensi.'
            ]);
        }
    }


    /**
     * Memperbarui status absensi yang sudah ada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            if ($request->status == 'cuti' || $request->status == 'sakit') {
                $waktu_masuk = '00:00:00';
                $waktu_selesai_kerja = '00:00:00';
            } else {
                $waktu_masuk = now()->format('H:i:s');
                $waktu_selesai_kerja = '00:00:00';
            }

            AbsensiKerja::where('id', $id)->update([
                'status' => $request->status,
                'waktu_masuk' => $waktu_masuk,
                'waktu_selesai_kerja' => $waktu_selesai_kerja
            ]);

            return back()->with('success', 'Status absensi berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with([
                'error' => 'Terjadi kesalahan saat memperbarui status absensi.'
            ]);
        }
    }


    /**
     * Memperbarui status absensi menjadi selesai.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSelesai(Request $request, $id)
    {
        try {
            AbsensiKerja::where('id', $id)->update([
                'waktu_selesai_kerja' => now()->format('H:i:s')
            ]);

            return back()->with('success', 'Status absensi berhasil diperbarui.');
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            return back()->with([
                'error' => 'Terjadi kesalahan saat memperbarui status absensi.'
            ]);
        }
    }

    /**
     * Menghapus data absensi kerja yang sudah ada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function destroy($id)
    {
        try {
            AbsensiKerja::where('id', $id)->delete();
            return back()->with('success', 'Absensi berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus absensi.');
        }
    }

    /**
     * Mengimpor data absensi kerja dari file Excel.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Maatwebsite\Excel\Validators\ValidationException
     */

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new AbsensiKerjaImport, $request->file('file'));

        return back()->with(['success' => 'Import berhasil!']);
    }

    /**
     * Mengunduh data absensi kerja dalam format PDF.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportPDF()
    {
        $data = AbsensiKerja::all();

        $pdf = Pdf::loadView('exports.absensi_kerja', compact('data'));
        return $pdf->download('absensi_kerja_' . date('Y-m-d') . '.pdf');
    }

    /**
     * Mengunduh data absensi kerja dalam format Excel.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportExcel()
    {
        return Excel::download(new AbsensiKerjaExport, 'absensi_kerja_' . date('Y-m-d') . '.xlsx');
    }


    /**
     * Mengunduh format import absensi kerja dalam format Excel.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function formatImport()
    {
        return Excel::download(new FormatAbsensiKerjaExport, 'format_absensi_kerja.xlsx');
    }
}
