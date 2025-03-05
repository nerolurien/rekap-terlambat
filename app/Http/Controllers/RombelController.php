<?php

namespace App\Http\Controllers;

use App\Models\Rombel;
use Illuminate\Http\Request;

class RombelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Data Rombel || Rekam Terlambat';
        $rombel = Rombel::Where('rombel', 'like', '%' . $request->search . '%')->orderBy('rombel', 'asc')->paginate(5);
        return view('rombel.index', compact('title', 'rombel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Rombel || Rekam Terlambat';
        return view('rombel.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rombel' => 'required',
        ], [
            'rombel.required' => 'Rombel Wajib Diisi',
        ]);

        $proses = Rombel::create([
            'rombel' => $request->rombel,
        ]);

        if($proses){
            return redirect()->route('rombel.manage')->with('success', 'Data Berhasil Ditambahkan');
        }else{
            return redirect()->route('rombel.create')->with('error', 'Gagal Menambahkan Data');
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
        $title = 'Edit Rombel || Rekam Terlambat';
        $rombel = Rombel::find($id);
        return view('rombel.edit', compact('title', 'rombel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'rombel' => 'required',
        ], [
            'rombel.required' => 'Rombel Wajib Diisi',
        ]);

        $proses = Rombel::find($id)->update([
            'rombel' => $request->rombel,
        ]);

        if($proses){
            return redirect()->route('rombel.manage')->with('success', 'Data Berhasil Diubah');
        }else{
            return redirect()->route('rombel.edit', $id)->with('error', 'Gagal Mengubah Data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $rombel = Rombel::find($id);

        if(!$rombel){
            return redirect()->route('rombel.manage')->with('error', 'Rombel Tidak Ditemukan');
        }

        $rombel->delete();

        return redirect()->route('rombel.manage')->with('success', 'Rombel Berhasil Dihapus');
    }
}
