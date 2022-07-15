@extends('layouts.login')

@section('content')

<!-- ①Follower list アイコン一覧 -->
<div id="followBox">
    <h1>Follower list</h1>

    <div class="followsImage">
    @forelse($images as $images)
        <a href="/{{$images->id}}/otherprofile"><img class="followsIcon" src="{{ asset('storage/' . $images->images) }}" alt="ユーザーアイコン"></a>
        
        @empty
        <p>フォロワーはいません。</p>

    @endforelse
    </div>
</div>


<!-- ②フォロワー投稿一覧 -->
    @foreach($list as $list)
    <div id="profilePost">
        <div class="postBox">
            <a href="/{{$list->id}}/otherprofile"><img class="userIcon" src="{{ asset('storage/' . $images->images) }}" alt="ユーザーアイコン"></a>
            <p class="postuser">{{$list->username}}</p>
            <p class="posttime">{{$list->created_at}}</p>
        </div>
        <p class="post">{{ $list->posts }}</p>
    </div>
    @endforeach

@endsection