@extends('layouts.login')

@section('content')


<!-- 他ユーザープロフィール -->
<div class="">
        <!-- ユーザープロフィール -->
        <div class="">
            <p><img src="{{ asset('/images/' . $user->images) }}" alt="ユーザーアイコン"></p>
            <p>{{ $user->username}}</p>
            <p>{{ $user->bio }}</p>
        </div>

        <!-- フォローボタン -->
        <div class="">
            @if(in_array($user->id,$check))
                <a href="/{{$user->id}}/unFollow"><p class="">フォローはずす</p></a>
            @else
                <a href="/{{$user->id}}/follow"><p class="">フォローする</p></a>
            @endif
        </div>
</div>


<!-- 投稿内容 -->
@foreach($user_post as $user_post)
<div class="">
        <div class="">
        <p><img src="{{ asset('/images/' . $user_post->images) }}" alt="ユーザーアイコン"></p>
        <p>{{$user_post->username}}</p>
        <p>{{$user_post->created_at}}</p>
        <p>{{$user_post->posts}}</p>
        </div>
</div>
@endforeach


@endsection