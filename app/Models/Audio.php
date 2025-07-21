<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Audio extends Model
{
    use SoftDeletes, HasFactory;
    protected $table = 'audios';
    protected $fillable = [
        'bahasa',
        'durasi',
        'format',
        'collection_id',
        'base64',
        'pitch',
        'speaking_rate',
        'tipe_suara',
    ];

    /**
     * Relation to the Collection
     */
    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }
}
