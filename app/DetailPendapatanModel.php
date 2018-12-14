<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPendapatanModel extends Model
{
    protected $table='detail_pendapatan';
    protected $fillable=['deskripsi'];
    public function daftar_lampiran(){
        return $this->hasOne('App\PendapatanModel');
    }
}
