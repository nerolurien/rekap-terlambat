<?php

namespace App\Http\Controllers;

use App\Exports\LateExport;
use App\Models\Late;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class TerlambatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    $title = 'Data Terlambat || Rekam Terlambat';

    // Query untuk rekapitulasi jumlah keterlambatan per siswa (termasuk filter pencarian)
    $rekap = Late::select('student_id', DB::raw('COUNT(*) as total_late'))
        ->with('student') // Eager loading untuk relasi student
        ->when($request->search, function ($query) use ($request) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        })
        ->groupBy('student_id')
        ->get();

    // Query untuk daftar keterlambatan individu
    $late = Late::with('student')
        ->when($request->search, function ($query) use ($request) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        })
        ->orderBy('date_time_late', 'desc')
        ->paginate(10);

    return view('terlambat.index', compact('title', 'late', 'rekap'));
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Terlambat || Rekam Terlambat';
        $siswa = Student::all();
        return view('terlambat.create', compact('title', 'siswa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'date_time_late' => 'required',
            'information' => 'required',
            'bukti' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'student_id.required' => 'Nama Siswa tidak boleh kosong',
            'date_time_late.required' => 'Tanggal dan Waktu tidak boleh kosong',
            'information.required' => 'Informasi tidak boleh kosong',
            'bukti.required' => 'Bukti tidak boleh kosong',
            'bukti.image' => 'Bukti harus berupa gambar',
            'bukti.mimes' => 'Bukti harus berupa gambar',
            'bukti.max' => 'Bukti maksimal 2MB',
        ]);

        if ($request->hasFile('bukti')) {
            $path = $request->file('bukti')->store('bukti', 'public'); // Simpan ke storage/app/public/bukti
        } else {
            $path = null;
        }
        Late::create([
            'student_id' => $request->student_id,
            'date_time_late' => $request->date_time_late,
            'information' => $request->information,
            'bukti' => $path,
        ]);

        return redirect()->route('terlambat.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Detail Terlambat || Rekam Terlambat';

        // Cari keterlambatan berdasarkan student_id
        $terlambat = Late::with('student')->where('student_id', $id)->orderBy('date_time_late', 'asc')->get();

        if ($terlambat->isEmpty()) {
            return redirect()->route('terlambat.index')->with('error', 'Data keterlambatan tidak ditemukan.');
        }

        return view('terlambat.detail', compact('title', 'terlambat'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Terlambat || Rekam Terlambat';
        $late = Late::find($id);
        $siswa = Student::all();
        return view('terlambat.edit', compact('title', 'late', 'siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'student_id' => 'required',
            'date_time_late' => 'required',
            'information' => 'required',
        ], [
            'student_id.required' => 'Nama Siswa tidak boleh kosong',
            'date_time_late.required' => 'Tanggal dan Waktu tidak boleh kosong',
            'information.required' => 'Informasi tidak boleh kosong',
        ]);

        $late = Late::findOrFail($id); // Gunakan findOrFail untuk error handling jika ID tidak ditemukan

        // Cek apakah ada file bukti yang diupload
        if ($request->hasFile('bukti')) {
            $path = $request->file('bukti')->store('bukti', 'public'); // Simpan ke storage/app/public/bukti
            $late->bukti = $path; // Update hanya jika ada file baru
        }

        // Update data lainnya
        $late->update([
            'student_id' => $request->student_id,
            'date_time_late' => $request->date_time_late,
            'information' => $request->information,
        ]);

        return redirect()->route('terlambat.index')->with('success', 'Data Berhasil Diubah');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $late = Late::find($id);
        $late->delete();
        return redirect()->route('terlambat.index')->with('success', 'Data Berhasil Dihapus');
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

    public function export()
{
    return Excel::download(new LateExport, 'rekap_keterlambatan.xlsx');
}

}
