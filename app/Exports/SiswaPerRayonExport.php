<?php

namespace App\Exports;

use App\Models\Late;
use App\Models\Student;
use App\Models\Rayon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaPerRayonExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Ambil rayon yang dipegang oleh PS yang login
        $rayonIds = Rayon::where('user_id', Auth::id())->pluck('id');

        // Ambil siswa sesuai rayon PS
        return Student::whereIn('rayon_id', $rayonIds)
            ->with(['rombel', 'rayon'])
            ->get()
            ->map(function ($student) {
                return [
                    'nis' => $student->nis,
                    'nama' => $student->name,
                    'rombel' => $student->rombel->rombel ?? '-',
                    'rayon' => $student->rayon->rayon ?? '-',
                    'total_keterlambatan' => Late::where('student_id', $student->id)->count(),
                ];
            });
    }

    public function headings(): array
    {
        return ["NIS", "Nama", "Rombel", "Rayon", "Total Keterlambatan"];
    }
}

