<?php

namespace App\Http\Controllers;

use App\Models\Late;
use App\Models\Rayon;
use App\Models\Rombel;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $title = 'Home || Rekam Terlambat';
        $totalAdmin = User::where('role', 'admin')->count();
        $totalPS = User::where('role', 'ps')->count();
        $totalRombel = Rombel::count();
        $totalRayon = Rayon::count();
        $totalSiswa = Student::count();
        $rayonIds = Rayon::where('user_id', Auth::id())->pluck('id');
        $jumlahSiswaPerRayon = Student::whereIn('rayon_id', $rayonIds)->count();
        $namaRayon = Rayon::where('user_id', Auth::id())->value('rayon') ?? '-';
        $jumlahTerlambat = Late::whereHas('student', function ($query) use ($rayonIds) {
            $query->whereIn('rayon_id', $rayonIds);
        })
        ->whereDate('date_time_late', Carbon::today()) // Filter berdasarkan tanggal hari ini
        ->count();


        return view('home', compact('title', 'totalAdmin', 'totalPS', 'totalRombel', 'totalRayon', 'totalSiswa', 'jumlahSiswaPerRayon', 'namaRayon', 'jumlahTerlambat'));
    }
}

