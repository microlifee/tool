<?php

namespace App\Http\Controllers;

use App\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    //
    public function index()
    {
        $list = Section::with(['parent'])->get();

        // 数据分类
        $returnData = [];
        foreach ($list as $item) {
            $key = $item->parent->id - 1;
            // 判断 $key 是否存在
            if (array_key_exists($key, $returnData)) {
                $returnData[$key]['id'] = $item->parent->id;
                $returnData[$key]['title'] = $item->parent->title;
                $returnData[$key]['short'] = $item->parent->short;
                $returnData[$key]['avg'] = $item->parent->avg;
                $returnData[$key]['updated_at'] = $item->parent->updated_at;
            }
            unset($item['parent']);
            $returnData[$key]['children'][] = $item;
        }
        return $returnData;
    }
}
