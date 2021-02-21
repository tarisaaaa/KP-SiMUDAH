<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    public $timestamps = false;
    protected $table = 'jadwal';
    protected $primaryKey = 'id';
    protected $fillable = ['ukm_id', 'waktu_mulai', 'waktu_selesai', 'hari', 'tempat', 'pelatih_id', 'ketuamhs_id'];

    public function ukm()
    {
        return $this->belongsTo('App\Ukm', 'ukm_id', 'id');
    }

    public function pelatih()
    {
        return $this->belongsTo('App\Pelatih', 'pelatih_id', 'id');
    }

    public function ketuamhs()
    {
        return $this->belongsTo('App\Ketuamhs', 'ketuamhs_id', 'id');
    }
}
