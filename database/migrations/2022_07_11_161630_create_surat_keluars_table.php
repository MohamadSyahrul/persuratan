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
            $table->date('tgl_fisiksurat');
            $table->string('kd_klasifikasi');
            $table->string('klasifikasi');
            $table->string('perihal');
            $table->string('tujuan_surat');
            $table->string('email_tujuan');
            $table->string('ukuran_hal');
            $table->integer('ukuran_ttd')->nullable();
            $table->string('orientasi_hal');
            $table->integer('m_atas')->nullable();
            $table->integer('m_bawah')->nullable();
            $table->integer('m_kanan')->nullable();
            $table->integer('m_kiri')->nullable();
            $table->integer('urutan');
            $table->longText('layout_konten_draft');
            $table->longText('layout_konten');
            $table->longText('layout_kop');
            $table->enum('status_surat', ['disetujui', 'ditolak', 'revisi', 'pending'])->default('pending');
            $table->enum('status_ttd', ['disetujui', 'ditolak', 'pending'])->default('pending');
            $table->string('revisi')->nullable();
            $table->boolean('read_validator')->default(0);
            $table->boolean('kirim_email')->default(0);
            $table->string('file_surat')->nullable();
            $table->unsignedBigInteger('id_pembuat');
            $table->unsignedBigInteger('id_validator');
            $table->unsignedBigInteger('id_ttd')->nullable();
            $table->timestamps();

            $table->foreign('id_pembuat')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_validator')->references('id')->on('users');
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
