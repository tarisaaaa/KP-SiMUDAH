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
        $pelatih = DB::table('ukm')->join('pelatihview', 'ukm.pelatih_id', '=', 'pelatihview.id')->where('ukm.id', $id)->where('pelatihview.status_user', '=', 'Aktif')->select('pelatihview.id','pelatihview.nama')->first();
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
                $absensi = $request->merge([  
                    'kehadiran_pelatih' => implode(', ', (array) $request->get('kehadiran_pelatih'))
                ]);
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

        if(!empty($request->kehadiran_pelatih)) {
            if (count(explode(',', $request->pelatih_id)) > 1) {
                
                    $laporan = new Laporan;
                    $laporan->ukm_id = $request->ukm_id;
                    $laporan->pelatih_id = 2;
                    $laporan->kehadiran = $request->kehadiran_pelatih[2];
                    $laporan->save();
                
            } else {
                $laporan = new Laporan;
                $laporan->ukm_id = $request->ukm_id;
                $laporan->pelatih_id = $request->pelatih_id;
                $laporan->kehadiran = $request->kehadiran_pelatih;
                $laporan->save();
            }
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
        $absensi = Absensi::findOrFail($id);
        return view('absensi.edit', compact('absensi'));
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
        $request->validate([
            'jml_kehadiran'      => ['required'],
            'keterangan'     => ['required'],
            'user_id'          => ['required'],
            'ukm_id'      => ['required'],
        ]);
        
        $foto = $request->file('foto');
        if(!empty($foto)){
            $request->validate([
                'foto'      => ['required']
            ]);
        }

        $absensi = Absensi::find($id);
        $absensi->jml_kehadiran = $request->jml_kehadiran;
        $absensi->keterangan = $request->keterangan;
        $absensi->user_id = $request->user_id;
        $absensi->ukm_id = $request->ukm_id;
        if(!empty($foto)){
            $foto_name = date('Y-m-d')."_".$foto->getClientOriginalName();
            $foto->move("assets/img/fotolatihan",$foto_name);
            $absensi->foto = $foto_name;
        }

        Session::flash('edit',$absensi->save());
        return redirect()->route('absensi.show', ['absensi'=>$request->ukm_id])->with('status', 'Absensi Berhasil Ditambahkan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $absensi_detail = AbsensiDetail::findorFail($id);
        // DB::table('absensi_detail')->where('id',$absensi_detail->id)->delete();

        $absensi = Absensi::findorFail($id);
        DB::table('absensi')->where('id',$absensi->id)->delete();
        return back()->with('status', 'Absensi Berhasil Dihapus!');
    }
}
