<?php

namespace App\Http\Controllers;

use App\Users;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PelatihController extends Controller
{
    public function index() {
        $data['users']= DB::table('users')->select('id', 'user_name', 'nama')->where('role', '=', 'pelatih')->get();
        return view('pelatih.index',$data);
        
    }

    public function create() {
        return view('pelatih.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'      => ['required'],
            'user_name'     => ['required'],
            'password'      => ['required'],
            'role'          => ['required']
        ]);
        
        $users = new Users;
        $users->nama = $request->nama;
        $users->user_name = $request->user_name;
        $users->role =$request->role;
        $users->password = Hash::make($request->password);

        Session::flash('add',$users->save());
        return redirect('/pelatih')->with('status', 'Data User Berhasil Ditambahkan!');
    }

    public function show($id)
    {
        $pelatih = Profile::where('user_id', $id)->first();
        return view('pelatih.show', compact('pelatih'));
    }

    public function edit($id)
    {
        return view('pelatih.edit',[
            'pelatih' => Users::find($id)
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
        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }

        Session::flash('edit',$user->save());
        return redirect()->route('pelatih.index')->with('status','Data User Berhasil Diubah');

    }

    public function destroy($id){
        Users::find($id)->delete();
        return redirect()->route('pelatih.index')->with('status','Data User Berhasil Dihapus');
    }
}
