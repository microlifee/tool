<?php

namespace App\Http\Controllers;

use App\Profession;

class ProfessionController extends Controller
{
    // 专业列表
    public function index()
    {
        $items = Profession::all(['id', 'name']);
        return $items;
    }
}
