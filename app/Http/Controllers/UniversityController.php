<?php

namespace App\Http\Controllers;

use App\CateSort;
use App\BranchSort;
use App\University;
use App\ProfessionSort;

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

    public function getItems($universityID, $sortType)
    {
        $model = null;
        switch ($sortType) {
            case 1: $model = new CateSort(); break;
            case 2: $model = new BranchSort(); break;
            case 3: $model = new ProfessionSort(); break;
        }
        $items = $model->where('university_id', '=', $universityID)
            ->orderBy('id', 'asc')
            ->get();
        return $items;
    }
}
