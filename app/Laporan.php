<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    public $timestamps = false;
    protected $table = 'laporan';
    protected $primaryKey = 'id';
    protected $fillable = ['absensi_id','ukm_id', 'pelatih_id', 'kehadiran'];

    public function ukm()
    {
        return $this->belongsTo('App\Ukm', 'ukm_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo('App\Users', 'pelatih_id', 'id');
    }

    public function absensi()
    {
        return $this->belongsTo('App\Absensi', 'absensi_id', 'id');
    }
}
