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
        Schema::create('arsip_suratmasuk', function (Blueprint $table) {
            $table->id();
            $table->string('no_sm');
            $table->date('surat_diterima');
            $table->date('surat_fisik');
            $table->string('klasifikasi');
            $table->string('dari');
            $table->string('tujuan_surat');
            $table->unsignedBigInteger('id_user');
            $table->string('email_tujuan')->nullable();
            $table->string('perihal');
            $table->string('ket')->nullable();
            $table->string('file');
            $table->boolean('read')->default(0);
            $table->timestamps();
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arsips');
    }
};
