<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profile;
use App\ProfileHistory;
use Carbon\Carbon;

class ProfileController extends Controller
{
    //以下を追記
    public function add()
    {
        return view('admin.profile.create');
    }
    
    public function create(Request $request)
    {
        //validationを行う
        $this->validate($request, Profile::$rules);
        $profile = new Profile;
        $form = $request->all();
        
        //フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        //データベースに保存する
        $profile->fill($form);
        $profile->save();
        
        return redirect('admin/profile');
    }
    
    public function edit(Request $request)
    {
        $profile = Profile::find($request->id);
        if(empty($profile)) {
            abort(404);
        }
        return view('admin.profile.edit',['profile_form' => $profile]);
    }
    
    public function update(Request $request)
    {
        //validationをかける
        $this->validate($request, Profile::$rules);
        // News Modelからデータを受け取る
        $profile = Profile::find($request->id);
        //送信されてきたフォームデータを格納する
        $profile_form = $request->all();
        unset($profile_form['_token']);
        
        //該当するデータを上書きして保存する
        $profile->fill($profile_form)->save();
        
        $profile_history = new ProfileHistory;
        $profile_history->profile_id = $profile->id;
        $profile_history->edited_at = Carbon::now();
        $profile_history->save();
        
        
        return redirect('admin/profile/');
    }
    
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title !='') {
            $posts = Profile::where('title',$cond_title)->get();
        } else {
            $posts = Profile::all();
        }
        return view('admin.profile.index',['posts' => $posts,'cond_title' => $cond_title]);
    }
    
    public function delete(Request $request)
    {
        $profile = Profile::find($request->id);
        $profile->delete();
        return redirect('admin/profile/');
    }
}

/*課題
1 Viewは何をするところでしょうか。簡潔に説明してみてください。
 controllerの指示で、アクセスしたきたユーザーのブラウザに表示するデータを生成する場所

2 プログラマーがHTMLを書かずにPHPなどのプログラミング言語やフレームワークを使う必要があるのはどういった理由でしょうか。
　Webpページの表示を、ログインしてきたユーザーに合わせた表示ができるようにするため。
　その設定を行うには、Mobile経由でデータベースのデータを取得し、htmlファイルにプログラミング言語やフレームワークを使用して
　記述する必要があるため。
　
3,4 前々章でAdmin/ProfileControllerのadd Action, edit Action に記述したコードに
　　それぞれどこのディレクトリに何というbladeファイルを設置すれば良いか考え、実際に作成する。*/