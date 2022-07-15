<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/top';

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    //MiddleWareを通すことで、各Controllerにアクセスされた際に
    //ログイン済だとログインページに飛べないようにする
    public function __construct()
    {
        //ログイン済み用Middleware"guest"を作成し、ログイン済でログインページに飛んだらトップページに転送されるようにする
        //->except...「除く」ということで、logoutはログイン中の’guest’ミドルウェアからは除く
        $this->middleware('guest')->except('logout');
    }





    // ログイン処理
    public function login(Request $request){
        // $request->isMethod(‘HTTP動詞’)...指定したHTTP動詞と一致していればtrueをそうでなければfalseを返す
        if($request->isMethod('post'))
        {
            //mailとpasswordの取得
            $data=$request->only('mail','password');

            if(Auth::attempt($data)) //取得したものとuserテーブルが照合していた場合(ログインが成功)
            {
                return redirect('/top');
            }
        }
        return view("auth.login");
    }

    // ログアウト機能
    public function logout(){
        Auth::logout();
        return redirect()->route("/login");
    }
}
