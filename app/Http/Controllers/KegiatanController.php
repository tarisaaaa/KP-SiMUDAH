<?php

namespace App\Http\Controllers;

use App\Kegiatan;
use App\Ukm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session('user')->role == 'adminaplikasi') {
            $kegiatan = Kegiatan::all();
            return view('kegiatan.index', compact('kegiatan'));
        } else {
            $id = session('user')->id;
            $kegiatan = Ukm::Where('ketuamhs_id', $id)->get();
            return view('kegiatan.menu', compact('kegiatan'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ukm = DB::select('select id, nama_ukm from ukm');
        return view('kegiatan.create', compact('ukm'));
    }

    public function createperukm($id)
    {
        $ukm = DB::table('ukm')->where('id', $id)->select('id', 'nama_ukm')->first();
        return view('kegiatan.createperukm', compact('ukm'));
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
            'ukm_id'      => ['required'],
            'nama_kegiatan'     => ['required'],
            'tanggal'      => ['required'],
            'keterangan'          => ['required']
        ],[
            'required' => 'field :attribute tidak boleh kosong!'
        ]);
        
        $kegiatan = new Kegiatan;
        $kegiatan->ukm_id = $request->ukm_id;
        $kegiatan->nama_kegiatan = $request->nama_kegiatan;
        $kegiatan->tanggal =$request->tanggal;
        $kegiatan->keterangan = $request->keterangan;

        Session::flash('add',$kegiatan->save());
        return redirect('/kegiatan')->with('status', 'Data Kegiatan Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function show(Kegiatan $kegiatan)
    {
        return view('kegiatan.show', compact('kegiatan'));
    }

    public function showperukm($id)
    {
        $ukm = Ukm::find($id);
        $kegiatan = Kegiatan::where(['ukm_id'=>$id])->get();
        return view('kegiatan.showperukm', compact('kegiatan', 'ukm'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kegiatan $kegiatan)
    {
        $ukm = DB::select('select id, nama_ukm from ukm');
        return view('kegiatan.edit', compact('kegiatan','ukm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'ukm_id' => 'required',
            'nama_kegiatan' => 'required',
            'tanggal' => 'required',
            'keterangan' => 'required'
        ],[
            'required' => 'field :attribute tidak boleh kosong!'
        ]);

        Kegiatan::where('id', $kegiatan->id)
                ->update([
                    'ukm_id' => $request->ukm_id,
                    'nama_kegiatan' => $request->nama_kegiatan,
                    'tanggal' => $request->tanggal,
                    'keterangan' => $request->keterangan
                ]);

        return redirect('/kegiatan')->with('status', 'Data Kegiatan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kegiatan $kegiatan)
    {
        DB::table('kegiatan')->where('id',$kegiatan->id)->delete();
        return redirect('/kegiatan')->with('status', 'Data Kegiatan Berhasil Dihapus!');
    }
}
