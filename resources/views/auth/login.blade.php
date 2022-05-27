@extends('layouts.logout')

@section('content')

<div class="wrap">

{!! Form::open() !!}

<h2>DAWNSNSへようこそ</h2>

<p>
{{ Form::label('input','Mail Adress') }}
{{ Form::text('mail',null,['class' => 'input']) }}
</p>

<p>
{{ Form::label('input','password') }}
{{ Form::password('password',['class' => 'input',"type"=>"password"]) }}
</p>

{{ Form::submit('ログイン',['class' => 'btn']) }}

<p><a  class="link" href="/register">新規ユーザーの方はこちら</a></p>

{!! Form::close() !!}

</div>

@endsection
