<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleControoler extends Controller
{
    /**
     * 文章页面列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request){
        $res = ArticleService::getArticleList($request);
        return api_response($res);
    }

    /**
     * 文章详情
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail(Request $request,$id){
        $item = ArticleService::getArticleDetailById($id);
        // 阅读数+1
        if (!empty($item)){
            $item->increment('read_number');
        }
        return api_response($item);
    }
}
