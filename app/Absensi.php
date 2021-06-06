<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    public $timestamps = false;
    protected $table = 'absensi';
    protected $primaryKey = 'id';
    protected $fillable = ['ukm_id', 'user_id', 'keterangan', 'foto', 'created_at'];

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
        return $this->hasMany('App\AbsensiDetail', 'absensi_id', 'id');
    }

    public function laporan()
    {
        return $this->hasMany('App\Laporan', 'absensi_id', 'id');
    }
}
