<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ukm_id',0,1);
            $table->foreign('ukm_id')->references('id')->on('ukm');
            $table->string('user_id');
            $table->text('keterangan');
            $table->text('foto')->nullable();
            $table->text('kehadiran_pelatih')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensi');
    }
}
