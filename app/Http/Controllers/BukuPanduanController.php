<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BukuPanduanController extends Controller
{
    public function index() {
        return view('bukupanduan');
    }

    public function adminaplikasi() {
        return response()->download('buku_panduan/BukuPanduanAdminAplikasi.pdf');
    }

    public function pembina() {
        return response()->download('buku_panduan/BukuPanduanPembina.pdf');
    }
}
