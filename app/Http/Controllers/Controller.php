<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

// ↓$name＝テーブル「users」につながるためのuse宣言
use Illuminate\Support\Facades\View;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){
    $this->middleware(function ($request, $next) {

        // viewに共通データを渡す $name＝テーブル「users」につながる
        View::share('name',Auth::user());


        // 自分がフォローしてる他ユーザーのカウント
        $follow = \DB::table('follows')
            ->where('follow_id',Auth::id())
            ->get(['follow_id']);
        $count_follow = count($follow);

         // 自分をフォローしている他ユーザー数
        $follower = \DB::table('follows')
        ->where('follower_id',Auth::id())
        ->get(['follow_id']);
        $count_follower = count($follower);

        View::share('count_follow',$count_follow);
        View::share('count_follower',$count_follower);


        return $next($request);
        });
    }

}
