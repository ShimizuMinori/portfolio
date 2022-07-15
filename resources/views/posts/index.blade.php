@extends('layouts.login')

@section('content')

<body>

<!-- 投稿フォーム -->
<div id="post">
    <div>
        <img class="userIcon" src="{{ asset('storage/'.$name->images) }}">

        {!! Form::open(['url' => 'post/create']) !!}

            <div class="form-group">
                {!! Form::input('text', 'newPost', null, ['required', 'class' => 'newPost', 'placeholder' => '何をつぶやこうか...?']) !!}
            </div>

            <button type="submit" class="postBtn">
                <img src="/images/post.png" alt="投稿ボタン">
            </button>

        {!! Form::close() !!}
    </div>
</div>



@foreach ($list as $list)
<div id="Box">

    <!-- foreachにて一時的に値を格納している変数からブラウザに表示させたい内容を->"アロー"を使ってカラム名を指定 -->
   <div class="postBox00">

       <div class="postBox01">
           <div class="postBox1">
                <img class="userIcon" src="{{ asset('storage/'.$list->images) }}" alt="ユーザーアイコン">
                <p class="postuser">{{ $name->username }}</p>
                <p class="posttime">{{ $list->created_at }}</p>
            </div>
            <div class="postBox2">
                <p>{{ $list->posts }}</p>
            </div>
        </div>

        <!-- 削除機能 -->
        <div class="deleteBtn">
            <a  href="/post/{{$list->id}}/delete"onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">
            <img src="{{ asset('images/trash_h.png') }}" alt="削除" ></a>
        </div>

        <!-- 編集機能 -->
        <div class="updeteBtn">
            <!-- モーダルを開くボタン -->
            <a href="" class="modal-open" data-target="modal{{ $list->id }}">
            <img src="{{ ('images/edit.png') }}" alt="編集">
            </a>
        </div>
    </div>

     <!-- 暗転背景 -->
     <div class="overlay"></div>

        <!-- モーダルウィンドウ -->
           <div class="modal-window" id="modal{{ $list->id }}">
                <div class="inner">
                    <div class="inner_post">
                        {!! Form::open(array('url' => '/post/update', 'method' => 'post')) !!}
                        {!! Form::input('hidden','updateid',$list->id) !!}
                        {!! Form::input('text','update',$list->posts,['class' => 'input', 'required']) !!}
                    </div>
                    <button type="submit" class="inner-btn"><img src="{{ ('images/edit.png') }}" alt="編集"></button>
                    {!! Form::close() !!}
                </div>
            </div>


</div>

</body>


@endforeach




@endsection