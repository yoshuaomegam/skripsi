<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class DesaModel extends Model
{
   protected $table='desa';
   
   public function daftar_kecamatan(){
    return $this->belongsTo('App\KecamatanModel','id_kecamatan', 'id');
   }

   public function daftar_operator(){
    return $this->belongsTo('App\User','id_operator', 'id');
   }

}
