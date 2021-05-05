<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade as PDF;

class LaporanController extends Controller
{
    public function index() 
    {
        $sql = "SELECT DISTINCT YEAR(a.created_at) as tahun, MONTH(a.created_at) as bulan 
                FROM absensi as a ";
        $data = DB::select($sql);
        // dd($data);
        return view('laporan.index', compact('data'));
    }

    public function show($tahun, $bulan) 
    {
        $sql = "SELECT a.ukm_id,p.nama,u.nama_ukm,count(*) as jumlah_absensi 
                FROM absensi as a 
                JOIN ukm as u ON a.ukm_id = u.id 
                JOIN pelatihview as p ON u.pelatih_id = p.id
                WHERE MONTH(a.created_at) = $bulan 
                AND YEAR(a.created_at) = $tahun
                AND u.pelatih_id IS NOT NULL
                AND a.kehadiran_pelatih = 'Hadir'
                GROUP BY a.ukm_id,u.nama_ukm";
        $query = DB::select($sql);

        $sql2 = "SELECT count(*)  as jumlah_latihan
                FROM absensi as a 
                JOIN ukm as u ON a.ukm_id = u.id 
                WHERE MONTH(a.created_at) = $bulan
                AND YEAR(a.created_at) = $tahun
                AND u.pelatih_id IS NOT NULL
                GROUP BY a.ukm_id";
        $query2 = DB::select($sql2);

        $results = array();
        foreach($query as $key=>$data){
            $array=array();
            $array['ukm_id'] = $data->ukm_id;
            $array['nama_ukm'] = $data->nama_ukm;
            $array['nama'] = $data->nama;
            $array['jumlah_absensi'] = $data->jumlah_absensi;
            $array['jumlah_latihan'] = $query2[$key]->jumlah_latihan;
            $results[] = $array;
        }
        // dd($results);
        
        // $pdf = PDF::loadview('laporan.show',['data'=>$data])->setPaper('A4','potrait');
	    // return $pdf->stream();
        return view('laporan.show', compact('results', 'bulan', 'tahun'));
    }

    public function exportPDF($tahun, $bulan)
    {
        $sql = "SELECT a.ukm_id,p.nama,u.nama_ukm,count(*) as jumlah_absensi 
                FROM absensi as a 
                JOIN ukm as u ON a.ukm_id = u.id 
                JOIN pelatihview as p ON u.pelatih_id = p.id
                WHERE MONTH(a.created_at) = $bulan 
                AND YEAR(a.created_at) = $tahun
                AND u.pelatih_id IS NOT NULL
                AND a.kehadiran_pelatih = 'Hadir'
                GROUP BY a.ukm_id,u.nama_ukm";
        $query = DB::select($sql);

        $sql2 = "SELECT count(*)  as jumlah_latihan
                FROM absensi as a 
                JOIN ukm as u ON a.ukm_id = u.id 
                WHERE MONTH(a.created_at) = $bulan
                AND YEAR(a.created_at) = $tahun
                AND u.pelatih_id IS NOT NULL
                GROUP BY a.ukm_id";
        $query2 = DB::select($sql2);

        $results = array();
        foreach($query as $key=>$data){
            $array=array();
            $array['ukm_id'] = $data->ukm_id;
            $array['nama_ukm'] = $data->nama_ukm;
            $array['nama'] = $data->nama;
            $array['jumlah_absensi'] = $data->jumlah_absensi;
            $array['jumlah_latihan'] = $query2[$key]->jumlah_latihan;
            $results[] = $array;
        }
        // $pdf = PDF::loadview('laporan.laporan-pdf', compact('results', 'bulan', 'tahun'))->setPaper('A4','potrait');
        // return $pdf->stream('laporanpelatih'. $bulan. $tahun. '.pdf');
        return view('laporan.laporan-pdf', compact('results', 'bulan', 'tahun'));
    }
}
