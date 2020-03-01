<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>ひとり言掲示板 編集ページ</title>
<link href="{{ asset('create-a-board.css') }}" rel="stylesheet">
</head>
<body>
<h1>ひとり言掲示板 編集ページ</h1>
@if ($errors->any())
	<ul class="error_message">
	  @foreach ($errors->all() as $error)
		<li>・{{$error}}</li>
	  @endforeach
	</ul>
@endif
<form method="post">
    @csrf
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
  <input type="hidden" name="message_id" value="{{$post->id}}>
</form>
</body>
</html>
