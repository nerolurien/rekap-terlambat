<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LateExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Student::with('rombel', 'rayon')
            ->withCount('lates') // Menghitung jumlah keterlambatan
            ->get();
    }

    public function headings(): array
    {
        return ['NIS', 'Nama', 'Rombel', 'Rayon', 'Total Keterlambatan'];
    }

    public function map($student): array
    {
        return [
            $student->nis,
            $student->name,
            $student->rombel->rombel ?? '-',
            $student->rayon->rayon ?? '-',
            $student->lates_count // Menggunakan count dari relasi
        ];
    }
}

