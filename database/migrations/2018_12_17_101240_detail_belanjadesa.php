<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetailBelanjadesa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_belanja', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_belanja')->unsigned();
            $table->string('file')->nullable();
            $table->string('deskripsi')->nullable();
            $table->timestamps();
    
            $table->foreign('id_belanja')
            ->references('id')
            ->on('belanja')
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
