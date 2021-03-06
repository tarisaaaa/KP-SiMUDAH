<?php

namespace App\Http\Controllers;

use App\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwal = Jadwal::all();
        return view('jadwal.index', compact('jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ukm = DB::select('select * from ukm');
        $pelatih = DB::select('select * from pelatihview');
        $ketuamhs = DB::select('select * from ketuamhsview');
        return view('jadwal.create', compact('ukm', 'pelatih', 'ketuamhs'));
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
            'ukm_id'        => ['required'],
            'waktu_mulai'   => ['required'],
            'waktu_selesai' => ['required'],
            'hari'          => ['required'],
            'tempat'        => ['required'],
            'pelatih_id'    => ['required'],
            'ketuamhs_id'   => ['required']
        ]);
        
        $jadwal = new Jadwal;
        $jadwal->ukm_id = $request->ukm_id;
        $jadwal->waktu_mulai = $request->waktu_mulai;
        $jadwal->waktu_selesai = $request->waktu_selesai;
        $jadwal = $request->merge([ 
            'hari' => implode(',', (array) $request->get('hari'))
        ]);
        $jadwal->tempat = $request->tempat;
        $jadwal->pelatih_id = $request->pelatih_id;
        $jadwal->ketuamhs_id =$request->ketuamhs_id;

        //Session::flash('add',$jadwal->save());
        Jadwal::create($request->all());
        return redirect('/jadwal')->with('status', 'Data Jadwal Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(Jadwal $jadwal)
    {
        $pelatih = DB::select('select * from pelatihview');
        $ketuamhs = DB::select('select * from ketuamhsview');
        return view('jadwal.edit', compact('jadwal', 'pelatih', 'ketuamhs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'ukm_id'        => ['required'],
            'waktu_mulai'   => ['required'],
            'waktu_selesai' => ['required'],
            'hari'          => ['required'],
            'tempat'        => ['required'],
            'pelatih_id'    => ['required'],
            'ketuamhs_id'   => ['required']
        ]);

        

        Jadwal::where('id', $jadwal->id)
                ->update([
                    'ukm_id' => $request->ukm_id,
                    'waktu_mulai' => $request->waktu_mulai,
                    'waktu_selesai' => $request->waktu_selesai,
                    'hari' => implode(',',$request->hari),
                    'tempat' => $request->tempat,
                    'pelatih_id' => $request->pelatih_id,
                    'ketuamhs_id' => $request->ketuamhs_id
                ]);

        return redirect('/jadwal')->with('status', 'Data Jadwal berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jadwal $jadwal)
    {
        DB::table('jadwal')->where('id',$jadwal->id)->delete();
        return redirect('/jadwal')->with('status', 'Data Jadwal Berhasil Dihapus!');
    }
}
