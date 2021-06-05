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
                    ->join('absensi', 'absensi.id', '=', 'laporan.absensi_id')
                    ->select([DB::raw('YEAR(absensi.created_at) as tahun, MONTH(absensi.created_at) as bulan')])
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
                JOIN absensi ON absensi.id = laporan.absensi_id
                WHERE YEAR(absensi.created_at) = $tahun
                AND MONTH(absensi.created_at) = $bulan
                AND laporan.kehadiran = 'Hadir'
                AND users.status_user = 'Aktif'
                GROUP BY laporan.pelatih_id";
        $query = DB::select($sql);
        
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
                JOIN absensi ON absensi.id = laporan.absensi_id
                WHERE YEAR(absensi.created_at) = $tahun
                AND MONTH(absensi.created_at) = $bulan
                AND laporan.kehadiran = 'Hadir'
                AND users.status_user = 'Aktif'
                GROUP BY laporan.pelatih_id";
        $query = DB::select($sql);

        // $pdf = PDF::loadview('laporan.laporan-pdf', compact('results', 'bulan', 'tahun'))->setPaper('A4','potrait');
        // return $pdf->stream('laporanpelatih'. $bulan. $tahun. '.pdf');
        return view('laporan.laporan-pdf', compact('query', 'bulan', 'tahun'));
    }
}
