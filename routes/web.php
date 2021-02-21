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

Route::resource('ketuamhs', 'KetuamhsController');
Route::resource('pelatih', 'PelatihController');
Route::resource('adminkeuangan', 'AdminkeuanganController');
Route::resource('adminaplikasi', 'AdminaplikasiController');
Route::resource('wk', 'WkController');

Route::resource('ukm', 'UkmController');
Route::resource('jadwal', 'JadwalController');
Route::resource('kegiatan', 'KegiatanController');
Route::resource('profile', 'ProfileController');
Route::resource('pengumuman', 'PengumumanController');
Route::resource('absensi', 'AbsensiController');
Route::get('/absensi/create/{absensi}', 'AbsensiController@create');
Route::resource('anggota', 'AnggotaController');
Route::get('/anggota/create/{anggota}', 'AnggotaController@create');

// Route::get('/ketuamhs', 'UsersController@index');
// Route::get('/ketuamhs/create', 'UsersController@create');
// Route::post('/ketuamhs', 'UsersController@store');
// Route::get('/ketuamhs/{ketuamhs}', 'ProfileController@show');