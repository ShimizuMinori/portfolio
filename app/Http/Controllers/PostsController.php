<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//Authのユーザー情報を受け取る
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function create(Request $request)
    {
        // バリデーションチェック
        $request->validate([
            'newPost' => 'required|max:100',
        ]);


        // ブラウザ上で入力したつぶやき情報
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

    //
    public function index(){

        //ログインユーザーの情報を取得
        Auth::user();
        // //②user_idの取得：user_id
        Auth::id();


        // つぶやきを格納したDBのpostsテーブルからデータを持ってくる
        $list= \DB::table('posts')
        ->join('users','posts.user_id','=','users.id')
        // selectを使ってブラウザへ表示するデータを指定
        ->select('users.username','users.images','posts.id','posts.user_id','posts.posts', 'posts.created_at','images')
        ->distinct()

        // ->where('follows.follow_id',Auth::id())

        ->orWhere('users.id',Auth::id())
        // orderByを使ってブラウザへ表示する投稿内容の並順を指定
        ->orderBy('posts.posts', 'DESC')
        // getを使って上記で定義した投稿内容を取得
        ->get();
        // return viewを使って、ページの遷移先を指定し、ビュー側に値を渡す
        return view('posts.index',['list'=>$list]);}


    // 投稿したつぶやきの削除機能
    public function delete($id){
        \DB::table('posts')
        ->where('id',$id)
        ->delete();

        return redirect('/top');
    }


    // 編集処理
    public function update(Request $request)
    {

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
