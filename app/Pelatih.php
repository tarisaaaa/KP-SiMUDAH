<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelatih extends Model
{
    
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'pelatihview';

    public function ukm()
    {
        return $this->hasMany('App\Ukm', 'pelatih_id', 'id');
    }

    public function jadwal()
    {
        return $this->hasMany('App\Jadwal', 'pelatih_id', 'id');
    }
}
