<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedSmallInteger('user_id');
            $table->unsignedSmallInteger('surat_suara_id')->default(0);
            $table->string('ketua')->nullable();
            $table->string('sekretaris')->nullable();
            $table->string('kesiswaan')->nullable();
            $table->string('pembina')->nullable();
            $table->string('kepala_sekolah')->nullable();
            $table->smallInteger('jumlah_pemilih')->default(0);
            $table->smallInteger('jumlah_kandidat')->default(0);
            $table->smallInteger('jumlah_belum_memilih')->default(0);
            $table->smallInteger('jumlah_sudah_memilih')->default(0);
            $table->text('kode')->nullable();
            $table->text('qr_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporans');
    }
}
