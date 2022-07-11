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
        Schema::create('arsip_sk', function (Blueprint $table) {
            $table->id();
            $table->string('no_sk');
            $table->date('tgl_surat_fisik');
            $table->string('klasifikasi');
            $table->string('dari');
            $table->string('tujuan_surat');
            $table->string('email_tujuan')->nullable();
            $table->string('perihal');
            $table->string('ket')->nullable();
            $table->text('file');
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
        Schema::dropIfExists('arsip_s_k_s');
    }
};
