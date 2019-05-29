<?php

namespace App\Http\Controllers;

use App\University;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    // 院校列表
    public function index()
    {
        $items = University::all(['id', 'title']);
        return $items;
    }

    //
    public function sort(Request $request)
    {
        $params = $request->all();
        return $params;
    }
}
