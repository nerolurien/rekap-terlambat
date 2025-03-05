<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Data User || Rekam Terlambat';
        $users = User::Where('name', 'like', '%' . $request->search . '%')->orderBy('name', 'asc')->paginate(5);
        return view('user.index', compact('title', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah User || Rekam Terlambat';
        return view('user.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role' => 'required',
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Password wajib diisi',
            'role.required' => 'Role wajib diisi'
        ]);

        $proses = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        if($proses){
            return redirect()->route('user.manage')->with('success', 'Akun Berhasil Ditambahkan');
        }else{
            return redirect()->route('user.create')->with('error', 'Gagal Menambahkan Akun');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        $title = 'Detail User || Rekam Terlambat';
        return view('user.detail', compact('user', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit User || Rekam Terlambat';
        $user = User::find($id);
        return view('user.edit', compact('title', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required',
        ],[
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password wajib diisi',
            'role.required' => 'Role wajib diisi'
        ]);

        $proses = User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        if($proses){
            return redirect()->route('user.manage')->with('success', 'Berhasil Mengubah Data');
        } else{
            return redirect()->route('user.edit')->with('error', 'Gagal Mengubah Data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $user = User::find($id);

        if(!$user){
            return redirect()->route('user.manage')->with('error', 'User Tidak Ditemukan');
        }

        $user->delete();

        return redirect()->route('user.manage')->with('success', 'User Berhasil Dihapus');
    }
}
