<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // 指定表名
    protected $table = 'p_books';
    // 允许填充的字段
    protected $fillable = ['title', 'short', 'thumb', 'avg'];
    // 隐藏字段
    protected $hidden = ['deleted_at'];
}
