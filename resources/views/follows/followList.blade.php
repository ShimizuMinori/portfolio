@extends('layouts.login')

@section('content')

<!-- ①Follow list アイコン一覧 -->
<div class="">
    <h1>Follow list</h1>

    @foreach($images as $images)
    <div class="">
    <a href="/{{$images->id}}/otherprofile"><img src="{{ asset('/images/' . $images->images) }}" alt="ユーザーアイコン"></a>
    </div>
    @endforeach
</div>

<br>
<p>___________________________________________</p>
<br>



<!-- ②フォロワーの投稿一覧 -->
@foreach($list as $list)
<div class="">
    <a href="/{{$list->id}}/otherprofile"><img src="{{ asset('/images/' . $images->images) }}" alt="ユーザーアイコン"></a>
    <p>{{$list->username}}</p>
    <p>{{$list->created_at}}</p>
    <p>{{$list->posts}}</p>
    <br>
</div>
@endforeach


@endsection