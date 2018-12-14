<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PendapatanModel extends Model
{
    protected $table='pendapatan';
    
    public function daftar_lampiran(){
        return $this->belongsTo('App\DetailPendapatanModel','id','id_pendapatan');
    }
}
