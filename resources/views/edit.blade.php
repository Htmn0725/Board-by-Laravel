@extends('layouts.app')

@section('titel','ひとり言掲示板 編集ページ')

@section('content')
<h1>ひとり言掲示板 編集ページ</h1>
@if ($errors->any())
	<ul class="error_message">
	  @foreach ($errors->all() as $error)
		<li>・{{$error}}</li>
	  @endforeach
	</ul>
@endif
<form method="post" enctype="multipart/form-data">
    @csrf
    @method('POST')
  <div>
    <label for="view_name">name</label>
    <input id="view_name" type="text" name="view_name" value="@if( !empty($post->view_name) ){{$post->view_name}}@endif">
  </div>
  <div>
    <label for="message">message</label>
    <textarea id="message" name="message">@if(!empty($post->message)){{$post->message}}@endif</textarea>
  </div>
  <a class="btn_cancel" href="{{url('/')}}">cancel</a>
  <input type="submit" name="btn_submit" value="Fix!">
  <input type="hidden" name="message_id" value="{{$post->id}}">
</form>
@endsection
