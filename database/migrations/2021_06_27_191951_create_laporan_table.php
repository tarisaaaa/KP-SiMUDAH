<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            // $table->string('absensi_id');
            $table->bigInteger('absensi_id',0,1);
            $table->foreign('absensi_id')->references('id')->on('absensi');
            $table->bigInteger('ukm_id',0,1);
            $table->foreign('ukm_id')->references('id')->on('ukm');
            $table->string('pelatih_id');
            $table->string('kehadiran');
            // $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan');
    }
}
