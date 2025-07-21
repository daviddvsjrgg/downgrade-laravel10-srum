<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->string('judul_tugas_akhir');
            $table->string('nama_penulis');
            $table->string('nama_pembimbing');
            $table->string('program_studi');
            $table->string('fakultas');
            $table->year('tahun_terbit');
            $table->text('abstrak_indo');
            $table->text('abstrak_eng');
            $table->string('nomer_reg');
            $table->string('kata_kunci');
            $table->date('tanggal_unggah');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes(); // for soft deletes
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('collections');
    }
};
