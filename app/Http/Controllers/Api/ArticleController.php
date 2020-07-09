<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['list','detail']]);
    }
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

    /**
     * 新增文章
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request){
        $rules = [
            'title'             => 'required|max:50',
            'type'              => 'required|in:1,2',
            'category'          => 'required|in:10,20,30,40',
            'description'       => 'required|max:100',
            'key_words'         => 'required|max:20',
            'cover_images'      => 'required|max:80',
            'content'           => 'required',
        ];
        $attrs = [
            'title'             => '标题',
            'type'              => '文章类型',
            'category'          => '文章类别',
            'description'       => '简介',
            'key_words'         => '关键词',
            'cover_images'      => '封面图',
            'content'           => '内容',
        ];
        $this->validate($request, $rules, [], $attrs);
        $article_id = ArticleService::createArticle($request);
        return api_response(['id' => $article_id]);
    }

    /**
     * 修改文章
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(Request $request,$id){
        $rules = [
            'title'             => 'nullable|max:50',
            'type'              => 'nullable|in:1,2',
            'category'          => 'nullable|in:10,20,30,40',
            'description'       => 'nullable|max:100',
            'key_words'         => 'nullable|max:20',
            'cover_images'      => 'nullable|max:80',
            'content'           => 'nullable',
        ];
        $attrs = [
            'title'             => '标题',
            'type'              => '文章类型',
            'category'          => '文章类别',
            'description'       => '简介',
            'key_words'         => '关键词',
            'cover_images'      => '封面图',
            'content'           => '内容',
        ];
        $this->validate($request, $rules, [], $attrs);
        $article_id = ArticleService::updateArticleById($request,$id);
        return api_response(['id' => $article_id]);
    }

}
