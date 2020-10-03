<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //以下、名前(name)、性別(gender)、趣味(hobby)、自己紹介(introduction)のValidation設定を行う
    public static $rules = array(
        'name' => 'required',
        'gender' => 'required',
        'hobby' => 'required',
        'introduction' => 'required',
    );
    protected $fillable = ['name','gender','hobby','introduction']; 
}