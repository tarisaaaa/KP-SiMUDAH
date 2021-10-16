<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    public $timestamps = false;
    protected $table = 'kegiatan';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_kegiatan', 'tanggal', 'keterangan', 'ukm_id'];

    public function ukm()
    {
        return $this->belongsTo('App\Ukm', 'ukm_id', 'id');
    }
}
