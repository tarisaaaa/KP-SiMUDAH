<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public $timestamps = false;
    protected $table = 'profil';
    protected $primaryKey = 'id';
    protected $fillable = ['niknpm', 'email', 'nohp', 'alamat', 'user_id'];

    public function users()
    {
        return $this->belongsTo('App\Users', 'user_id', 'id');
    }
}
