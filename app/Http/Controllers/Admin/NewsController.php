<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\News;
use App\History;
use Carbon\Carbon;

// クラスを使用
class NewsController extends Controller
{
  public function add()
  {
      return view('admin.news.create');
  }

public function create(Request $request)
  {
    
    // Varidationを行う
      $this->validate($request, News::$rules);
      $news = new News;
      $form = $request->all();
      
      // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
      if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $news->image_path = basename($path);
      } else {
          $news->image_path = null;
      }
      
      /*newsテーブルを保存するためには、残りの「title」と「body」に値を代入する必要があります。
      $form変数を使って代入したいのですが、これには

      ["title" => "タイトルの内容"
        "body" => "本文の内容"
        "_token" => "MRwPPawSebvocRdrOoLUrGo8ID6lTDRwfweenj3K"
        "image" => UploadedFile] 
        というデータが入っています。そこで不要な「_token」と「image」を削除します。*/
        
        // unsetというメソッドを使い、不要なデータを削除する。
        // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['image']);
      
      // カラムに代入するには、fillメソッドを使う。「title」「body」「image_path」の値にデータを入れる。
      $news->fill($form);
      // データベースに保存する
      $news->save();
      
      return redirect('admin/news/create');
   }
  
  //indexアクションを追加
  public function index(Request $request)
   {
     //$requestの中のcond_titleの値を$cond_titleに代入する。$requestにcond_titleがなければnullが代入されます。
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = News::where('title', $cond_title)->get();
      } else {
          // それ以外はすべてのニュースを取得する
          $posts = News::all();
      }
      return view('admin.news.index', ['posts' => $posts, 'cond_title' => $cond_title]);
     }
     
     public function edit(Request $request)
  {
      // News Modelからデータを取得する
      $news = News::find($request->id);
      if (empty($news)) {
        abort(404);    
      }
      return view('admin.news.edit', ['news_form' => $news]);
  }
  
    public function update(Request $request)
    {
        $this->validate($request, News::$rules);
        // News Modelからデータを取得する
        $news = News::find($request->id);
        // 送信されてきたフォームデータを格納する
        $news_form = $request->all();
        if ($request->remove == 'true') {
            $news_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $news_form['image_path'] = basename($path);
        } else {
            $news_form['image_path'] = $news->image_path;
        }

        unset($news_form['_token']);
        unset($news_form['image']);
        unset($news_form['remove']);
        // 該当するデータを上書きして保存する
        $news->fill($news_form)->save();

        // 以下を追記
        $history = new History;
        $history->news_id = $news->id;
        $history->edited_at = Carbon::now(); //Carbonという日付操作ライブラリを使用　use Carbon\Carbon；
        $history->save();

        return redirect('admin/news/');
    }

public function delete(Request $request)
  {
      // 該当するNews Modelを取得
      $news = News::find($request->id);
      // 削除する
      $news->delete();
      return redirect('admin/news/');
  }  
}