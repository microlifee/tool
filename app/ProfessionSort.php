<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfessionSort extends Model
{
    protected $connection = 'mysql-collage';
    // 指定表名
    protected $table = 'c_profession_university_sort';
}
