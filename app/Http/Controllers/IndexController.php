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
        $jadwal = DB::table('jadwal')->get()->toArray();
        $getPembina = DB::table('ukm')
                        ->join('pembinaview', 'ukm.pembina_id', '=', 'pembinaview.id')
                        ->join('jadwal', 'ukm.id', '=', 'jadwal.ukm_id')
                        ->select('pembinaview.nama')
                        ->get()->toArray();

        $getPelatih = DB::table('ukm')
                        ->join('pelatihview', 'ukm.pelatih_id', '=', 'pelatihview.id')
                        ->join('jadwal', 'ukm.id', '=', 'jadwal.ukm_id')
                        ->select('pelatihview.nama', 'ukm.pelatih_id')
                        ->get()->toArray();
        $getKetuamhs = DB::table('ukm')
                        ->join('ketuamhsview', 'ukm.ketuamhs_id', '=', 'ketuamhsview.id')
                        ->join('jadwal', 'ukm.id', '=', 'jadwal.ukm_id')
                        ->select('ketuamhsview.nama', 'ukm.nama_ukm')
                        ->get()->toArray();


        $results = array();
        foreach($jadwal as $key=>$data){
            $array=array();
            $array['id'] = $data->id;
            $array['nama_ukm'] = $getKetuamhs[$key]->nama_ukm;
            $array['waktu_mulai'] = $data->waktu_mulai;
            $array['waktu_selesai'] = $data->waktu_selesai;
            $array['hari'] = $data->hari;
            $array['tempat'] = $data->tempat;
            if (empty($getPelatih[$key])) {
                $array['pelatih'] = "-";
            } else {
                $array['pelatih_id'] = $getPelatih[$key]->pelatih_id;
                $array['pelatih'] = $getPelatih[$key]->nama;
            }
            $array['ketuamhs'] = $getKetuamhs[$key]->nama;
            if (empty($getPembina[$key])) {
                $array['pembina'] = "-";
            } else {
                $array['pembina'] = $getPembina[$key]->nama;
            }
            $results[] = $array;
        }
            
            return view('jadwal', ['results'=>$results]);
            
        // $jadwal = Jadwal::all();
        // return view('jadwal', compact('jadwal'));
    }
}
