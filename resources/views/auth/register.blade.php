@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<h2>新規ユーザー登録</h2>

<p>Username<br>
{{ Form::label('ユーザー名') }}
{{ Form::text('username',null,['class' => 'input',"placeholder"=>"dawntown"]) }}
</p>
@if($errors->has('username'))
<p>{{$errors->first('username')}}</p>
@endif

<p>Mail Adress<br>
{{ Form::label('メールアドレス') }}
{{ Form::text('mail',null,['class' => 'input',"placeholder"=>"dawn@dawn.jp"]) }}
</p>
@if($errors->has('mail'))
<p>{{$errors->first('mail')}}</p>
@endif

<p>Password<br>
{{ Form::label('パスワード') }}
{{ Form::password('password',null,['class' => 'input']) }}
</p>
@if($errors->has('password'))
<p>{{$errors->first('password')}}</p>
@endif

<p>Password confirm<br>
{{ Form::label('パスワード確認') }}
{{ Form::password('password_confirmation',null,['class' => 'input',"type"=>"password"]) }}
</p>
@if($errors->has('password_confirmation'))
<p>{{$errors->first('password_confirmation')}}</p>
@endif
<!-- パスワード確認 -->




{{ Form::submit('REGISTER') }}

<p><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection
