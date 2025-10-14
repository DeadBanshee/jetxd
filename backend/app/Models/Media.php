<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'releaseDate',
        'hasEpisodes',
        'image_path',
    ];

    // Se quiser, pode customizar o nome da tabela, caso seja diferente do padrão "media"
    // protected $table = 'media';
}
