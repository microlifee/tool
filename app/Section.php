<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    // 指定表名
    protected $table = 'p_section';
    // 允许填充的字段
    protected $fillable = ['book_id', 'prefix', 'title', 'extra'];
    // 隐藏字段
    protected $hidden = ['deleted_at'];

    // 关联“Book”模型
    public function parent()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
