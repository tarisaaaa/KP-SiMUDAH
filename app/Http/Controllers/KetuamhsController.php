<?php

namespace App\Http\Controllers;

use App\Users;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class KetuamhsController extends Controller
{
    public function index() {
        $data['users']= DB::table('users')->select('id', 'user_name', 'nama')->where('role', '=', 'ketuamahasiswa')->get();
        return view('ketuamhs.index',$data);
        
    }

    public function create() {
        return view('ketuamhs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mhs'      => ['required'],
            'user_name'     => ['required'],
            'password'      => ['required'],
            'role'          => ['required']
        ]);
        
        $users = new Users;
        $users->nama = $request->nama_mhs;
        $users->user_name = $request->user_name;
        $users->role =$request->role;
        $users->password = Hash::make($request->password);

        Session::flash('add',$users->save());
        return redirect('/ketuamhs')->with('status', 'Data Ketua Mahasiswa Berhasil Ditambahkan!');
    }

    public function show($id)
    {
        $ketuamhs = Profile::where('user_id', $id)->first();
        return view('ketuamhs.show', compact('ketuamhs'));
    }

    public function edit($id)
    {
        return view('ketuamhs.edit',[
            'ketuamhs' => Users::find($id)
        ]);

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'      => ['required'],
            'user_name'     => ['required'],
        ]);
        $user = Users::find($id);
        $user->nama = $request->nama;
        $user->user_name = $request->user_name;
        $user->password = Hash::make($request->password);

        Session::flash('edit',$user->save());
        return redirect()->route('ketuamhs.index')->with('status','Data User Berhasil Diubah');

    }

    public function destroy($id){
        Users::find($id)->delete();
        return redirect()->route('ketuamhs.index')->with('status','Data User Berhasil Dihapus');
    }
}
