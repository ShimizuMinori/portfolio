@extends('layouts.login')

@section('content')
<!-- 投稿フォーム -->
<div class="container">
{!! Form::open(['url' => 'post/create']) !!}
    <div class="form-group">
        {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容']) !!}
    </div>
    <button type="submit" class="btn btn-success pull-right">
        <img src="/images/post.png" alt="投稿ボタン">
        
    </button>
{!! Form::close() !!}
</div>



<table class="table table-hover">
@foreach ($list as $list)
<div>
    <!-- foreachにて一時的に値を格納している変数からブラウザに表示させたい内容を->"アロー"を使ってカラム名を指定 -->
   <tr>
    <td>{{ $list->posts }}</td>
    <td>{{ $list->created_at }}</td>
    <td><img src="/images/{{$list->images}}" alt="ユーザーアイコン"></td>

    <td>
    <!-- 削除機能 -->
    <a  href="/post/{{$list->id}}/delete"onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">
    <img src="{{ asset('images/trash_h.png') }}" alt="削除" ></a>
    </td>

    <!-- 編集 -->
    <td>
    <!-- モーダルを開くボタン -->
    <a href="" class="modal_open" data-target="modal{{ $list->id }}">
        <img src="{{ asset('images/edit.png') }}" alt="編集">
    </a>

           <!-- モーダルウィンドウ -->
           <div class="modal-window" id="modal{{ $list->id }}">
                <div class="inner">
                    {!! Form::open(array('url' => '/post/update', 'method' => 'post')) !!}
                    {!! Form::input('hidden','updated',$list->id) !!}
                    {!! Form::input('text','update',$list->posts,['class' => 'input', 'required']) !!}
                    <button type="submit" class="update-btn"><img src="{{ asset('images/edit.png') }}" lat="編集"></button>
                    {!! Form::close() !!}
                </div>
            </div>

    </td>

    </tr>

</div>
@endforeach
</table>




@endsection