<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', 'IndexController@index');
Route::get('/jadwal-ukm', 'IndexController@jadwal');

// Route::get('/jadwal-ukm', function () {
//     return view('jadwal');
// });

Route::get('/user', function () {
    return view('user');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// });
Route::get('/dashboard', 'ProfileController@index');

Route::get('/login', 'LoginController@index')->name('login');
Route::post("/login", 'LoginController@login');
Route::get('/logout', 'LoginController@logout');

Route::get('/forgotpassword', 'ForgotPasswordController@index');
Route::post('/forgotpassword', 'ForgotPasswordController@sendEmail');
Route::get('/{token}/resetpassword', 'ForgotPasswordController@getPassword')->name('forgotpasssword.resetpassword');
Route::post('/resetpassword', 'ForgotPasswordController@updatePassword');

Route::middleware('auth')->group(function () {
    Route::middleware(['adminaplikasi'])->group(function() {
        Route::resource('adminaplikasi', 'AdminaplikasiController');
        Route::resource('ketuamhs', 'KetuamhsController');
        Route::resource('pelatih', 'PelatihController');
        Route::resource('adminkeuangan', 'AdminkeuanganController');
        Route::resource('pembina', 'PembinaController');
        Route::resource('wk', 'WkController');
        Route::resource('jadwal', 'JadwalController');
        
    });
    // Route::resource('adminaplikasi', 'AdminaplikasiController')->middleware('adminaplikasi');
    Route::middleware(['ketuamahasiswa'])->group(function() {
        Route::resource('kegiatan', 'KegiatanController');
        Route::get('kegiatan/showperukm/{kegiatan}', 'KegiatanController@showperukm')->name('kegiatan.showperukm');
        Route::get('/kegiatan/createperukm/{kegiatan}', 'KegiatanController@createperukm');
        Route::resource('absensi', 'AbsensiController');
        Route::get('/absensi/create/{absensi}', 'AbsensiController@create');
        Route::post('inputabsensi', 'AbsensiController@inputabsensi');
        Route::resource('anggota', 'AnggotaController');
        Route::get('/anggota/create/{anggota}', 'AnggotaController@create');
        Route::get('/anggota/{anggota}/showall', 'AnggotaController@showall');
    });

    Route::middleware('adminaplikasiketuamahasiswa')->group(function(){
        Route::resource('ukm', 'UkmController');
        Route::resource('anggota', 'AnggotaController');
        Route::get('/anggota/create/{anggota}', 'AnggotaController@create');
        Route::get('/anggota/{anggota}/showall', 'AnggotaController@showall');
    });

    Route::middleware('adminaplikasiketuamahasiswapelatih')->group(function(){
        Route::resource('pengumuman', 'PengumumanController');
        Route::get('pengumuman/showperukm/{pengumuman}', 'PengumumanController@showperukm');
        Route::get('/pengumuman/createperukm/{pengumuman}', 'PengumumanController@createperukm');
    });
    
    
    Route::middleware(['adminkeuangan'])->group(function () {
        Route::resource('laporan', 'LaporanController');
        Route::get('/laporan/{tahun}/{bulan}', 'LaporanController@show');
        Route::get('/laporan-pdf/{tahun}/{bulan}', 'LaporanController@exportPDF');
    });
    
    Route::middleware('wk')->group(function(){
        Route::get('/grafik/{id_ukm}', 'ProfileController@grafik');
    });

    Route::middleware('adminkeuanganandpembina')->group(function(){
        Route::resource('laporanmhs', 'LaporanMhsController');
        Route::get('/laporanmhs/{id_ukm}/{tahun}/{bulan}', 'LaporanMhsController@show');
        Route::get('/laporanmhs-pdf/{id_ukm}/{tahun}/{bulan}', 'LaporanMhsController@exportPDF');
    });
    
    Route::resource('profile', 'ProfileController');
    
});