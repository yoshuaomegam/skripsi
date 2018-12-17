<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pembiayaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembiayaan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pelaporan')->unsigned();
            $table->string('nama');
            $table->string('pembiayaan');
            $table->timestamps();
            
            $table->foreign('id_pelaporan')
            ->references('id')
            ->on('pelaporan')
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
