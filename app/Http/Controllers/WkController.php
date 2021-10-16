<?php

namespace App\Http\Controllers;

use App\Users;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class WkController extends Controller
{
    public function index() {
        $data['users']= DB::table('users')->where('role', '=', 'wk')->get();
        return view('wk.index',$data);
        
    }

    public function create() {
        return view('wk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'      => ['required'],
            'user_name'     => ['required', 'unique:users,user_name'],
            'password'      => ['required'],
            'email'         => ['required', 'email'],
        ],[
            'required' => 'Field tidak boleh kosong!',
            'user_name.unique' => 'Username sudah ada!',
            'email' => 'Format email tidak benar!'
        ]);
        
        $users = new Users;
        $users->nama = $request->nama;
        $users->user_name = $request->user_name;
        $users->role = 'wk';
        $users->password = Hash::make($request->password);
        $users->email = $request->email;

        Session::flash('add',$users->save());
        return redirect('/wk')->with('status', 'Data User Berhasil Ditambahkan!');
    }

    public function show($id)
    {
        $wk = Profile::where('user_id', $id)->first();
        $user = Users::where('id', $id)->first();
        return view('wk.show', compact('wk', 'user'));
    }

    public function edit($id)
    {
        return view('wk.edit',[
            'wk' => Users::find($id)
        ]);

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'      => ['required'],
            'user_name'     => ['required', 'unique:users,user_name,'.$id],
            'email' => ['required', 'email', 'unique:users,email,'.$id]
        ],[
            'required' => 'Field tidak boleh kosong!',
            'user_name.unique' => 'Username sudah ada!',
            'email.unique' => 'Email sudah ada!',
            'email' => 'Format email tidak benar!'
        ]);

        $user = Users::find($id);
        $user->nama = $request->nama;
        $user->user_name = $request->user_name;
        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }
        $user->email = $request->email;

        Session::flash('edit',$user->save());
        return redirect()->route('wk.index')->with('status','Data User Berhasil Diubah');

    }

    public function destroy($id){
        Users::find($id)->delete();
        return redirect()->route('wk.index')->with('status','Data User Berhasil Dihapus');
    }
}
