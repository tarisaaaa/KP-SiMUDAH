<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index() 
    {
        $sql = "SELECT a.ukm_id,p.nama,u.nama_ukm,count(*) as jumlah_absensi 
                FROM absensi as a 
                JOIN ukm as u ON a.ukm_id = u.id 
                JOIN pelatihview as p ON u.pelatih_id = p.id
                WHERE MONTH(a.created_at) = MONTH(CURRENT_DATE()) AND YEAR(a.created_at) = YEAR(CURRENT_DATE())
                GROUP BY a.ukm_id,u.nama_ukm";
        $data = DB::select($sql);
        // dd($data);
        return view('laporan.index', compact('data'));
    }

    public function show($id) 
    {
        $sql = "SELECT a.ukm_id,p.nama,u.nama_ukm,count(*) as jumlah_absensi 
                FROM absensi as a 
                JOIN ukm as u ON a.ukm_id = u.id 
                JOIN pelatihview as p ON u.pelatih_id = p.id
                WHERE MONTH(a.created_at) = MONTH(CURRENT_DATE()) AND YEAR(a.created_at) = YEAR(CURRENT_DATE()) AND a.ukm_id = $id
                GROUP BY a.ukm_id,u.nama_ukm";
        $data = collect(DB::select($sql))->first();
        // dd($data);
        return view('laporan.show', compact('data'));
    }
}
