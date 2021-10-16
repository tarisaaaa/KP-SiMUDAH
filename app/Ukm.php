<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ukm extends Model
{
    public $timestamps = false;
    protected $table = 'ukm';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_ukm', 'pembina_id', 'pelatih_id', 'ketuamhs_id', 'status'];

    public function pelatih()
    {
        return $this->belongsTo('App\Pelatih', 'pelatih_id', 'id');
    }

    public function pembina()
    {
        return $this->belongsTo('App\Pembina', 'pembina_id', 'id');
    }

    public function ketuamhs()
    {
        return $this->belongsTo('App\Ketuamhs', 'ketuamhs_id', 'id');
    }

    public function jadwal()
    {
        return $this->hasMany('App\Jadwal', 'ukm_id', 'id');
    }

    public function kegiatan()
    {
        return $this->hasMany('App\Kegiatan', 'ukm_id', 'id');
    }
    
    public function anggota()
    {
        return $this->hasMany('App\Anggota', 'ukm_id', 'id');
    }

    public function pengumuman()
    {
        return $this->hasMany('App\Pengumuman', 'ukm_id', 'id');
    }

    public function absensi()
    {
        return $this->hasMany('App\Absensi', 'ukm_id', 'id');
    }

    public function laporan()
    {
        return $this->hasMany('App\Laporan', 'ukm_id', 'id');
    }
}
