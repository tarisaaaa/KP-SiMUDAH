<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensiDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('absensi_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('absensi_id');
            $table->foreign('absensi_id')
                ->references('id')->on('absensi')
                ->onDelete('cascade');
            $table->bigInteger('anggota_id',0,1);
            $table->foreign('anggota_id')->references('id')->on('anggota');
            $table->enum("status_absen", ['H', 'I', 'A']);
            $table->text('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensi_detail');
    }
}
