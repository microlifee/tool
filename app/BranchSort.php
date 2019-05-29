<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BranchSort extends Model
{
    protected $connection = 'mysql-collage';
    // 指定表名
    protected $table = 'c_branch_university_sort';
}
