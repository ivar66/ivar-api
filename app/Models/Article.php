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

    // 类别 映射关系
    const CATEGORY_NAME = [
          '10' => '文章',
          '20' => '美食',
          '30' => '好物',
          '40' => '图片',
    ];
}
