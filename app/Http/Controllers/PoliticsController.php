<?php
namespace App\Http\Controllers;

use App\PoliticsTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PoliticsController extends Controller
{
    public function save(Request $request)
    {
        try {
            $params = $request->all();
            $model = new PoliticsTitle();
            $model->title = $params['title'];
            $model->short_title = sprintf("%s-%s", mb_substr($params['title'], 0, 100), mb_strlen($params['title']));
            $model->options = json_encode($params['options'], JSON_UNESCAPED_UNICODE);
            $result = $params['result'];
            sort($result);
            $model->result = json_encode($result, JSON_UNESCAPED_UNICODE);
            $model->parse = $params['parse'];
            $result = $model->save();
            return $model;
        } catch (\Exception $e) {
            return ['msg' => '数据创建失败~'];
        }
    }
}