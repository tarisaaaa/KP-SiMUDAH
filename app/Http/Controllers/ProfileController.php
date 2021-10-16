<?php

namespace App\Http\Controllers;

use App\Jadwal;
use App\Profile;
use App\Ukm;
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
        $namaukm = '';
        $jadwal = '';
        if ($user == 'adminkeuangan') 
        {
            $sql =  "SELECT users.nama, laporan.ukm_id, ukm.nama_ukm, COUNT(*) as graph_value
                    FROM laporan
                    JOIN users ON users.id = laporan.pelatih_id
                    JOIN ukm ON ukm.id = laporan.ukm_id
                    JOIN absensi ON absensi.id = laporan.absensi_id
                    WHERE YEAR(absensi.created_at) = YEAR(CURRENT_DATE()) 
                    AND MONTH(absensi.created_at) = MONTH(CURRENT_DATE()) 
                    AND laporan.kehadiran = 'Hadir'
                    GROUP BY laporan.pelatih_id";
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
        }  
        else if($user == "pembina") 
        {
            $pembina_id = Session::get('user')->id;
            $sql = "SELECT a.ukm_id,u.nama_ukm, SUM(a.rata_rata)/COUNT(*) as graph_value 
                    FROM v_absensi_harian as a
                    JOIN ukm as u ON a.ukm_id = u.id 
                    WHERE u.pembina_id = $pembina_id
                    GROUP BY a.ukm_id,u.nama_ukm";
            $graph_title = "Grafik Keaktifan UKM dan HMJ";
            $graph_yaxis = "Rata-rata kehadiran mahasiswa";
            $namaukm = DB::table('ukm')->join('users', 'ukm.pembina_id', '=', 'users.id')->where('ukm.pembina_id', $id)->first();
        }
        else if($user == "pelatih") 
        {
            $sql = "SELECT a.ukm_id,u.nama_ukm, SUM(ad.status_absen = 'H') as graph_value, DAY(a.created_at)
                    FROM absensi as a 
                    RIGHT JOIN absensi_detail as ad ON a.id=ad.absensi_id 
                    JOIN ukm as u ON a.ukm_id = u.id 
                    WHERE MONTH(a.created_at) = MONTH(CURRENT_DATE()) 
                    AND YEAR(a.created_at) = YEAR(CURRENT_DATE()) 
                    -- AND u.pelatih_id = $id
                    AND u.pelatih_id LIKE '%".$id."%'
                    GROUP BY a.ukm_id,u.nama_ukm, day(a.created_at)";
            $graph_title = "Grafik Kehadiran Mahasiswa";
            $graph_yaxis = "Jumlah mahasiswa";
            $namaukm = DB::table('ukm')->join('users', 'ukm.pelatih_id', '=', 'users.id')->where('ukm.pelatih_id', $id)->first();
            if (empty($namaukm)) {
                $namaukm = DB::table('ukm')->join('users', 'ukm.pelatih_id', '=', 'users.id')->where('ukm.pelatih_id', 'like', '%'. $id .'%')->first();
            }
            $jadwal = DB::table('jadwal')->join('ukm', 'jadwal.ukm_id', '=', 'ukm.id')->where('ukm.pelatih_id', $id)->first();
            if (empty($jadwal)) {
                $jadwal = DB::table('jadwal')->join('ukm', 'jadwal.ukm_id', '=', 'ukm.id')->where('ukm.pelatih_id', 'like', '%'. $id .'%')->first();
            }
        }
        else
        {
            return view('dashboard', compact('profile'));
        }
        $graph = DB::select($sql);
        // dd($graph);
        return view('dashboard', compact('profile', 'graph','graph_title', 'graph_yaxis', 'namaukm', 'jadwal'));
    }

    public function grafik($id_ukm) 
    {
        $sql = "SELECT a.ukm_id,u.nama_ukm, SUM(ad.status_absen = 'H') as graph_value, DAY(a.created_at)
                FROM absensi as a 
                RIGHT JOIN absensi_detail as ad ON a.id=ad.absensi_id 
                JOIN ukm as u ON a.ukm_id = u.id 
                WHERE u.id = $id_ukm
                GROUP BY a.ukm_id,u.nama_ukm, day(a.created_at)";
        $graph = DB::select($sql);

        $sql_ukm = "SELECT ukm_id, nama_ukm, SUM(rata_rata)/COUNT(*) as graph_value 
                    FROM v_absensi_harian 
                    GROUP BY ukm_id";
        $list_ukm = DB::select($sql_ukm);
        
        return view('grafik', compact('graph', 'list_ukm'));
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
            'nohp'      => ['required', 'regex:/(0)[0-9]{10,13}/', 'numeric', 'digits_between:11,14'],
            'alamat'          => ['required'],
            'user_id'      => ['required'],
        ], [
            'required' => ':attribute tidak boleh kosong!',
            'regex' => 'gunakan format nomor diawali dengan 0!',
            'digits_between' => ':attribute berjumlah 11-14 digit',
            'numeric' => ':attribute harus berupa angka'
        ]);
        
        $profile = new Profile;
        $profile->niknpm = $request->niknpm;
        $profile->nohp =$request->nohp;
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
        $profile = Profile::where('user_id', $id)->first();
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
            'nohp'      => ['required', 'regex:/(0)[0-9]{10,13}/', 'numeric', 'digits_between:11,14'],
            'email'          => ['required', 'email'],
            'alamat'          => ['required'],
            'user_id'      => ['required'],

            'nama'      => ['required'],
            'user_name'     => ['required'],
        ], [
            'required' => ':attribute tidak boleh kosong!',
            'email' => 'field harus berupa email!',
            'regex' => 'gunakan format nomor diawali dengan 0!',
            'digits_between' => ':attribute berjumlah 11-14 digit',
            'numeric' => ':attribute harus berupa angka'
        ]);
        
        $profile = Profile::where('user_id',$id)->first();
        $profile->niknpm = $request->niknpm;
        $profile->nohp =$request->nohp;
        $profile->alamat = $request->alamat;
        $profile->user_id = $request->user_id;

        Session::flash('edit',$profile->save());

        $user = Users::find($profile->user_id);
        $user->nama = $request->nama;
        $user->user_name = $request->user_name;
        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }
        $user->email = $request->email;

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
