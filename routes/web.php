<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

//ログイン処理
Route::get('/login', 'Auth\LoginController@login')->name('/login');
Route::post('/login', 'Auth\LoginController@login');

// ログアウト機能
Route::get('/logout','Auth\LoginController@logout');

// 新規ユーザー作成
Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');


//ログイン中のページ
Route::get('/top','PostsController@index');


//top画面の表示
Route::get('/index','PostsController@index');

// 投稿機能
Route::post('/post/create','PostsController@create');

// 削除機能
Route::get('/post/{id}/delete', 'PostsController@delete');

//編集機能
Route::get('post/{id}/update-form', 'PostsController@update');
Route::post('/post/update','PostsController@update');

// ログイン中ユーザーのプロフィール
Route::get('/profile','UsersController@profile');
// 他ユーザーのプロフィール
Route::get('/{id}/otherprofile','UsersController@viewProfile');

// 検索
Route::get('/search','UsersController@search');
Route::post('/searching','UsersController@searching');

Route::get('/follow-list','PostsController@index');
Route::get('/follower-list','PostsController@index');


//フォロー機能
Route::get('/{id}/follow','UsersController@follow');
Route::get('/{id}/unFollow','UsersController@unFollow');


// フォロー・フォロワー一覧
Route::get('/followList','FollowsController@followList');
Route::get('/followerList','FollowsController@followerList');

