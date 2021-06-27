<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            //$table->timestamps();
            $table->string('nama_anggota');
            $table->string('npm');
            $table->string('nohp');
            $table->string('email');
            $table->bigInteger('ukm_id',0,1);
            $table->foreign('ukm_id')->references('id')->on('ukm');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anggota');
    }
}
