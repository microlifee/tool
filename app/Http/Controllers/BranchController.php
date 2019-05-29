<?php

namespace App\Http\Controllers;

use App\Branch;

class BranchController extends Controller
{
    // 一级学科列表
    public function index()
    {
        $items = Branch::all(['id', 'name']);
        return $items;
    }
}
