<?php

namespace App\Http\Controllers;

use App\Models\Rayon;
use App\Models\Rombel;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Data Siswa || Rekam Terlambat';
        $siswa = Student::Where('name', 'like', '%' . $request->search . '%')->orderBy('name', 'asc')->paginate(5);
        return view('siswa.index', compact('title', 'siswa'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Siswa || Rekam Terlambat';
        $rombel = Rombel::all();
        $rayon = Rayon::all();
        return view('siswa.create', compact('title', 'rombel', 'rayon'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'rombel_id' => 'required',
            'rayon_id' => 'required',
            'nis' => 'required',
        ],[
            'name.required' => 'Nama wajib diisi',
            'rombel_id.required' => 'Rombel wajib diisi',
            'rayon_id.required' => 'Rayon wajib diisi',
            'nis.required' => 'NIS wajib diisi',
        ]);

        $proses = Student::create([
            'name' => $request->name,
            'rombel_id' => $request->rombel_id,
            'rayon_id' => $request->rayon_id,
            'nis' => $request->nis,
        ]);

        if($proses){
            return redirect()->route('siswa.index')->with('success', 'Data Berhasil Ditambahkan');
        }else{
            return redirect()->route('siswa.create')->with('error', 'Gagal Menambahkan Data');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Siswa || Rekam Terlambat';
        $siswa = Student::find($id);
        $rombel = Rombel::all();
        $rayon = Rayon::all();
        return view('siswa.edit', compact('title', 'siswa', 'rombel', 'rayon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'rombel_id' => 'required',
            'rayon_id' => 'required',
            'nis' => 'required',
        ],[
            'name.required' => 'Nama wajib diisi',
            'rombel_id.required' => 'Rombel wajib diisi',
            'rayon_id.required' => 'Rayon wajib diisi',
            'nis.required' => 'NIS wajib diisi',
        ]);

        $proses = Student::find($id)->update([
            'name' => $request->name,
            'rombel_id' => $request->rombel_id,
            'rayon_id' => $request->rayon_id,
            'nis' => $request->nis,
        ]);

        if($proses){
            return redirect()->route('siswa.index')->with('success', 'Data Berhasil Diupdate');
        }else{
            return redirect()->route('siswa.edit', $id)->with('error', 'Gagal Mengupdate Data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $siswa = Student::find($id);

        if(!$siswa){
            return redirect()->route('siswa.index')->with('error', 'Siswa Tidak Ditemukan');
        }

        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Berhasil Menghapus Data');
    }
}
