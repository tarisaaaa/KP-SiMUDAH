<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbsensiDetail extends Model
{
    protected $table = 'absensi_detail';
    protected $primaryKey = 'id';
    protected $fillable = ['absensi_id', 'anggota_id', 'status_absensi', 'keterangan'];

    public function absensi()
    {
        return $this->belongsTo('App\Absensi', 'absensi_id', 'id');
    }

    public function anggota()
    {
        return $this->belongsTo('App\Anggota', 'anggota_id', 'id');
    }
}
