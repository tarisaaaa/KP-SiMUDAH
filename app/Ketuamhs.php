<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ketuamhs extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'ketuamhsview';

    public function ukm()
    {
        return $this->hasMany('App\Ukm', 'ketuamhs_id', 'id');
    }

    public function jadwal()
    {
        return $this->hasMany('App\Jadwal', 'ketuamhs_id', 'id');
    }
}
