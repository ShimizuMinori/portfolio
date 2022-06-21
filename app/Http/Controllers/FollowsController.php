<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    //
    public function followList(){

        $username = Auth::user();

        // 自分がフォローしてる他ユーザーのカウント
        $follow = \DB::table('follows')
            ->where('follow_id','Auth::id()')
            ->get(['follow_id']);
        $count_follow = count($follow);


        // 自分をフォローしている他ユーザー数
        $follower = \DB::table('follows')
            ->where('follower_id','Auth::id()')
            ->get(['follow_id']);
        $count_follower = count($follower);

        // フォローリスト：id,images,posts,create_atの情報を抽出
        $list = \DB::table('users')
            ->join('follows','users.id','=','follows.follower_id')
            ->join('posts','users.id','=','posts.user_id')
            ->select('users.id','users.images','users.username','posts.created_at','posts.posts')
            ->where('follows.follow_id',Auth::id())
            ->orderBy('posts.created_at','desc')
            ->get();        

        // フォローしてるアイコン
        $images = \DB::table('users')
            ->join('follows','users.id','=','follows.follower_id')
            ->select('users.id','users.images')
            ->where('follows.follow_id',Auth::id())
            ->get();


        return view('follows.followList',[
            'username' => $username,
            'list' => $list,
            'images' => $images,
        ]);
    }




    public function followerList(){

        // 自分をフォローしている他ユーザー数
        $follower = \DB::table('follows')
            ->where('follower_id',Auth::id())
            ->get(['follow_id']);
        $count_follower = count($follower);


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
