<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetailPendapatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pendapatan', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('id_pendapatan')->unsigned();
        $table->string('file')->nullable();
        $table->bigInteger('deskripsi')->nullable();
        $table->timestamps();

        $table->foreign('id_pendapatan')
        ->references('id')
        ->on('pendapatan')
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
