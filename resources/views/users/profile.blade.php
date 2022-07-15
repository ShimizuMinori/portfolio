@extends('layouts.login')

@section('content')


<!-- ①ログイン中のユーザープロフィール 作成途中-->
    <div id="profile">

        <div class="profileIcon">
            <img class="userIcon" src="{{ asset('storage/'.$name->images) }}" alt="ログインユーザーのアイコン">
        </div>

        {!! Form::open(['action' => 'UsersController@updateprofile', 'method' => 'post', 'files' => true]) !!}
        <div>
            <div class="profileBox">
                <p class="">UserName</p>
                {{ Form::label('ユーザー名') }}
                {{ Form::input('username','username',$name->username,['class' => 'profileForm',"placeholder"=>"$name->username"]) }}

                @if($errors->has('username'))
                <p>{{$errors->first('username')}}</p>
                @endif
            </div>

            <div class="profileBox">
                <p class="">MailAddress</p>
                {{ Form::label('メールアドレス') }}
                {{ Form::input('mail','mail',$name->mail,['class' => 'profileForm',]) }}

                @if($errors->has('mail'))
                <p>{{$errors->first('mail')}}</p>
                @endif
            </div>


            <div class="profileBox">
                <p class="formTitle">Password</p>
                {{ Form::label('旧パスワード') }}
                {{ Form::input('password','password',$name->password,['class'=>'profileForm','disabled']) }}
            </div>

            <div class="profileBox">
                <p class="formTitle">newPassword</p>
                {{ Form::label('新パスワード') }}
                {{ Form::input('update_password','update_password',null,['class' => 'profileForm',"type"=>"password"]) }}

                @if($errors->has('update_password'))
                <p>{{$errors->first('update_password')}}</p>
                @endif
            </div>


            <div class="profileBox">
                <p class="formTitle">Bio</p>
                {{ Form::label('自己紹介') }}
                {{ Form::input('bio','bio',$name->bio,['class' => 'profileForm',"placeholder"=>"$name->bio"])}}

                @if($errors->has('bio'))
                <p>{{$errors->first('bio')}}</p>
                @endif
            </div>


            <div class="profileBox">
                    <p class="formTitle">IconImage</p>
                <div class="profile_icon">
                    {{ Form::label('アイコン画像')}}
                    {{ Form::file('update_images',null,$name->images,['class' => 'profileIcon',"type"=>"file"])}}
                </div>
            </div>
        </div>

    </div>

            <div class="profileBox">
                <button class="updateBtn" type="submit">更新</button>
            </div>
        {!! Form::close() !!}


@endsection