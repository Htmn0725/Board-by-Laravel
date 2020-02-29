<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>ひとり言掲示板</title>
<link href="./create-a-board.css" rel="stylesheet">
</head>
<body>
<h1>ひとり言掲示板</h1>
@if (session('flash_message'))
	<p class="success_message">{{ session('flash_message') }}</p>
@endif
@if (!empty($error_message))
	<ul class="error_message">
	  @foreach ($error_message as $value)
		<li>・<?php echo $value; ?></li>
	  @endforeach
	</ul>
@endif
<form method="post">
    @csrf
  <div>
    <label for="view_name">name</label>
	<input id="view_name" type="text" name="view_name">
  </div>
  <div>
    <label for="message">message</label>
    <textarea id="message" name="message"></textarea>
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
		<time><?php echo date('Y年m月d日　H:i',
        strtotime($value['created_at'])); ?></time>
		<p>
        <a href="{{ action('MessageController@edit', $value->id) }}">edit</a>
        <a href="{{ url('/delete')}}">delete</a></p>
	</div>
	<p>{{nl2br($value->message)}}</p>
</article>
@endforeach
@else
<p>投稿はまだありません</p>
@endif
</section>
</body>
</html>
