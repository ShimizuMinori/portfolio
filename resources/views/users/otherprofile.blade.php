@extends('layouts.login')

@section('content')


<!-- 他ユーザープロフィール -->
<div id="otherprofileBox">
        <div class="otherprofile">
            <p><img class="userIcon" src="{{ asset('/images/' . $user->images) }}" alt="ユーザーアイコン"></p>
            <p class="profileName">Name　　{{ $user->username}}</p>
        </div>

        <p class="bio">Bio　　{{ $user->bio }}</p>

        <!-- フォローボタン -->
        <div class="">
            @if(in_array($user->id,$check))
                <a href="/{{$user->id}}/unFollow"><p class="profile_unfollowBtn">フォローはずす</p></a>
            @else
                <a href="/{{$user->id}}/follow"><p class="profile_followBtn">フォローする</p></a>
            @endif
        </div>
</div>


<!-- 投稿内容 -->
@foreach($user_post as $user_post)
    <div id="profilePost">
        <div class="postBox">
            <p><img class="userIcon" src="{{ asset('/images/' . $user_post->images) }}" alt="ユーザーアイコン"></p>
            <p class="postuser">{{$user_post->username}}</p>
            <p class="posttime">{{$user_post->created_at}}</p>
        </div>
        <p class="post">{{$user_post->posts}}</p>
    </div>
@endforeach


@endsection