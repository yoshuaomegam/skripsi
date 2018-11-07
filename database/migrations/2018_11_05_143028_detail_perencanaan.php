<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetailPerencanaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('detail_perencanaan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_perencanaan')->unsigned();
            $table->string('nama');
            $table->bigInteger('perencanaan')->nullable();
            $table->string('tipe');
            $table->string('mulai')->nullable();
            $table->string('estimasiselesai')->nullable();
            $table->timestamps();

            $table->foreign('id_perencanaan')
            ->references('id')
            ->on('perencanaan')
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
