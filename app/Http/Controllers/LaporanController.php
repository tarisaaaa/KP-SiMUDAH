<?php

namespace App\Http\Controllers;

use App\Absensi;
use App\Laporan;
use App\Ukm;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade as PDF;

class LaporanController extends Controller
{
    public function index() 
    {
        $data = DB::table('laporan')
                    ->select([DB::raw('YEAR(created_at) as tahun, MONTH(created_at) as bulan')])
                    // ->distinct()
                    ->groupBy(['bulan', 'tahun'])
                    ->paginate(10);

        return view('laporan.index', compact('data'));
    }

    public function show($tahun, $bulan) 
    {
        $sql = "SELECT users.nama, laporan.ukm_id, ukm.nama_ukm, COUNT(*) as jumlah_absensi
                FROM laporan
                JOIN users ON users.id = laporan.pelatih_id
                JOIN ukm ON ukm.id = laporan.ukm_id
                WHERE YEAR(laporan.created_at) = 2021
                AND MONTH(laporan.created_at) = 5
                AND laporan.kehadiran = 'Hadir'
                AND users.status_user = 'Aktif'
                GROUP BY laporan.pelatih_id";
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
        return view('laporan.show', compact('query', 'bulan', 'tahun'));
    }

    public function exportPDF($tahun, $bulan)
    {
        $sql = "SELECT users.nama, laporan.ukm_id, ukm.nama_ukm, COUNT(*) as jumlah_absensi
                FROM laporan
                JOIN users ON users.id = laporan.pelatih_id
                JOIN ukm ON ukm.id = laporan.ukm_id
                WHERE YEAR(laporan.created_at) = 2021
                AND MONTH(laporan.created_at) = 5
                AND laporan.kehadiran = 'Hadir'
                AND users.status_user = 'Aktif'
                GROUP BY laporan.pelatih_id";

        $query = DB::select($sql);

        // $pdf = PDF::loadview('laporan.laporan-pdf', compact('results', 'bulan', 'tahun'))->setPaper('A4','potrait');
        // return $pdf->stream('laporanpelatih'. $bulan. $tahun. '.pdf');
        return view('laporan.laporan-pdf', compact('query', 'bulan', 'tahun'));
    }
}
