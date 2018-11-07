<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pelaporan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelaporan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_desa')->unsigned();
            $table->year('tahun_perencanaan');
            $table->year('tahun_apbd');
            $table->timestamps();

            $table->foreign('id_desa')
            ->references('id')
            ->on('desa')
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
