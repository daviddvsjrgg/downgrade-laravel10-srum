<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAudiosTable extends Migration
{
    public function up()
    {
        Schema::create('audios', function (Blueprint $table) {
            $table->id();
            $table->string('bahasa');
            $table->string('durasi')->nullable(); 
            $table->string('format');
            $table->unsignedBigInteger('collection_id');
            $table->longText('base64');
            $table->float('pitch')->default(0);           // Add pitch
            $table->float('speaking_rate')->default(1);   // Add speaking_rate
            $table->string('tipe_suara')->nullable();     // Add tipe_suara (voice type)
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('collection_id')->references('id')->on('collections')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('audios');
    }
}
