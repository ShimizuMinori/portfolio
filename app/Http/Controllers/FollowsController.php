<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    //
    public function followList(){


        // フォローリスト：id,images,posts,create_atの情報を抽出
        $list = \DB::table('users')
            ->join('follows','users.id','=','follows.follower_id') //フォローされる側のid,user.idを一致させ結合
            ->join('posts','users.id','=','posts.user_id') //users.idとpost.idを一致させ結合
            ->select('users.id','users.images','users.username','posts.created_at','posts.posts')
            ->where('follows.follow_id',Auth::id()) //フォローする側=ログインユーザー
            ->orderBy('posts.created_at','desc')
            ->get();

        // フォローユーザーのアイコン
        $images = \DB::table('users')
            ->join('follows','users.id','=','follows.follower_id')
            ->select('users.id','users.images')
            ->where('follows.follow_id',Auth::id())
            ->get();


        return view('follows.followList',[
            'list' => $list,
            'images' => $images,
        ]);
    }




    public function followerList(){

        // フォロワーリスト：id,images,posts,create_atの情報を抽出
        $list = \DB::table('users')
            ->join('follows','users.id','=','follows.follow_id')
            ->join('posts','users.id','=','posts.user_id')
            ->select('users.id','users.images','users.username','posts.created_at','posts.posts')
            ->where('follows.follower_id',Auth::id())
            ->orderBy('posts.created_at','desc')
            ->get();


        // フォローしてるアイコン
        $images = \DB::table('users')
            ->join('follows','users.id','=','follows.follow_id')
            ->select('users.id','users.images')
            ->where('follows.follower_id',Auth::id())
            ->get();

        
        return view('follows.followerList',[
            'list' => $list,
            'images' => $images,
        ]);
    }
}
