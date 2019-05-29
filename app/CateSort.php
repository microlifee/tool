<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CateSort extends Model
{
    protected $connection = 'mysql-collage';
    // 指定表名
    protected $table = 'c_catalog_university_sort';
}
