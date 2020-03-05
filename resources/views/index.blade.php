@extends('layouts.app')

@section('titel','ひとり言掲示板')

@section('content')
<h1>ひとり言掲示板</h1>
@if (session('flash_message'))
	<p class="success_message">{{ session('flash_message') }}</p>
@endif
@if ($errors->any())
	<ul class="error_message">
	  @foreach ($errors->all() as $error)
		<li>・{{$error}}</li>
	  @endforeach
	</ul>
@endif
<form method="POST" action="{{url('index/create')}}" enctype="multipart/form-data">
    @csrf
    @method('POST')
  <div>
    <label for="view_name">name</label>
	  <input id="view_name" type="text" name="view_name">
  </div>
  <div>
    <label for="message">message</label>
    <textarea id="message" name="message"></textarea>
  </div>
  <div>
    <label for="photo">image file</label>
    <input type="file" class="form-control" name="image_file" id="image">
  </div>
  <input type="submit" name="btn_submit" value="go!">
</form>
<hr>
<section>
@if (!empty($message_array))
@foreach ($message_array as $value)
<article>
	<div class="info">
		<h2>{{$value->view_name}}</h2>
		<time>{{ $value->created_at->format('Y月m日d H:i') }}</time>
		<p><form method="GET" action="{{ action('MessageController@edit', $value->id)}}">
                @csrf
                <input type="submit" value="edit">
        </form>
        <form id="form_{{ $value->id }}"　method="POST" action="{{ action('MessageController@destroy', $value->id)}}" style="margin-left:5px">
                @csrf
                @method('DELETE')
            <input type="submit" value="delete" onclick="deletePost(this);" >
        </form>
    </p>
    </div>
    <div>
        <p>{!! nl2br(e($value->message)) !!}</p>
    </div>
    @if( !empty($value->image_file_name))
    <div>
      <img src="data:image/png;base64,{{ $value->file_path }}"　alt="image" width="200" height="130">
    </div>
    @endif
    <br/>
    <div>
      <a class="card-link" href="{{ route('posts.show', $value->id) }}">comment</a>
      @if ($value->comments->count())
        <span class="badge badge-primary">
           {{ $value->comments->count() }}件
        </span>
      @endif
    </div>
</article>
@endforeach
@else
<p>投稿はまだありません</p>
@endif
@endsection
<script>
    /************************************
     確認メッセージ
    *************************************/
    function deletePost(e) {
      'use strict';
      if (confirm('本当に削除しますか?')) {
      document.getElementById('info_' + e.dataset.id).submit();
      }
    }
</script>
