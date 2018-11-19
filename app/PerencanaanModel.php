<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerencanaanModel extends Model
{
    protected $table='perencanaan';
    protected $fillable= ['id','total_penerimaan','sumber'];

}
