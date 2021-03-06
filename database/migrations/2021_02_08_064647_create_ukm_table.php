<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUkmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ukm', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ukm');
            $table->string('pembina_id');
            $table->string('pelatih_id');
            $table->string('ketuamhs_id');
            $table->string('status');
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
        Schema::dropIfExists('ukm');
    }
}
