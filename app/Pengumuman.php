<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'pengumuman';
    protected $fillable = ['ukm_id', 'judul', 'isi', 'nama', 'created_at'];

    public function ukm()
    {
        return $this->belongsTo('App\Ukm', 'ukm_id', 'id');
    }
}
