<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    //
    public function myMemo($user_id){
        $tag = \Request::query('tag');
        // タグがなければ、その人が持っているメモを全て取得
        if(empty($tag)){
            return $this::select('memos.*')->where('user_id', $user_id)->where('status', 1)->get();      
        }else{
        // もしタグの指定があればタグで絞る ->wher(tagがクエリパラメーターで取得したものに一致)
          $memos = $this::select('memos.*')
              ->leftJoin('tags', 'tags.id', '=','memos.tag_id')
              ->where('tags.name', $tag)
              ->where('tags.user_id', $user_id)
              ->where('memos.user_id', $user_id)
              ->where('status', 1)
              ->get();
          return $memos;
        }
    }
}
