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
        Schema::create('surat_keluars', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat');
            $table->date('tgl_surat');
            $table->string('perihal');
            $table->string('sifat');
            $table->enum('status_surat', ['disetujui', 'ditolak', 'pending'])->default('pending');
            $table->enum('status_ttd', ['disetujui', 'ditolak', 'pending'])->default('pending');
            $table->text('dokumen')->nullable();
            $table->unsignedBigInteger('id_penerima');
            $table->unsignedBigInteger('id_pembuat');
            $table->unsignedBigInteger('id_klasifikasi');
            $table->unsignedBigInteger('id_ttd')->nullable();
            $table->timestamps();

            $table->foreign('id_penerima')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_pembuat')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_ttd')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_keluars');
    }
};
