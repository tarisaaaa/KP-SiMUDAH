<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Users;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(Users::class, function (Faker $faker) {
    return [
        'user_name' => 'adminaplikasi',
        'nama_admin' => 'Admin Aplikasi',
        'role' => 'adminaplikasi',
        'email' => 'adminaplikasi@mdp.ac.id',
        'password' => Hash::make('simudah'),
        'status_user' => 'Aktif',
    ];
});
