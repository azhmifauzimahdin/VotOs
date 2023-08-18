<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratSuarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_suaras', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedSmallInteger('pemilih_id')->unique();
            $table->unsignedSmallInteger('kandidat_id');
            $table->smallInteger('perolehan_suara')->default(0);
            $table->integer('otp')->nullable();
            $table->timestamp('waktu_kadaluarsa')->nullable();
            $table->text('kode')->nullable();
            $table->text('qr_code')->nullable();
            $table->boolean('status')->default(false);
            $table->smallInteger('perhitungan_suara')->default(0);
            $table->timestamp('waktu')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_suaras');
    }
}
