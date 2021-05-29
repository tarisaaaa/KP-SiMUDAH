<?php

namespace App\Http\Controllers;

use App\Pengumuman;
use App\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::latest()->paginate(2);
        
        return view('index', compact('pengumuman'));
    }

    public function jadwal()
    {
        $jadwal = Jadwal::all();
        return view('jadwal', compact('jadwal'));
    }
}
