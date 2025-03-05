<?php

namespace App\Http\Controllers;

use App\Exports\KeterlambatanExport;
use App\Exports\LateExport;
use App\Exports\SiswaPerRayonExport;
use App\Models\Late;
use App\Models\Rayon;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PembimbingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Data Siswa || Rekam Terlambat';

        // Ambil ID semua rayon yang dipegang oleh user
        $rayonIds = Rayon::where('user_id', Auth::id())->pluck('id');

        // Query siswa berdasarkan rayon yang dipegang oleh user
        $query = Student::whereIn('rayon_id', $rayonIds);

        // Jika ada pencarian, tambahkan filter berdasarkan nama
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%$search%");
        }

        // Paginate hasilnya
        $siswa = $query->paginate(5);

        return view('ps.siswa.index', compact('title', 'siswa'));
    }
    public function indexTerlambat(Request $request)
    {
        $title = 'Data Terlambat || Rekam Terlambat';

        $rayonIds = Rayon::where('user_id', Auth::id())->pluck('id');

        $latesQuery = Late::whereHas('student', function ($q) use ($rayonIds, $request) {
                $q->whereIn('rayon_id', $rayonIds);
                if ($request->has('search')) {
                    $q->where('name', 'like', '%' . $request->search . '%');
                }
            })
            ->with(['student' => function ($query) {
                $query->select('id', 'name', 'rombel_id', 'rayon_id');
            }])
            ->orderBy('date_time_late', 'desc');

        $lates = $latesQuery->paginate(5);

        $rekap = Late::whereHas('student', function ($q) use ($rayonIds, $request) {
                $q->whereIn('rayon_id', $rayonIds);
                if ($request->has('search')) {
                    $q->where('name', 'like', '%' . $request->search . '%');
                }
            })
            ->select('student_id', DB::raw('COUNT(*) as total_late'))
            ->groupBy('student_id')
            ->with('student:id,name')
            ->get();

        return view('ps.terlambat.index', compact('title', 'lates', 'rekap'));
    }

    public function show(string $id)
    {
        $title = 'Detail Terlambat || Rekam Terlambat';

        $terlambat = Late::with('student')->where('student_id', $id)->orderBy('date_time_late', 'asc')->get();

        if ($terlambat->isEmpty()) {
            return redirect()->route('terlambat.index')->with('error', 'Data keterlambatan tidak ditemukan.');
        }

        return view('ps.terlambat.detail', compact('title', 'terlambat'));
    }

    public function generatePDF($id){
        $student = Late::with('student')
            ->where('student_id', $id)
            ->first();

        if (!$student) {
            return abort(404, 'Data tidak ditemukan.');
        }

        $data = [
            'title' => 'SURAT PERNYATAAN',
            'date' => now()->format('d F Y'),
            'student' => $student->student,
            'late_count' => 3 // Atau ambil dari query
        ];

        $pdf = Pdf::loadView('terlambat.surat_pernyataan', $data);
        return $pdf->download('surat_pernyataan.pdf');
    }

    public function exportSiswaPerRayon()
    {
        return Excel::download(new SiswaPerRayonExport, 'Siswa_Per_Rayon.xlsx');
    }
}
