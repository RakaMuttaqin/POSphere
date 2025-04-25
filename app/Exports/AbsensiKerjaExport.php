<?php

namespace App\Exports;

use App\Models\AbsensiKerja;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AbsensiKerjaExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return AbsensiKerja::select(
            'id',
            'nama_karyawan',
            'tanggal_masuk',
            'waktu_masuk',
            'status',
            'waktu_selesai_kerja'
        )->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'nama_karyawan',
            'tanggal_masuk',
            'waktu_masuk',
            'status',
            'waktu_selesai_kerja',
        ];
    }
}
