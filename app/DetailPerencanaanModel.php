<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPerencanaanModel extends Model
{
    protected $table='detail_perencanaan';
    protected $fillable=['id_perencanaan'];
    public function daftar_perencanaan(){
        return $this->belongsTo('App\PerencanaanModel','id_perencanaan', 'id');
       }
}
