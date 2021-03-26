<?php

namespace App\Http\Controllers;

use App\Absensi;
use App\AbsensiDetail;
use App\Ukm;
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
        $ukm = DB::table('ukm')->where('id', $id)->select('id', 'nama_ukm')->first();
        
        $anggota = DB::table('anggota')->where('ukm_id', $id)->where('status', '=', 'Aktif')->get();
        return view('absensi.create', compact('ukm', 'anggota'))->with('no', 1);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'keterangan'     => ['required'],
            'foto'      => ['required'],
            'user_id'          => ['required'],
            'ukm_id'      => ['required'],

            //absensi detail
            'absensi_id' => ['required'],
            'anggota_id' => ['required'],
            'status_absen' => ['required'],
            'keterangan_absen' => ['required']
        ]);
        
        $absensi = new Absensi;
        $absensi->keterangan = $request->keterangan;
        $absensi->user_id = $request->user_id;
        $absensi->ukm_id = $request->ukm_id;
        $foto = $request->file('foto');
        if(!empty($foto)){
            $foto_name = date('Y-m-d')."_".$foto->getClientOriginalName();
            $foto->move("assets/img/fotolatihan",$foto_name);
            $absensi->foto = $foto_name;
        }
        
        //Session::flash('add',$absensi->save());
        $absensi->save();

        $data = Absensi::find($absensi->id);
        $anggota = DB::table('anggota')->where('ukm_id', $absensi->ukm_id)->where('status', '=', 'Aktif')->get();
        //$absensi_detail = new AbsensiDetail;
        $total = DB::table('anggota')->where('ukm_id', $absensi->ukm_id)->where('status', '=', 'Aktif')->count();
        for ($i = 1; $i <= $total; $i++) {
            $data->absensi_detail()->saveMany([
                new AbsensiDetail(['anggota_id' => $anggota->id]),
                new AbsensiDetail(['status_absen' => $request->status_absen[$i]]),
                new AbsensiDetail(['keterangan' => $request->keterangan_absen[$i]]),
            ]);
        }
        Session::flash('add',$data->save());

        return redirect()->route('absensi.show', ['absensi'=>$request->ukm_id])->with('status', 'Absensi Berhasil Ditambahkan!');
        
        //return redirect()->route('absensi.detail', ['absensi'=>$absensi->id])->with('status', 'Absensi Berhasil Ditambahkan! Data absensi yang diinput tidak dapat diubah!')->with(compact('absensi'));

         //return $this->detail(['absensi'=>$absensi->id])->with('status', 'Absensi Berhasil Ditambahkan! Data absensi yang diinput tidak dapat diubah!')->with(compact('absensi'));
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

    // public function detail($id) 
    // {
    //     $absensi_detail = AbsensiDetail::findOrFail($id);
    //     dd($absensi_detail);
    //     return view('absensi.detail', compact('absensi_detail'));
    // }

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
        
        return view('absensi.show', compact('absensi', 'ukm'));
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