<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKandidatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kandidats', function (Blueprint $table) {
            $table->smallIncrements('nomor');
            $table->string('nama', 40);
            $table->string('kelas', 30);
            $table->string('jenis_kelamin', 10);
            $table->string('tempat_lahir', 30);
            $table->date('tanggal_lahir');
            $table->string('jabatan_sebelumnya', 30);
            $table->text('alamat');
            $table->string('foto', 80)->nullable();
            $table->text('visi');
            $table->text('misi');
            $table->string('slug', 50)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kandidats');
    }
}
