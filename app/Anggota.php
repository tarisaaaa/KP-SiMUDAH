<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    public $timestamps = false;
    protected $table = 'anggota';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_anggota', 'npm', 'nohp', 'email','ukm_id'];

    public function ukm()
    {
        return $this->belongsTo('App\Ukm', 'ukm_id');
    }
}
