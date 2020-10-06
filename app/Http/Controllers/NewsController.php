<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;
use App\News;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        //News::all()はEloquentを使った、全てのnewsテーブルを取得するメソッド
        //sortByDesc()は、カッコの中の値（キー）でソート（並び替え）するメソッド→('updated_at')；で投稿日時順に並べる
        $posts = News::all()->sortByDesc('updated_at');  

        //shift()は、配列の最初のデータを削除し、その値を返すメソッド。
        //最新の記事を変数$headlineに代入し、$postsは代入された最新の記事以外の記事が格納されている。
        if (count($posts) > 0) {
            $headline = $posts->shift();
        } else {
            $headline = null;
        }

        // news/index.blade.php ファイルを渡している
        // また Viewテンプレートに headline、 posts、という変数を渡している
        return view('news.index', ['headline' => $headline, 'posts' => $posts]);
    }
}
