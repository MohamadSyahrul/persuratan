<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disposisis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_surat')->references('id')->on('surat_keluars')->onUpdate('cascade')->onDelete('cascade');
            $table->string('kode_disposisi');
            $table->date('batas_waktu');
            $table->string('status_disposisi');
            $table->string('catatan');
            $table->unsignedBigInteger('id_level');
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
        Schema::dropIfExists('disposisis');
    }
};
