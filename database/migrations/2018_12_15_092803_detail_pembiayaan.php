<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetailPembiayaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pembiayaan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pembiayaan')->unsigned();
            $table->string('file')->nullable();
            $table->string('deskripsi')->nullable();
            $table->timestamps();
    
            $table->foreign('id_pembiayaan')
            ->references('id')
            ->on('pembiayaan')
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
        //
    }
}
