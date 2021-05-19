<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    public $timestamps = false;
    protected $table = 'laporan';
    protected $primaryKey = 'id';
    protected $fillable = ['ukm_id', 'pelatih_id', 'kehadiran', 'created_at'];

    public function ukm()
    {
        return $this->belongsTo('App\Ukm', 'ukm_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo('App\Users', 'pelatih_id', 'id');
    }
}
