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

    public function adminkeuangan() {
        return response()->download('buku_panduan/BukuPanduanAdminKeuangan.pdf');
    }

    public function ketuamahasiswa() {
        return response()->download('buku_panduan/BukuPanduanKetuaMahasiswa.pdf');
    }

    public function pembina() {
        return response()->download('buku_panduan/BukuPanduanPembina.pdf');
    }

    public function pelatih() {
        return response()->download('buku_panduan/BukuPanduanPelatih.pdf');
    }

    public function wakilrektoriii() {
        return response()->download('buku_panduan/BukuPanduanWRIII.pdf');
    }
}
