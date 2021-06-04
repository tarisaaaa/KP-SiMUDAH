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
        Schema::create('absensi_detail', function (Blueprint $table) {
            $table->id();
            // $table->string('absensi_id');
            $table->unsignedBigInteger('absensi_id');
            $table->foreign('absensi_id')
                ->references('id')->on('absensi')
                ->onDelete('cascade');
            $table->string('anggota_id');
            $table->enum("status_absen", ['H', 'I', 'A']);
            $table->text('keterangan');
            //$table->timestamps();
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
