<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collection extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'collections';

    protected $fillable = [
        'judul_tugas_akhir',
        'nama_penulis',
        'nama_pembimbing',
        'program_studi',
        'fakultas',
        'tahun_terbit',
        'abstrak_indo',
        'abstrak_eng',
        'nomer_reg',
        'kata_kunci',
        'tanggal_unggah',
        'status',
    ];

   protected $casts = [
        'deleted_at' => 'datetime',
        'tanggal_unggah' => 'date',
    ];

}
