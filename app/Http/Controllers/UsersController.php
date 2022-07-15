<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
//Authのユーザー情報
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    //

    // ユーザー一覧
    public function search(){

        //①usernameの取得：username
        $username = Auth::user();
        //②user_idの取得：user_id
        $user_id = Auth::id();
        //ユーザー一覧を返す
        $result = \DB::table('users')
            ->select('username','id','images')
            // ログインユーザー以外を抽出
            ->where('id', '<>', Auth::id())
            ->get();
        //チェック用のfollowerを取り出す
        $check1 = \DB::table('follows')
            ->where('follow_id',$user_id)
            ->select('follower_id')
            ->get()
            ->toArray();
        $check = array_column($check1,'follower_id');

            return view('users.search',[
                'username'=>$username,
                'user_id'=>$user_id,
                'result'=>$result,
                'check'=>$check,
            ]);

    }



            //ユーザー検索
            public function searching(Request $request){

                //検索フォームの入力を取得
                $search_word = $request->input('search');
        
                //usernameの取得：username
                $username = Auth::user();
                //user_idの取得：user_id
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
                //チェック用のfollowerを取り出す
                $check1 = \DB::table('follows')
                        ->where('follow_id',$user_id)//① ログイン中のユーザーをフォローしてることが条件
                        ->select('follower_id')//② ①のid
                        ->get()
                        ->toArray();
                $check = array_column($check1,'follower_id');


                //入力ありの場合
                //isset関数は、変数に値がセットされていて、かつNULLでないときに、TRUEを戻り値として返す
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
        
                //未入力の場合ユーザー一覧を返す
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

            // フォローボタン
            public function follow($id){
        
                \DB::table('follows')
                ->insert([
                    'follow_id' => Auth::id(),
                    'follower_id' => $id,
                ]);
        
                return redirect('/search');
            }
     
            //  *フォロー外すボタン
            public function unFollow($id){
        
                \DB::table('follows')
                    ->where('follow_id',Auth::id())
                    ->where('follower_id',$id)
                    ->delete();


            return redirect('/search');}



            // 他ユーザープロフィール
            public function viewProfile($id){

                // ①他ユーザーのプロフィールに表示する情報
                // アイコン画像, username, Bio自己紹介文, 投稿内容

                // ユーザーidと投稿内容を結合し情報を引っぱってくる
                $user = \DB::table('users')
                ->join('posts','users.id','=','posts.user_id')
                ->where('users.id',$id)
                ->select('users.id','users.username','users.mail','users.password','users.bio','users.images','posts.user_id','posts.posts','posts.created_at')
                //first():最初のレコードを返すメソッド。単一のレコードを取得したいときに使う
                ->first();

                // 他ユーザー投稿内容
                $user_post = \DB::table('users')
                ->join('posts','users.id','=','posts.user_id')
                ->where('users.id',$id)
                ->select('users.username','users.images','posts.user_id','posts.posts','posts.created_at')
                ->get();


                // ②フォローしてる場合→フォロー外すボタン、してない場合→フォローボタン
                //ログイン中のユーザーがフォローしてるidを抽出
                $check1 = \DB::table('follows')
                    ->where('follow_id',Auth::id())
                    ->select('follower_id')
                    ->get()
                    ->toArray();

                //array_column( array $list , 多様な型 $column_key)
                //第 1 引数( array $list )：多次元配列、またはオブジェクト配列
                //第 2 引数(多様な型 $column_key )：配列の値にしたいカラム。 NULL を指定すると、配列やオブジェクトを返す
                $check = array_column($check1,'follower_id');


                return view('users.otherprofile',[
                    'user' => $user,
                    'user_post' => $user_post,
                    'check' => $check,
                ]);
            }




            // ログインユーザーのプロフィルに表示する情報
            // username, mail address, password伏字, newpassword伏字, Bio自己紹介文, アイコン画像
            public function profile(Request $request){

                \DB::table('users')
                ->join('posts','users.id','=','posts.user_id')
                ->where('users.id',Auth::id())
                ->select('users.id','users.username','users.mail','users.password','users.bio','users.images','posts.user_id','posts.posts','posts.created_at')
                ->get();
                return view('users.profile');

            }



            //プロフィール更新
            public function updateprofile(Request $request){

                $rules = [
                    'username' => 'required|min:4|max:12',
                    'mail' => 'required|email|min:4|max:20',
                    'update_password' => 'nullable|min:4|max:12',
                    'bio' => 'max:200',
                ];
                //エラーメッセージ
                $message = [
                    'username.min' => 'ユーザー名は4文字以上で入力してください。',
                    'username.max' => 'ユーザー名は12文字以内で入力してください。',
                    'username.required' => 'ユーザー名は入力必須です。',
                    'mail.min' => 'メールアドレスは４文字以上で入力してください。',
                    'mail.max' => 'メールアドレスは12文字以内で入力してください。',
                    'mail.required' => 'メールアドレスは入力必須です。',
                    'mail.email' => 'アドレス形式で入力してください。',
                    'update_password.min' => 'パスワードは４文字以上で入力してください。',
                    'update_password.max' => 'パスワードは12文字以内で入力してください。',
                    'bio.max' => '自己紹介文は200文字以内で入力してください。',
                ];
        
        
                //validator作成
                $validator = Validator::make($request->all(), $rules, $message);
        
                //validation失敗した場合
                if($validator->fails()) {
                    return redirect('/profile')
                    ->withErrors($validator)
                    ->withInput();
                };


                $id = Auth::id();

                // 入力した内容を取得する
                $username = $request->input('username');
                $mail = $request->input('mail');
                $bio = $request->input('bio');
                $update_password = $request->input('update_password');
                $update_images = $request->file('update_images');

                // 画像を更新
                if(isset($update_images))
                {
                    //getClientOriginalName():アップロードしたファイルのオリジナル名を取得
                    $file_name = $update_images->getClientOriginalName();
                    //storeAs：アップロードしたファイル名または任意の名前を付ける。格納先はpublic
                    $update_images->storeAs('', $file_name, 'public');

                     // 更新処理
                    \DB::table('users')
                    ->where('id', Auth::id())
                    ->update([
                    'images' => $file_name,
                    ]);
                }else{

                    // return redirect('/profile');
                }

                // 新しいパスワードを入力した場合
                // usersテーブルのidと、inputを使って編集したidを一致させる。usersテーブルの各カラムに収納する
                if(isset($update_password)){

                    $update_password = $request->input('update_password');

                    \DB::table('users')
                    ->where('id', Auth::id())
                    ->update(
                        ['username' => $username,
                        'mail' => $mail,
                        'bio' => $bio,
                        'password' => bcrypt($update_password),　//bcrypt；ハッシュ化(暗号化)
                        ]);

                        return redirect('/profile');

                }else{
                // 入力が何も無いときパスワードは更新せず、他項目を更新する

                \DB::table('users')
                ->where('id', Auth::id())
                ->update(
                ['username' => $username,
                 'mail' => $mail,
                 'bio' => $bio,
                ]);

                return redirect('/profile');
                }
            }

}
