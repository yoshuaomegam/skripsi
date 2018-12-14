<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pendapatandesa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendapatan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pelaporan')->unsigned();
            $table->string('nama');
            $table->bigInteger('pendapatan');
            $table->string('tipe');
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
