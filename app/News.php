<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //以下、titleとbodyのValidation設定を行う
    public static $rules = array(
        'title' => 'required',
        'body' => 'required',
    );
    
    protected $fillable = ['title','body']; //更新しても良い項目を指定する

    public function histories()
    {
      return $this->hasMany('App\History');  //hasMany()。newsテーブルに関連付いているhistoriesテーブルを全て取得するというメソッド 
                                             /*このメソッドを使って関連付いているレコードの一覧を取得しているのです。
                                             今回のHistoryテーブルは、Newsテーブルの変更履歴を記録するために利用されます。
                                             つまり、Newsテーブルが更新されるタイミングでHistoryテーブルが作成されるということになります。*/

    }
}