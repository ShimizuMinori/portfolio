@extends('layouts.login')

@section('content')


<!-- ①ログイン中のユーザープロフィール 作成途中-->
    <div class="">
    ログイン中...

        <div class="">
            <img src="images/{{$name->images}}" alt="ログインユーザーのアイコン">
        </div>

        {!! Form::open(['action' => 'UsersController@profile', 'method' => 'post', 'files' => true]) !!}
        <div class="">
            <p class="">UserName</p>
            {{ Form::label('ユーザー名') }}
            {{ Form::input('username','username',$name->username,['class' => '',"placeholder"=>"$name->username"]) }}

            @if($errors->has('username'))
            <p>{{$errors->first('username')}}</p>
            @endif

                <br>

            <p class="">MailAddress</p>
            {{ Form::label('メールアドレス') }}
            {{ Form::input('mail','mail',$name->mail,['class' => '',]) }}

            @if($errors->has('mail'))
            <p>{{$errors->first('mail')}}</p>
            @endif

                <br>

            <p class="">Password</p>
            {{ Form::label('旧パスワード') }}
            {{ Form::input('password','password',$name->password,['class'=>'','disabled']) }}

                <br>

            <p class="">new Password</p>
            {{ Form::label('新パスワード') }}
            {{ Form::password('password',null,['class' => '',"type"=>"password"]) }}

            @if($errors->has('password'))
            <p>{{$errors->first('password')}}</p>
            @endif
        
                <br>


            <p class="">Bio</p>
            {{ Form::label('自己紹介') }}
            {{ Form::text('bio',null,['class' => '',"placeholder"=>"$name->bio"])}}

            @if($errors->has('bio'))
            <p>{{$errors->first('bio')}}</p>
            @endif

                <br>

            <p class="">Icon Image</p>
            {{ Form::label('アイコン画像')}}
            {{ Form::file('images',null,['class' => ''])}}
                <br>
            
            <button type="submit" class="">更新</button>

        </div>

        
        {!! Form::close() !!}


        <div class="">
        </div>

    </div>


@endsection