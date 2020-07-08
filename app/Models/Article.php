<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'type','category', 'description','key_words','cover_images','read_number','content'
    ];

    protected $table = 'articles';
}
