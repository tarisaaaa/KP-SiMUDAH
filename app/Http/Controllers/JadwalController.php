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
        //$jadwal = Jadwal::all();
        // $sql = "SELECT jadwal.id, ukm.nama_ukm, pelatihview.nama, ketuamhsview.nama, pembinaview.nama
        //         FROM jadwal
        //         INNER JOIN ukm ON jadwal.ukm_id = ukm.id
        //         INNER JOIN pelatihview ON ukm.pelatih_id = pelatihview.id
        //         INNER JOIN ketuamhsview ON ukm.ketuamhs_id = ketuamhsview.id
        //         INNER JOIN pembinaview ON ukm.pembina_id = pembinaview.id";
        // $results = DB::select($sql);

        $jadwal = DB::table('jadwal')->get()->toArray();
        $getPelatih = DB::table('ukm')
                        ->join('pelatihview', 'ukm.pelatih_id', '=', 'pelatihview.id')
                        ->join('jadwal', 'ukm.id', '=', 'jadwal.ukm_id')
                        ->select('pelatihview.nama')
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
                $array['pelatih'] = $getPelatih[$key]->nama;
            }
            
            $array['ketuamhs'] = $getKetuamhs[$key]->nama;
            $results[] = $array;
        }
        
        // dd($results);
        return view('jadwal.index', ['results'=>$results]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ukm = DB::select('select * from ukm');
        return view('jadwal.create', compact('ukm'));
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
            'tempat'        => ['required']
        ]);
        
        $jadwal = new Jadwal;
        $jadwal->ukm_id = $request->ukm_id;
        $jadwal->waktu_mulai = $request->waktu_mulai;
        $jadwal->waktu_selesai = $request->waktu_selesai;
        $jadwal = $request->merge([ 
            'hari' => implode(', ', (array) $request->get('hari'))
        ]);
        $jadwal->tempat = $request->tempat;

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
        $ukm = DB::select('select id, nama_ukm from ukm');
        return view('jadwal.edit', compact('jadwal', 'ukm'));
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
            'tempat'        => ['required']
        ]);

        

        Jadwal::where('id', $jadwal->id)
                ->update([
                    'ukm_id' => $request->ukm_id,
                    'waktu_mulai' => $request->waktu_mulai,
                    'waktu_selesai' => $request->waktu_selesai,
                    'hari' => implode(', ',$request->hari),
                    'tempat' => $request->tempat
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
