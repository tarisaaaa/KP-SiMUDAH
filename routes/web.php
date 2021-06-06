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
// Route::resource('bukupanduan', 'BukuPanduanController');
Route::get('/bukupanduan', 'BukuPanduanController@index');
Route::get('/bukupanduan-adminaplikasi', 'BukuPanduanController@adminaplikasi');
Route::get('/bukupanduan-adminkeuangan', 'BukuPanduanController@adminkeuangan');
Route::get('/bukupanduan-ketuamahasiswa', 'BukuPanduanController@ketuamahasiswa');
Route::get('/bukupanduan-pelatih', 'BukuPanduanController@pelatih');
Route::get('/bukupanduan-pembina', 'BukuPanduanController@pembina');
Route::get('/bukupanduan-wakilrektoriii', 'BukuPanduanController@wakilrektoriii');

// Route::get('/jadwal-ukm', function () {
//     return view('jadwal');
// });


// Route::get('/dashboard', function () {
//     return view('dashboard');
// });


Route::get('/login', 'LoginController@index')->name('login');
Route::post("/login", 'LoginController@login');
Route::get('/logout', 'LoginController@logout');

Route::get('/forgotpassword', 'ForgotPasswordController@index');
Route::post('/forgotpassword', 'ForgotPasswordController@sendEmail');
Route::get('/{token}/resetpassword', 'ForgotPasswordController@getPassword')->name('forgotpasssword.resetpassword');
Route::post('/resetpassword', 'ForgotPasswordController@updatePassword');

Route::middleware('auth')->group(function () {
    Route::get('/profile/create', 'ProfileController@create')->name('profile.create');
    Route::get('/dashboard', 'ProfileController@index');
    // Route::resource('profile', 'ProfileController');
    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::get('/profile/{profile}', 'ProfileController@show')->name('profile.show');
    Route::post('/profile', 'ProfileController@store')->name('profile.store');
    
    
    Route::middleware(['adminaplikasi'])->group(function() {
        Route::resource('adminaplikasi', 'AdminaplikasiController');
        Route::resource('ketuamhs', 'KetuamhsController');
        Route::resource('pelatih', 'PelatihController');
        Route::resource('adminkeuangan', 'AdminkeuanganController');
        Route::resource('pembina', 'PembinaController');
        Route::resource('wk', 'WkController');
        Route::resource('jadwal', 'JadwalController');
        Route::get('/user', function () {
            return view('user');
        });
        
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

    Route::middleware('pelatih')->group(function(){
        Route::resource('daftarabsensipelatih', 'DaftarAbsensiPelatihController');
    });
    
    Route::middleware('userid')->group(function(){
        Route::get('/profile/{profile}/edit', 'ProfileController@edit')->name('profile.edit');
        Route::put('/profile/{profile}', 'ProfileController@update')->name('profile.update');
    });
    
    
    
});
