@extends('layouts.logout')

@section('content')


<div class="added">

    <p class="name"> {{session('username')}}さん</p>
    <p>ようこそ！DAWNSNSへ！</p>
    <br>


    <p>ユーザー登録が完了しました。<br>
    さっそく、ログインをしてみましょう。</p>



    <p class="btn"><a class="btn_link" href="/login">ログイン画面へ</a></p>
</div>

@endsection