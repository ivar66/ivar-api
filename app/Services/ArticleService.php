<?php
/*
* a file of article
*
* (c) ivar <625079860@qq.com>
* 
* Date: 2020/7/8 下午3:09
* 
* This source file is subject to the MIT license that is bundled with this source code in the file LICENSE.
*/
namespace App\Services;

use App\Models\Article;
use Exception;
use Illuminate\Http\Request;

class ArticleService{

    /**
     * 文章列表
     * @param $request
     * @return array
     */
    public static function getArticleList($request){
        $obj = Article::query();
        $perPage = $request->input('per_page',10);
        $total = $obj->count();
        $items = $obj->orderBy('created_at','desc')->paginate($perPage);
        $lists = [];
        foreach ($items as $item){
            $objItem =  $item->setVisible(['id','title','type','category','description','key_words','cover_images','content','read_number'])->toArray();
            $objItem['category_name'] = Article::CATEGORY_NAME[$objItem['category']] ?? '其它';
            $objItem['publish_time'] = $item->created_at->format('Y-m-d H:i:s');
            $lists[] = $objItem;
        }
        return ['total' => $total,'list' => $lists];
    }

    /**
     * 文章详情
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null|object
     */
    public static function getArticleDetailById($id){
        $itemDetail = Article::query()->where('id',$id)->first();
        $itemDetail->publish_time = $itemDetail->created_at->format('Y-m-d H:i:s');
        $itemDetail->category_name = Article::CATEGORY_NAME[$itemDetail->category] ?? '其它';
        return $itemDetail;
    }

    /**
     * 新增文章
     * @param $request
     * @return mixed
     */
    public static function createArticle(Request $request){
        $obj = new Article();
        $obj->title = $request->input('title');
        $obj->type = $request->input('type',1);
        $obj->category = $request->input('category',10);
        $obj->description = $request->input('description','');
        $obj->key_words = $request->input('key_words','');
        $obj->cover_images = $request->input('cover_images','');
        $obj->content = $request->input('content','');
        $obj->save();
        return $obj->id;
    }

    /**
     * @param Request $request
     * @param $id 文章的ID
     * @return mixed
     * @throws Exception
     */
    public static function updateArticleById(Request $request,$id){
        $objArticle = Article::query()->where('id',$id)->first();
        if (empty($objArticle)){
            throw new Exception('不存在该文章，不可修改');
        }
        if ($title = $request->input('title')){
            $objArticle->title = $title;
        }
        if ($type = $request->input('type')){
            $objArticle->type = $type;
        }
        if ($category = $request->input('category')){
            $objArticle->category = $category;
        }
        if ($description = $request->input('description')){
            $objArticle->description = $description;
        }
        if ($key_words = $request->input('key_words')){
            $objArticle->key_words = $key_words;
        }
        if ($cover_images = $request->input('cover_images')){
            $objArticle->cover_images = $cover_images;
        }
        if ($content = $request->input('content')){
            $objArticle->content = $content;
        }
        $objArticle->save();
        return $objArticle->id;
    }
}
