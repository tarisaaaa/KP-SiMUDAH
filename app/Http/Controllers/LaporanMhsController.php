<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

class LaporanMhsController extends Controller
{
    public function index() 
    {
        $sql = "SELECT DISTINCT YEAR(a.created_at) as tahun, MONTH(a.created_at) as bulan, u.nama_ukm, u.id as id_ukm
                FROM absensi as a
                INNER JOIN ukm as u ON a.ukm_id = u.id";
        $data = DB::select($sql);
        // dd($data);
        return view('laporanmhs.index', compact('data'));
    }

    public function show($id_ukm, $tahun, $bulan) 
    {
        $sql = "SELECT u.nama_ukm, ag.nama_anggota, COUNT(*) as jumlah_absensi
                FROM absensi as a
                INNER JOIN absensi_detail as ad ON a.id = ad.absensi_id
                INNER JOIN anggota as ag ON ad.anggota_id = ag.id
                INNER JOIN ukm as u ON a.ukm_id = u.id
                WHERE ad.status_absen = 'H' AND u.id = $id_ukm
                AND  MONTH(a.created_at) = $bulan
                AND YEAR(a.created_at) = $tahun
                GROUP BY u.nama_ukm, ag.nama_anggota";
        $query = DB::select($sql);
        
        $sql2 = "SELECT count(*)  as jumlah_latihan, u.nama_ukm
                FROM absensi as a 
                JOIN ukm as u ON a.ukm_id = u.id 
                WHERE u.id = $id_ukm
                AND  MONTH(a.created_at) = $bulan
                AND YEAR(a.created_at) = $tahun
                GROUP BY a.ukm_id";
        $query2 = DB::selectOne($sql2);
        
        return view('laporanmhs.show', compact('query', 'query2', 'id_ukm', 'bulan', 'tahun'));
    }

    public function exportPDF($id_ukm, $tahun, $bulan) {
        $sql = "SELECT u.nama_ukm, ag.nama_anggota, COUNT(*) as jumlah_absensi
                FROM absensi as a
                INNER JOIN absensi_detail as ad ON a.id = ad.absensi_id
                INNER JOIN anggota as ag ON ad.anggota_id = ag.id
                INNER JOIN ukm as u ON a.ukm_id = u.id
                WHERE ad.status_absen = 'H' AND u.id = $id_ukm
                AND  MONTH(a.created_at) = $bulan
                AND YEAR(a.created_at) = $tahun
                GROUP BY u.nama_ukm, ag.nama_anggota";
        $query = DB::select($sql);
        
        $sql2 = "SELECT count(*)  as jumlah_latihan, u.nama_ukm
                FROM absensi as a 
                JOIN ukm as u ON a.ukm_id = u.id 
                WHERE u.id = $id_ukm
                AND  MONTH(a.created_at) = $bulan
                AND YEAR(a.created_at) = $tahun
                GROUP BY a.ukm_id";
        $query2 = DB::selectOne($sql2);
        
        // $pdf = PDF::loadview('laporanmhs.laporan-pdf', compact('query', 'query2', 'bulan', 'tahun'))->setPaper('A4','potrait');
	// return $pdf->stream('laporanmahasiswa'.$id_ukm. '-'. $bulan. $tahun. '.pdf');
        return view('laporanmhs.laporan-pdf', compact('query', 'query2', 'bulan', 'tahun'));
    }
}
