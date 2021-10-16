<?php

use App\Users;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Users::create([
            'user_name' => 'adminaplikasi',
            'nama' => 'Admin Aplikasi',
            'role' => 'adminaplikasi',
            'email' => 'adminaplikasi@mdp.ac.id',
            'password' => Hash::make('simudah'),
            'status_user' => 'Aktif',
        ]);
    }
}
