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
            $sql = "SELECT a.ukm_id,p.nama,u.nama_ukm,count(*) as graph_value  
                    FROM absensi as a 
                    JOIN ukm as u ON a.ukm_id = u.id 
                    JOIN pelatihview as p ON u.pelatih_id = p.id
                    WHERE MONTH(a.created_at) = MONTH(CURRENT_DATE()) 
                    AND YEAR(a.created_at) = YEAR(CURRENT_DATE()) 
                    AND u.pelatih_id IS NOT NULL
                    AND a.kehadiran_pelatih = 'Hadir'
                    GROUP BY a.ukm_id,u.nama_ukm";
            $graph_title = "Grafik Kehadiran Pelatih Bulan Ini";
            $graph_yaxis = "Jumlah kehadiran";
        } 
        else if ($user == 'wk') 
        {
            $sql = "SELECT ukm_id, nama_ukm, SUM(rata_rata)/COUNT(*) as graph_value 
                    FROM v_absensi_harian 
                    GROUP BY ukm_id";
            $graph_title = "Grafik Keaktifan UKM dan HMJ";
            $graph_yaxis = "Rata-rata kehadiran mahasiswa";

            $idukm = 0;
            $sql2 = "SELECT a.ukm_id,u.nama_ukm, SUM(ad.status_absen = 'H') as graph_value, DAY(a.created_at)
                    FROM absensi as a 
                    RIGHT JOIN absensi_detail as ad ON a.id=ad.absensi_id 
                    JOIN ukm as u ON a.ukm_id = u.id 
                    WHERE MONTH(a.created_at) = MONTH(CURRENT_DATE()) 
                    AND YEAR(a.created_at) = YEAR(CURRENT_DATE()) 
                    AND u.id = $idukm -- SEMENTARA
                    GROUP BY a.ukm_id,u.nama_ukm, day(a.created_at)";
            $graph2 = DB::select($sql2);
            // dd($graph2);
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
            $graph_title = "Grafik Keaktifan UKM dan HMJ";
            $graph_yaxis = "Rata-rata jumlah kehadiran";
        }
        else if($user == "pelatih") 
        {
            $sql = "SELECT a.ukm_id,u.nama_ukm, SUM(ad.status_absen = 'H') as graph_value, DAY(a.created_at)
                    FROM absensi as a 
                    RIGHT JOIN absensi_detail as ad ON a.id=ad.absensi_id 
                    JOIN ukm as u ON a.ukm_id = u.id 
                    WHERE MONTH(a.created_at) = MONTH(CURRENT_DATE()) 
                    AND YEAR(a.created_at) = YEAR(CURRENT_DATE()) 
                    AND u.pelatih_id = $id
                    GROUP BY a.ukm_id,u.nama_ukm, day(a.created_at)";
            $graph_title = "Grafik Kehadiran Mahasiswa";
            $graph_yaxis = "Jumlah mahasiswa";
        }
        else
        {
            return view('dashboard', compact('profile'));
        }
        $graph = DB::select($sql);
        
        return view('dashboard', compact('profile', 'graph','graph2','graph_title', 'graph_yaxis'));
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
