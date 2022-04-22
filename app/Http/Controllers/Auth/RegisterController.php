<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/added';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:12|min:4',
            'mail' => 'required|string|email|max:50|min:4|unique:users',
            'password' => 'required|string|confirmed|regex:/^[0-9a-zA-Z]{4,12}+$/',
            'password_confirmation' => 'required'
        ],[
            'required' => 'この項目は必須です',
            'min' => '4文字以上入力',
            'username.max' => '12文字以内入力',
            'mail.max' => '50文字以内',
            'email' => 'メールアドレスを入力してください',
            'unique' => 'すでに使われているメールアドレスです',
            'confirmed' => 'パスワードが一致しません',
            'regex' => '半角英数文字、4文字以上12文字以内でお願いします'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }


    // public function registerForm(){
    //     return view("auth.register");
    // }

    public function register(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();

            $validator = $this->validator($data);
            if ($validator->fails()) {
                return redirect('/register')
                            ->withErrors($validator)
                            ->withInput();
            }

            $this->create($data);
            return redirect('added')->with('username',$data['username']);
        }
        return view('auth.register');
    }

    public function added(){
        return view('auth.added');
    }
}
