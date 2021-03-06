<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'users';
    protected $fillable = ['nama','user_name', 'role'];
    protected $hidden = ['password', 'remember_token'];

    public function profile()
    {
        return $this->hasOne('App\Profile', 'user_id', 'id');
    }

    public function absensi()
    {
        return $this->hasMany('App\Absensi', 'user_id', 'id');
    }
}
