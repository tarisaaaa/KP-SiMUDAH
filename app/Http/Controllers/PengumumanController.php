<?php

namespace App\Http\Controllers;

use App\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengumuman = Pengumuman::all();
        return view('pengumuman.index', compact('pengumuman'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ukm = DB::select('select id, nama_ukm from ukm');
        return view('pengumuman.create', compact('ukm'));
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
            'judul'     => ['required'],
            'isi'      => ['required'],
            'nama'          => ['required']
        ]);
        
        $pengumuman = new Pengumuman;
        $pengumuman->ukm_id = $request->ukm_id;
        $pengumuman->judul = $request->judul;
        $pengumuman->isi =$request->isi;
        $pengumuman->nama = $request->nama;

        Session::flash('add',$pengumuman->save());
        return redirect('/pengumuman')->with('status', 'Data Pengumuman Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function show(Pengumuman $pengumuman)
    {
        return view('pengumuman.show', compact('pengumuman'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengumuman $pengumuman)
    {
        $ukm = DB::select('select id, nama_ukm from ukm');
        return view('pengumuman.edit', compact('pengumuman','ukm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'ukm_id'      => ['required'],
            'judul'     => ['required'],
            'isi'     => ['required'],
            'nama'     => ['required'],
        ]);
        $pengumuman = Pengumuman::find($id);
        $pengumuman->ukm_id = $request->ukm_id;
        $pengumuman->isi = $request->isi;
        $pengumuman->nama = $request->nama;

        Session::flash('edit',$pengumuman->save());
        return redirect()->route('pengumuman.index')->with('status','Pengumuman Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pengumuman::find($id)->delete();
        return redirect()->route('pengumuman.index')->with('status','Pengumuman Berhasil Dihapus');
    }
}
