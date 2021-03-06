<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    public $timestamps = false;
    protected $table = 'absensi';
    protected $primaryKey = 'id';
    protected $fillable = ['ukm_id', 'user_id', 'jml_kehadiran', 'keterangan', 'foto', 'created_at'];

    public function ukm()
    {
        return $this->belongsTo('App\Ukm', 'ukm_id');
    }

    public function users()
    {
        return $this->belongsTo('App\Users', 'user_id', 'id');
    }

    public function absensidetail()
    {
        return $this->hasOne('App\AbsensiDetail', 'absensi_id', 'id');
    }
}
