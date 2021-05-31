<?php

namespace App\Http\Controllers;

use App\Anggota;
use App\Ukm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anggota = Anggota::all();
        return view('anggota.index', compact('anggota'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $anggota = DB::select('select * from anggota');
        $ukm = DB::table('ukm')->where('id', $id)->select('id', 'nama_ukm')->get();
        return view('anggota.create', compact('anggota', 'ukm'));
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
            'nama_anggota'      => ['required'],
            'npm'     => ['required', 'numeric', 'digits:10'],
            'nohp'      => ['required',  'regex:/(0)[0-9]{10,13}/', 'numeric', 'digits_between:11,14'],
            'email'          => ['required', 'email'],
            'status'          => ['required'],
            'ukm_id'      => ['required'],
        ],[
            'required' => 'Field harus diisi!',
            'email' => 'Field harus berupa email!',
            'digits' => 'Field harus berjumlah 10 digit',
            'regex' => 'gunakan format nomor diawali dengan 0!',
            'digits_between' => ':attribute berjumlah 11-14 digit',
            'numeric' => ':attribute harus berupa angka'
        ]);
        
        $anggota = new Anggota;
        $anggota->nama_anggota = $request->nama_anggota;
        $anggota->npm = $request->npm;
        $anggota->nohp =$request->nohp;
        $anggota->status = $request->status;
        $anggota->email = $request->email;
        $anggota->ukm_id = $request->ukm_id;

        //Ukm::create($request->all());
        Session::flash('add',$anggota->save());
        return back()->with('status', 'Data Anggota Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ukm = Ukm::find($id);
        $anggota = Anggota::where(['ukm_id'=>$id])->where('status', '=', 'Aktif')->get();
        return view('anggota.index', compact('anggota','ukm'));
    }

    public function showall($id)
    {
        $ukm = Ukm::find($id);
        $anggota = Anggota::where(['ukm_id'=>$id])->get();
        return view('anggota.showall', compact('anggota','ukm'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('anggota.edit', compact('anggota'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_anggota' => ['required'],
            'npm' => ['required', 'numeric', 'digits:10'],
            'nohp' => ['required', 'regex:/(0)[0-9]{10,13}/', 'numeric', 'digits_between:11,14'],
            'email' => ['required', 'email'],
            'status' => ['required']
        ],[
            'required' => 'Field harus diisi!',
            'email' => 'Field harus berupa email!',
            'regex' => 'gunakan format nomor diawali dengan 0!',
            'digits_between' => ':attribute berjumlah 11-14 digit',
            'numeric' => ':attribute harus berupa angka',
            'digits' => 'Field harus berjumlah 10 digit',
        ]);

        $anggota = Anggota::find($id);
        $anggota->nama_anggota = $request->nama_anggota;
        $anggota->npm = $request->npm;
        $anggota->nohp = $request->nohp;
        $anggota->status = $request->status;
        $anggota->email = $request->email;

        Session::flash('edit',$anggota->save());
        return redirect()->route('anggota.show', ['anggotum'=>$request->ukm_id])->with('status', 'Data Anggota berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $anggota = Anggota::findorFail($id);
        DB::table('anggota')->where('id',$anggota->id)->delete();
        return back()->with('status', 'Data anggota Berhasil Dihapus!');
    }
}
