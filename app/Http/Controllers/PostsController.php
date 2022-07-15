<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//Authのユーザー情報を受け取る
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class PostsController extends Controller
{
    //①投稿機能
    public function create(Request $request)
    {
        //バリデーション
        //例文：$request->validate(['name属性' => '検証条件1|検証条件2|...']);
        $request->validate([
            'newPost' => 'required|max:100',
        ]);


        // ブラウザ上で入力したつぶやき情報
        //$request->input(‘キー名’, ‘デフォルト値’)...指定したキー名のキーと値を取得
        $post = $request->input('newPost');

        //現在ログイン中のユーザーidを取得
        $id = Auth::id();

        // 変数の情報をデータベースへ格納
        \DB::table('posts')->insert([
            'posts' => $post,
            'user_id' => $id,
            'created_at' => now(),
        ]);

        return redirect('top');
    }

    //②投稿内容を表示
    public function index(){

        //ログインユーザーの情報を取得
        Auth::user();
        //ユーザーidを取得
        Auth::id();


        // つぶやきを格納したDBのpostsテーブルからデータを持ってくる
        $list= \DB::table('posts')
        // joinを使って2つのテーブルを結合
        ->join('users','posts.user_id','=','users.id')
        // selectを使ってブラウザへ表示するデータを指定
        ->select('users.username','users.images','posts.id','posts.user_id','posts.posts', 'posts.created_at','images')
        // distinctを使い重複レコード(データ行)を1つにまとめること
        ->distinct()
        // whereを使って条件指定：ログインid = usersテーブルのid
        ->where('users.id',Auth::id())
        // orderByを使ってブラウザへ表示する投稿内容の並順を指定
        ->orderBy('created_at', 'DESC')
        // getを使って上記で定義した投稿内容を取得
        ->get();
        // return viewを使って、ページの遷移先を指定し、ビュー側に値を渡す
        return view('posts.index',['list'=>$list]);}


    // ③投稿したつぶやきの削除機能
    public function delete($id){
        \DB::table('posts')
        ->where('id',$id)
        ->delete();

        return redirect('/top');
    }


    // ④編集処理
    public function update(Request $request)
    {
        $rules = ['update' => 'max:200'];
        $message = ['update' => '200文字以内で入力してください。',];

        //validator作成
        //$validator=Validator::make(値の配列,ルール配列,エラーメッセージ配列);
        //第1引数:チェックする値をまとめた配列,第2引数:検証ルール,第3引数:エラー
        $validator = Validator::make($request->all(), $rules, $message);

        if($validator->fails())//validation失敗した場合
        {
        return redirect('/index')//redirectで指定のアドレス/indexへ移動する
            ->withErrors($validator)//引数の値を$errors変数へ保存してリダイレクト先まで引き継ぐ
            ->withInput();//送信されたフォームの値をInput::old()へ引き継ぐ
        };


        //現在ログイン中のユーザーidを取得
        $id = Auth::id();

        // $requestからinputを使ってつぶやきのidを抽出。
        $post_id = $request->input('updateid');
        // $requestからinputを使ってupPost'（更新したつぶやき）を抽出。
        $up_post = $request->input('update');

        // postsテーブルのつぶやきのidと、inputを使って抽出したつぶやきのidをが一致するつぶやきをpostsテーブルの各カラムに収納する
        \DB::table('posts')
            ->where('id', $post_id)
            ->update(
                ['posts' => $up_post,
                'updated_at' => now()]
            );

        return redirect('/index');
    }
}
