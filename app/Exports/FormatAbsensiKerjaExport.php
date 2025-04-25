<?php

namespace App\Exports;

use App\Models\AbsensiKerja;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FormatAbsensiKerjaExport implements WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
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
