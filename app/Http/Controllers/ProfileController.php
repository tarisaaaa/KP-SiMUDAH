<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

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
        
        $user = session('user')->role;
        $graph2 = [];
        if ($user == 'adminkeuangan') 
        {
            $sql = "SELECT a.ukm_id,u.nama_ukm,count(*) as graph_value 
                    FROM absensi as a 
                    JOIN ukm as u ON a.ukm_id = u.id 
                    WHERE MONTH(a.created_at) = MONTH(CURRENT_DATE()) 
                    AND YEAR(a.created_at) = YEAR(CURRENT_DATE()) 
                    GROUP BY a.ukm_id,u.nama_ukm";
            $graph_title = "Jumlah login pelatih";
        } 
        else if ($user == 'wk') 
        {
            $sql = "SELECT a.id,u.nama_ukm, SUM(ad.status_absen = 'H') as graph_value, a.created_at 
                    FROM absensi as a 
                    RIGHT JOIN absensi_detail as ad ON a.id=ad.absensi_id 
                    LEFT JOIN ukm as u ON u.id = a.ukm_id 
                    WHERE DATE(a.created_at) = CURRENT_DATE() 
                    GROUP BY a.id,u.nama_ukm";
            $graph_title = "Jumlah kehadiran hari ini";
            $sql2 = "SELECT nama_ukm, SUM(rata_rata)/COUNT(*) as graph_value 
                    FROM v_absensi_harian 
                    GROUP BY ukm_id";
            $graph2 = DB::select($sql2);
        } 
        else if($user == "pembina") 
        {
            $pembina_id = Session::get('user')->id;
            $sql = "SELECT a.ukm_id,u.nama_ukm,count(*) as graph_value 
                    FROM absensi as a 
                    JOIN ukm as u ON a.ukm_id = u.id 
                    WHERE MONTH(a.created_at) = MONTH(CURRENT_DATE()) 
                    AND YEAR(a.created_at) = YEAR(CURRENT_DATE()) 
                    AND u.pembina_id = '".$pembina_id."' 
                    GROUP BY a.ukm_id,u.nama_ukm";
            $graph_title = "Rata-rata jumlah kehadiran";
        }
        else
        {
            return view('dashboard', compact('profile'));
        }
        $graph = DB::select($sql);
        
        return view('dashboard', compact('profile', 'graph','graph2','graph_title'));
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
            'niknpm'      => ['required'],
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
        $users = Users::findOrFail($id);
        return view('profile.edit', compact('profile', 'users'));
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
            'niknpm'      => ['required'],
            'nohp'      => ['required', 'numeric'],
            'email'          => ['required', 'email'],
            'alamat'          => ['required'],
            'user_id'      => ['required'],

            'nama'      => ['required'],
            'user_name'     => ['required'],
        ]);
        
        $profile = Profile::find($id);
        $profile->niknpm = $request->niknpm;
        $profile->nohp =$request->nohp;
        $profile->email = $request->email;
        $profile->alamat = $request->alamat;
        $profile->user_id = $request->user_id;

        Session::flash('edit',$profile->save());

        $user = Users::find($id);
        $user->nama = $request->nama;
        $user->user_name = $request->user_name;
        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }

        Session::flash('edit',$user->save());

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
