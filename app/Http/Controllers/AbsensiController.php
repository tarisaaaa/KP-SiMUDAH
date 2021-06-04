<?php

namespace App\Http\Controllers;

use App\Absensi;
use App\AbsensiDetail;
use App\Laporan;
use App\Ukm;
use App\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = session('user')->id;
        $absensi = Ukm::where('pelatih_id', $id)->orWhere('ketuamhs_id', $id)->get();
        return view('absensi.index', compact('absensi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $pelatih_ids = Ukm::where('id', $id)->select('pelatih_id')->first();
        $pelatih = DB::table('ukm')->join('pelatihview', 'ukm.pelatih_id', '=', 'pelatihview.id')->where('ukm.id', $id)->select('pelatihview.id','pelatihview.nama')->first();
        $ukm = DB::table('ukm')->where('id', $id)->select('id', 'nama_ukm', 'pelatih_id')->first();   
        $anggota = DB::table('anggota')->where('ukm_id', $id)->where('status', '=', 'Aktif')->select('id','nama_anggota')->get();
        $jam = DB::table('jadwal')->where('ukm_id', $id)->first();
        $jam_mulai = Carbon::createFromFormat('H:i:s', $jam->waktu_mulai)->format('H:i');
        $jam_selesai = Carbon::createFromFormat('H:i:s', $jam->waktu_selesai)->format('H:i');
        
        // dd($pelatih_ids);
        return view('absensi.create', compact('ukm', 'anggota', 'pelatih', 'jam_mulai', 'jam_selesai', 'pelatih_ids'))->with('no', 1);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function inputabsensi(Request $request)
    {
        if(!empty($request->kehadiran_pelatih)) {
            if (count(explode(',', $request->pelatih_id)) > 1) {
                $pelatih = json_decode($request->pelatih_id);
                foreach($pelatih as $idpelatih) {
                    $laporan = new Laporan;
                    $laporan->ukm_id = $request->ukm_id;
                    $laporan->pelatih_id = $idpelatih;
                    $laporan->kehadiran = $request->kehadiran_pelatih[$idpelatih];
                    $laporan->save();
                }
            } else {
                $laporan = new Laporan;
                $laporan->ukm_id = $request->ukm_id;
                $laporan->pelatih_id = $request->pelatih_id;
                $laporan->kehadiran = $request->kehadiran_pelatih;
                $laporan->save();
            }
        }

        $absensi = new Absensi;
        $absensi->ukm_id = $request->ukm_id;
        $absensi->user_id = Session::get('user')->id;
        $absensi->keterangan = $request->keterangan;
        $foto = $request->file('foto');
        if(!empty($foto)){
            $foto_name = date('Y-m-d')."_".$foto->getClientOriginalName();
            $foto->move("assets/img/fotolatihan",$foto_name);
            $absensi->foto = $foto_name;
        }
        if(!empty($request->kehadiran_pelatih)) {
            if (count(explode(',', $request->pelatih_id)) > 1) {
                $absensi->kehadiran_pelatih = implode(', ', (array) $request->get('kehadiran_pelatih'));
            } else {
                $absensi->kehadiran_pelatih = $request->kehadiran_pelatih;
            }
        }
        $absensi->save();

        $data_absensi = json_decode($request->absensi);
        foreach ($data_absensi as $a) {
            $absensi->absensidetail()->create([
                'anggota_id' => $a->anggota_id,
                'status_absen' => $a->status_absen,
                'keterangan' => $a->keterangan
            ]);
        }

        $response['success'] = true;
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ukm = Ukm::find($id);
        $absensi = Absensi::where(['ukm_id'=>$id])->get();
        $sql = "SELECT absensi.id, absensi.created_at, COUNT(*) as jumlahs
                FROM absensi
                INNER JOIN absensi_detail ON absensi.id = absensi_detail.absensi_id
                WHERE absensi_detail.status_absen = 'H' AND absensi.ukm_id = $id
                GROUP BY absensi.id";
        $jumlah = DB::select($sql);

        $results = array();
        foreach($absensi as $key=>$data){
            $array=array();
            $array['id'] = $data->id;
            $array['keterangan'] = $data->keterangan;
            $array['foto'] = $data->foto;
            $array['created_at'] = $data->created_at;
            $array['jumlah_hadir'] = $jumlah[$key]->jumlahs;
            $results[] = $array;
        }
        
        // dd($results);
        return view('absensi.show', compact('results', 'ukm'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 
    }
}
 