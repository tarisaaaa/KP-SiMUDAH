<?php

namespace App\Http\Controllers;

use App\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function index() {
        return view('forgotpassword');
    }

    public function sendEmail(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ],[
            'required' => ':attribute tidak boleh kosong!',
            'email' => 'field harus berupa alamat email!',
            'exists' => 'email tidak ada!'
        ]);

        $token = Str::random(64);
        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        Mail::send('forgotpassword.verify', ['token' => $token], function($status) use($request){
            $status->to($request->email);
            $status->subject('SiMUDAH - Notifikasi Reset Password');
        });

        return back()->with('status', 'Link reset password telah dikirim ke email Anda!');
    }

    public function getPassword($token) { 
        return view('forgotpassword.resetpassword', ['token' => $token]);
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ],[
            'required' => 'Field tidak boleh kosong',
            'min' => 'Jumlah karakter minimal 6 karakter',
            'exists' => 'Email tidak terdaftar pada aplikasi',
            'confirmed' => 'Password tidak cocok'
        ]);

        $updatePassword = DB::table('password_resets')
                      ->where(['email' => $request->email, 'token' => $request->token])
                      ->first();

        if(!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = Users::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return redirect('/login')->with('message', 'Password telah diubah!');
    }
}
