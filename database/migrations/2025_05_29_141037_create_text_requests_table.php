<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('text_requests', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nim');
            $table->string('prodi');
            $table->string('whatsapp');
            $table->unsignedBigInteger('audio_id');
            $table->string('status')->default('Belum Dikirim');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('audio_id')->references('id')->on('audios')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('text_requests');
    }
};
