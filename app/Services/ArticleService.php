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
            $lists[] = $objItem;
        }
        return ['total' => $total,'list' => $items];
    }

    /**
     * get article detail
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null|object
     */
    public static function getArticleDetailById($id){
        $itemDetail = Article::query()->where('id',$id)->first();
        return $itemDetail;
    }
}
