<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Authのユーザー情報
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //

    public function search(){

                //①usernameの取得：username
                $username = Auth::user();
                //②user_idの取得：user_id
                $user_id = Auth::id();
                //フォローしている人のidの取得、カウント：int
                $follow = \DB::table('follows')
                ->where('follow_id',$user_id)
                ->get(['follower_id']);
                $count_follow = count($follow);
                //フォローされている人のidの取得、カウント：int
                $follower = \DB::table('follows')
                ->where('follower_id',$user_id)
                ->get(['follow_id']);
                $count_follower = count($follower);
                //ユーザー一覧を返す
                $result = \DB::table('users')
                        ->select('username','id','images')
                        ->get();
                        // dd($pre_result);
                //チェック用のfollowerを取り出す
                $check1 = \DB::table('follows')
                        ->where('follow_id',$user_id)
                        ->select('follower_id')
                        ->get()
                        ->toArray();
                        // dd($check1);
                $check = array_column($check1,'follower_id');
                        // dd($check);
        
        
                return view('users.search',[
                    'username'=>$username,
                    'user_id'=>$user_id,
                    'count_follow'=>$count_follow,
                    'count_follower'=>$count_follower,
                    'result'=>$result,
                    'check'=>$check,
                ]);
        
            }
        
            /**
             * 検索機能
             * 引数は検索フォーム
             */
            public function searching(Request $request){
        
                //検索フォームの入力を抽出
                $search_word = $request->input('search');
        
                //①usernameの取得：username
                $username = Auth::user();
                //②user_idの取得：user_id
                $user_id = Auth::id();
                //⑥フォローしている人のidの取得、カウント：int
                $follow = \DB::table('follows')
                ->where('follow_id',$user_id)
                ->get(['follower_id']);
                $count_follow = count($follow);
                //⑦フォローされている人のidの取得、カウント：int
                $follower = \DB::table('follows')
                ->where('follower_id',$user_id)
                ->get(['follow_id']);
                $count_follower = count($follower);
                //⑨チェック用のfollowerを取り出す
                $check1 = \DB::table('follows')
                        ->where('follow_.d',$user_id)
                        ->select('follower_id')
                        ->get()
                        ->toArray();
                $check = array_column($check1,'follower_id');
        
        
                //入力ありの場合
                //issetはnullが偽
                if(isset($search_word)){
                    //検索
                    $result = \DB::table('users')
                        ->where('username','like','%'.$search_word.'%')
                        ->get();
        
                    return view('users.search',[
                        'search_word'=>$search_word,
                        'username'=>$username,
                        'result' => $result,
                        'count_follow'=>$count_follow,
                        'count_follower'=>$count_follower,
                        'check'=>$check,
                    ]);
                }
        
                //未入力でユーザー一覧を返す
                $result = \DB::table('users')
                        ->select('username','images','id')
                        ->get();
        
                return view('users.search',[
                    'search_word'=>$search_word,
                    'username'=>$username,
                    'result' => $result,
                    'count_follow'=>$count_follow,
                    'count_follower'=>$count_follower,
                    'check'=>$check,
                ]);
            }
        
            /**
             * フォローボタン
             *
             */
            public function follow($id){
        
                \DB::table('follows')->insert([
                    'follow_id' => Auth::id(),
                    'follower_id' => $id,
                ]);
        
                return redirect('/search');
            }
        
            /**
             * フォロー外すボタン
             *
             */
            public function unFollow($id){
        
                \DB::table('follows')
                    ->where('follow_id',Auth::id())
                    ->where('follower_id',$id)
                    ->delete();


        return view('users.search');
    }
}
