<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Desa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->integer('id_kecamatan')->unsigned();
            $table->string('logo')->nullable();
            $table->string('nama_kades')>nullable();
            $table->string('foto_kades')->nullable();
            $table->integer('id_operator')->unsigned();
            $table->timestamps();

            $table->foreign('id_kecamatan')
            ->references('id')
            ->on('kecamatan')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('id_operator')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
