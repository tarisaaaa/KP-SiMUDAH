<?php

namespace App\Http\Controllers;

use App\Ukm;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UkmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session('user')->role == 'adminaplikasi') 
        {
            $ukm = Ukm::all();
            return view('ukm.index', compact('ukm'));
        } 
        else if (session('user')->role == 'ketuamahasiswa') 
        {
            $id = session('user')->id;
            $ukm = Ukm::where('ketuamhs_id', $id)->get();
            return view('ukm.index', compact('ukm'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ukm = DB::select('select * from ukm');
        $pembina = DB::select('select * from pembinaview');
        $pelatih = DB::select('select * from pelatihview');
        $ketuamhs = DB::select('select * from ketuamhsview');
        return view('ukm.create', compact('ukm', 'pembina', 'pelatih', 'ketuamhs'));
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
            'nama_ukm'      => ['required'],
            'ketuamhs_id'      => ['required'],
            'status'          => ['required']
        ], [
            'required' => 'Field harus diisi!'
        ]);
        
        $ukm = new Ukm;
        $ukm->nama_ukm = $request->nama_ukm;
        $ukm->pembina_id = $request->pembina_id;
        $ukm = $request->merge([ 
            'pelatih_id' => implode(', ', (array) $request->get('pelatih_id'))
        ]);
        $ukm->ketuamhs_id =$request->ketuamhs_id;

        Ukm::create($request->all());
        return redirect('/ukm')->with('status', 'Data UKM/HMJ Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ukm  $ukm
     * @return \Illuminate\Http\Response
     */
    public function show(Ukm $ukm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ukm  $ukm
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ukm = UKM::find($id);
        $pembina = DB::select('select * from pembinaview');
        $ketuamhs = DB::select('select * from ketuamhsview');
        $pelatih = DB::select('select * from pelatihview');
        // $pelatih = UKM::whereHas('pelatih', function($p){
        //     $p->where('status_user', 'Aktif');
        // })->where('id', $id)->get();
        // dd($pelatih);
        return view('ukm.edit', compact('ukm', 'pembina', 'pelatih', 'ketuamhs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ukm  $ukm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ukm $ukm)
    {
        $request->validate([
            'nama_ukm' => 'required',
            'ketuamhs_id' => 'required',
            'status' => 'required'
        ],[
            'required' => 'Field harus diisi!'
        ]);

        Ukm::where('id', $ukm->id)
                ->update([
                    'nama_ukm' => $request->nama_ukm,
                    'pembina_id' => $request->pembina_id,
                    'pelatih_id' => implode(', ',$request->pelatih_id),
                    'ketuamhs_id' => $request->ketuamhs_id,
                    'status' => $request->status
                ]);

        $idpelatih = Users::whereIn('id', explode(',', $ukm->pelatih_id))->get();
        foreach ($idpelatih as $pelatih) {
            Users::where('id', $pelatih->id)->update(['status_user' => $request->status_user[$pelatih->id]]);
        }

        return redirect('/ukm')->with('status', 'Data UKM/HMJ berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ukm  $ukm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ukm $ukm)
    {
        DB::table('ukm')->where('id',$ukm->id)->delete();
        return redirect('/ukm')->with('status', 'Data UKM/HMJ Berhasil Dihapus!');
    }
}
