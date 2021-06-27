<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateVAbsensiHarian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW v_absensi_harian AS (
            select a.id AS id,a.ukm_id AS ukm_id,u.nama_ukm AS nama_ukm,sum(ad.status_absen = 'H') / count(0) AS rata_rata,sum(ad.status_absen = 'H') AS jumlah_hadir,count(0) AS total_absensi,a.created_at AS created_at from ((dbsiukm.absensi_detail ad left join dbsiukm.absensi a on(a.id = ad.absensi_id)) left join dbsiukm.ukm u on(u.id = a.ukm_id)) group by a.id
        )");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW v_absensi_harian");
    }
}
