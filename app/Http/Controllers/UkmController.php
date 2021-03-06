<?php

namespace App\Http\Controllers;

use App\Ukm;
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
            'pembina_id'     => ['required'],
            'pelatih_id'     => ['required'],
            'ketuamhs_id'      => ['required'],
            'status'          => ['required']
        ]);
        
        $ukm = new Ukm;
        $ukm->nama_ukm = $request->nama_ukm;
        $ukm->pembina_id = $request->pembina_id;
        $ukm->pelatih_id = $request->pelatih_id;
        $ukm->ketuamhs_id =$request->ketuamhs_id;
        $ukm->status = $request->status;

        //Ukm::create($request->all());
        Session::flash('add',$ukm->save());
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
    public function edit(Ukm $ukm)
    {
        $pembina = DB::select('select * from pembinaview');
        $pelatih = DB::select('select * from pelatihview');
        $ketuamhs = DB::select('select * from ketuamhsview');
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
            'pembina_id' => 'required',
            'pelatih_id' => 'required',
            'ketuamhs_id' => 'required',
            'status' => 'required'
        ]);

        Ukm::where('id', $ukm->id)
                ->update([
                    'nama_ukm' => $request->nama_ukm,
                    'pembina_id' => $request->pembina_id,
                    'pelatih_id' => $request->pelatih_id,
                    'ketuamhs_id' => $request->ketuamhs_id,
                    'status' => $request->status
                ]);

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
