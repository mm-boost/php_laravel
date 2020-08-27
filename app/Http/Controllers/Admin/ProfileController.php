<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    //課題問題５
    //10章 ControllerとViewが連携 課題問題４
    public function add()
    {
        return view('admin.profile.create');
    }

    public function create()
    {
        return redirect('admin/profile/create');
    }

    //10章 ControllerとViewが連携 課題問題４
    public function edit()
    {
        return view('admin.profile.edit');
    }

    public function update()
    {
        return redirect('admin/profile/edit');
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
　　それぞれどこのディレクトリに何というbladeファイルを設置すれば良いか考え、実際に作成する。