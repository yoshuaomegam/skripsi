<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembiayaanModel extends Model
{
    protected $table="pembiayaan";
    protected $fillable=['deskripsi'];
}
