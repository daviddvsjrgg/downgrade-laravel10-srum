<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TextRequest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nama',
        'nim',
        'prodi',
        'whatsapp',
        'audio_id',
        'status',
    ];

    public function audio()
    {
        return $this->belongsTo(Audio::class);
    }
}
