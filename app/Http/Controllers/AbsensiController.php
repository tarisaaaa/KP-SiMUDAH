<?php

namespace App\Http\Controllers;

use App\Absensi;
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
        $absensi = Ukm::where('pelatih_id', $id)->get();
        return view('absensi.index', compact('absensi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $absensi = DB::select('select * from absensi');
        $ukm = DB::table('ukm')->where('id', $id)->select('id', 'nama_ukm')->get();
        return view('absensi.create', compact('absensi', 'ukm'));
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
            'jml_kehadiran'      => ['required'],
            'keterangan'     => ['required'],
            'foto'      => ['required'],
            'user_id'          => ['required'],
            'ukm_id'      => ['required'],
        ]);
        
        $absensi = new Absensi;
        $absensi->jml_kehadiran = $request->jml_kehadiran;
        $absensi->keterangan = $request->keterangan;
        $absensi->user_id = $request->user_id;
        $absensi->ukm_id = $request->ukm_id;
        $foto = $request->file('foto');
        if(!empty($foto)){
            $foto_name = date('Y-m-d')."_".$foto->getClientOriginalName();
            $foto->move("assets/img/fotolatihan",$foto_name);
            $absensi->foto = $foto_name;
        }

        //Ukm::create($request->all());
        Session::flash('add',$absensi->save());
        return redirect()->route('absensi.show', ['absensi'=>$request->ukm_id])->with('status', 'Absensi Berhasil Ditambahkan!');
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
        $absensi = Absensi::findorFail($id);
        DB::table('absensi')->where('id',$absensi->id)->delete();
        return back()->with('status', 'Absensi Berhasil Dihapus!');
    }
}
