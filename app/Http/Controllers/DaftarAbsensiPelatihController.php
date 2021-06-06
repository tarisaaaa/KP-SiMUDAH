<?php

namespace App\Http\Controllers;

use App\Laporan;
use App\Ukm;
use Illuminate\Http\Request;

class DaftarAbsensiPelatihController extends Controller
{
    public function index() {
        $id = session('user')->id;
        $p = Ukm::where('pelatih_id', '=', $id)->get();
        if ($p->isEmpty()) {
            $listukm = Ukm::where('pelatih_id', 'like', '%' .$id. '%')->get();
        } else {
            $listukm = $p;
        }
        return view ('daftarabsensipelatih.index', compact('listukm'));
    }

    public function show($id) {
        $idpelatih = session('user')->id;
        $absen = Laporan::where('ukm_id', $id)->where('pelatih_id', $idpelatih)->get();
        $data = Ukm::where('id', $id)->first();
        $totalhadir = Laporan::where('ukm_id', $id)->where('pelatih_id', $idpelatih)->where('kehadiran', 'Hadir')->count();
        $totalabsen = Laporan::where('ukm_id', $id)->where('pelatih_id', $idpelatih)->count();
        if ($totalabsen != 0) {
            $persentase = $totalhadir / $totalabsen * 100;
        } else {
            $persentase = 0;
        }
        return view('daftarabsensipelatih.show', compact('absen', 'data', 'persentase'));
    }
}
