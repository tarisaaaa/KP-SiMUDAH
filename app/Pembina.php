<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembina extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'pembinaview';

    public function ukm()
    {
        return $this->hasMany('App\Ukm', 'pembina_id', 'id');
    }
}
