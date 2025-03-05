<?php

namespace App\Http\Controllers;

use App\Models\Rayon;
use App\Models\User;
use Illuminate\Http\Request;

class RayonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Data Rayon || Rekam Terlambat';
        $rayon = Rayon::Where('rayon', 'like', '%' . $request->search . '%')->orderBy('rayon', 'asc')->paginate(5);
        return view('rayon.index', compact('title', 'rayon'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Rayon || Rekam Terlambat';
        $pembimbingSiswa = User::where('role', 'ps')->get();
        return view('rayon.create', compact('title', 'pembimbingSiswa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rayon' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id', // Validasi agar ID valid
        ],[
            'rayon.required' => 'Rayon harus diisi',
            'rayon.max' => 'Rayon tidak boleh lebih dari 255 karakter',
            'user_id.required' => 'Pembimbing Siswa harus dipilih',
            'user_id.exists' => 'Pembimbing Siswa tidak ditemukan',
            
        ]);

        Rayon::create([
            'rayon' => $request->rayon,
            'user_id' => $request->user_id, // Pastikan ini dikirim
        ]);

        return redirect()->route('rayon.index')->with('success', 'Rayon berhasil ditambahkan!');
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
        $title = 'Edit Rayon || Rekam Terlambat';
        $rayon = Rayon::findOrFail($id); // Akan menampilkan 404 jika data tidak ditemukan
        $pembimbingSiswa = User::where('role', 'ps')->get(); // Ambil hanya user dengan role PS


        return view('rayon.edit', compact('title', 'rayon', 'pembimbingSiswa'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'rayon' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id', // Validasi agar ID valid
        ],[
            'rayon.required' => 'Rayon tidak boleh kosong',
            'user_id.required' => 'Pembimbing Siswa tidak boleh kosong',
        ]);

        $proses = Rayon::find($id)->update([
            'rayon' => $request->rayon,
            'user_id' => $request->user_id, // Pastikan ini dikirim
        ]);

        if($proses){
            return redirect()->route('rayon.index')->with('success', 'Data Berhasil Diubah');
        }else{
            return redirect()->route('rayon.edit', $id)->with('error', 'Gagal Mengubah Data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $rayon = Rayon::find($id);

        if(!$rayon){
            return redirect()->route('rayon.index')->with('error', 'Rayon Tidak Ditemukan');
        }

        $rayon->delete();

        return redirect()->route('rayon.index')->with('success', 'Rayon Berhasil Dihapus');
    }
}
