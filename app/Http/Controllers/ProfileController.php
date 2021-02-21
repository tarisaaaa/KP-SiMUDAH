<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = session('user')->id;
        $profile = Profile::where('user_id', $id)->first();
        return view('dashboard', compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profile.create');
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
            'niknpm'      => ['required', 'numeric'],
            'nohp'      => ['required', 'numeric'],
            'email'          => ['required', 'email'],
            'alamat'          => ['required'],
            'user_id'      => ['required'],
        ]);
        
        $profile = new Profile;
        $profile->niknpm = $request->niknpm;
        $profile->nohp =$request->nohp;
        $profile->email = $request->email;
        $profile->alamat = $request->alamat;
        $profile->user_id = $request->user_id;

        Session::flash('add',$profile->save());
        return redirect('dashboard')->with('status', 'Profil Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = Profile::findOrFail($id);
        return view('profile.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'niknpm'      => ['required', 'numeric'],
            'nohp'      => ['required', 'numeric'],
            'email'          => ['required', 'email'],
            'alamat'          => ['required'],
            'user_id'      => ['required'],
        ]);
        
        $profile = Profile::find($id);
        $profile->niknpm = $request->niknpm;
        $profile->nohp =$request->nohp;
        $profile->email = $request->email;
        $profile->alamat = $request->alamat;
        $profile->user_id = $request->user_id;

        Session::flash('edit',$profile->save());
        return redirect('dashboard')->with('status', 'Profil Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
