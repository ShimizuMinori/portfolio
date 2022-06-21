@extends('layouts.login')

@section('content')

  <!-- 検索窓の設置 -->
  <div id="search">
      <div class="search_form">
        {!! Form::open(array('url' => '/searching', 'method' => 'post')) !!}

        {{ Form::text('search',null,['class' => 'search', 'placeholder' => 'ユーザー名']) }}
        {!! Form::submit('🔎',['class' => 'search_btn']) !!}
        {!! Form::close() !!}
      </div>

      <!-- 検索ワードの表示 -->
      <div class="search_word">
          <!-- 検索ワードがあった時だけ吐き出す -->
          <!-- issetはnullが偽 -->
          @if(isset($search_word))
              <p>検索ワード：{{ $search_word }}</p>
          @endif
      </div>
  </div>

  <hr class="separate">


  <!-- 検索結果が出るまではただの一覧表示 -->
  <!-- コントローラー側で処理するから、bladeではresultの表示だけ -->
  <div id="result">
      @forelse($result as $result)
        <div class="result_user">
            <a href="/{{$result->id}}/otherprofile"><img class="bicImg" src="images/{{ $result->images }}" alt="プロフィール画像"></a>
            <p class="result_username">{{ $result->username }}</p>

            <!-- フォローワーがいる時は「はずす」ボタンを表示する -->
            <div class="">
              @if(in_array($result->id,$check))
              <a href="/{{$result->id}}/unFollow"><p class="unfollowBtn">フォローはずす</p></a>

              <!-- フォロワーがいない時は「フォローする」ボタンを表示 -->
              @else
              <a href="/{{$result->id}}/follow"><p class="followBtn">フォローする</p></a>
              @endif
            </div>

        </div>
      @empty
        <p>該当なし</p>
      @endforelse
  </div>

@endsection