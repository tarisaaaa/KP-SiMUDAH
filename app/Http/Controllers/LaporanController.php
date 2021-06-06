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
use Carbon\Carbon;

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
        // 
    }

    public function store(Request $request) {
        $date1 = Carbon::parse($request->tanggalmulai)->format('Y-m-d');
        $date2 = Carbon::parse($request->tanggalselesai)->format('Y-m-d');

        $records = DB::table('laporan')
                        ->join('absensi', 'absensi.id', '=', 'laporan.absensi_id')
                        ->join('users', 'users.id', '=', 'laporan.pelatih_id')
                        ->join('ukm', 'ukm.id', '=', 'laporan.ukm_id')
                        ->whereBetween('absensi.created_at', [$date1, $date2])
                        ->where('laporan.kehadiran', '=', 'Hadir')
                        ->where('users.status_user', '=', 'Aktif')
                        ->select('laporan.ukm_id', 'ukm.nama_ukm', 'users.nama', (DB::raw('count(*) as jumlah_absensi')))
                        ->groupBy('laporan.pelatih_id')
                        ->get();
        // dd($records);
        return view ('laporan.show', compact('records', 'date1', 'date2'));
    }

    public function exportPDF($date1, $date2)
    {
        $records = DB::table('laporan')
                        ->join('absensi', 'absensi.id', '=', 'laporan.absensi_id')
                        ->join('users', 'users.id', '=', 'laporan.pelatih_id')
                        ->join('ukm', 'ukm.id', '=', 'laporan.ukm_id')
                        ->whereBetween('absensi.created_at', [$date1, $date2])
                        ->where('laporan.kehadiran', '=', 'Hadir')
                        ->where('users.status_user', '=', 'Aktif')
                        ->select('laporan.ukm_id', 'ukm.nama_ukm', 'users.nama', (DB::raw('count(*) as jumlah_absensi')))
                        ->groupBy('laporan.pelatih_id')
                        ->get();

        // $pdf = PDF::loadview('laporan.laporan-pdf', compact('results', 'bulan', 'tahun'))->setPaper('A4','potrait');
        // return $pdf->stream('laporanpelatih'. $bulan. $tahun. '.pdf');
        return view('laporan.laporan-pdf', compact('records', 'date1', 'date2'));
    }
}
