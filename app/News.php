<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //以下を追記
    public static $rules = array(
        'title' => 'required',
        'body' => 'required',
    );
    
    protected $fillable = ['title','body']; //更新しても良い項目を指定する
}