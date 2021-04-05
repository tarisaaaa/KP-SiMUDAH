<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbsensiDetail extends Model
{
    public $timestamps = false;
    protected $table = 'absensi_detail';
    protected $primaryKey = 'id';
    protected $fillable = ['absensi_id', 'anggota_id', 'status_absen', 'keterangan'];

    public function absensi()
    {
        return $this->belongsTo('App\Absensi', 'absensi_id', 'id');
    }

    public function anggota()
    {
        return $this->belongsTo('App\Anggota', 'anggota_id', 'id');
    }
}
