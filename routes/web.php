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

Route::get('/login', 'LoginController@index');
Route::post("/login", 'LoginController@login');
Route::get('/logout', 'LoginController@logout');

Route::get('/forgotpassword', 'ForgotPasswordController@index');
Route::post('/forgotpassword', 'ForgotPasswordController@sendEmail');
Route::get('/{token}/resetpassword', 'ForgotPasswordController@getPassword')->name('forgotpasssword.resetpassword');
Route::post('/resetpassword', 'ForgotPasswordController@updatePassword');

Route::resource('ketuamhs', 'KetuamhsController');
Route::resource('pelatih', 'PelatihController');
Route::resource('adminkeuangan', 'AdminkeuanganController');
Route::resource('adminaplikasi', 'AdminaplikasiController');
Route::resource('pembina', 'PembinaController');
Route::resource('wk', 'WkController');

Route::resource('ukm', 'UkmController');
Route::resource('jadwal', 'JadwalController');
Route::resource('kegiatan', 'KegiatanController');
Route::get('kegiatan/showperukm/{kegiatan}', 'KegiatanController@showperukm')->name('kegiatan.showperukm');
Route::get('/kegiatan/createperukm/{kegiatan}', 'KegiatanController@createperukm');
Route::resource('laporan', 'LaporanController');
Route::get('/laporan/{tahun}/{bulan}', 'LaporanController@show');
Route::get('/laporan-pdf/{tahun}/{bulan}','LaporanController@exportPDF');
Route::resource('laporanmhs', 'LaporanMhsController');
Route::get('/laporanmhs/{id_ukm}/{tahun}/{bulan}', 'LaporanMhsController@show');
Route::get('/laporanmhs-pdf/{id_ukm}/{tahun}/{bulan}','LaporanMhsController@exportPDF');
Route::resource('profile', 'ProfileController');
Route::get('/grafik/{id_ukm}', 'ProfileController@grafik');
Route::resource('pengumuman', 'PengumumanController');
Route::get('pengumuman/showperukm/{pengumuman}', 'PengumumanController@showperukm');
Route::get('/pengumuman/createperukm/{pengumuman}', 'PengumumanController@createperukm');
Route::resource('absensi', 'AbsensiController');
Route::get('/absensi/create/{absensi}', 'AbsensiController@create');
Route::post('inputabsensi', 'AbsensiController@inputabsensi');
// Route::get('/absensi/detail/{absensi}', 'AbsensiController@detail')->name('absensi.detail');
Route::resource('anggota', 'AnggotaController');
Route::get('/anggota/create/{anggota}', 'AnggotaController@create');
Route::get('/anggota/{anggota}/showall', 'AnggotaController@showall');

// Route::get('/ketuamhs', 'UsersController@index');
// Route::get('/ketuamhs/create', 'UsersController@create');
// Route::post('/ketuamhs', 'UsersController@store');
// Route::get('/ketuamhs/{ketuamhs}', 'ProfileController@show');

// Route::get('/absensi/detail/{absensi}', [
//     'uses' => 'AbsensiController@detail',
//     'as' => 'absensi.detail'
// ]);