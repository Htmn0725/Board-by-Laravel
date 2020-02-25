<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>ひとり言掲示板</title>
<link href="./create-a-board.css" rel="stylesheet">
</head>
<body>
<h1>ひとり言掲示板</h1>
@if (!empty($success_message))
	<p class="success_message"><?php echo $success_message; ?></p>
@endif
@if (!empty($error_message))
	<ul class="error_message">
	  @foreach ($error_message as $value)
		<li>・<?php echo $value; ?></li>
	  @endforeach
	</ul>
@endif
<form method="post">
  <div>
    <label for="view_name">name</label>
	<input id="view_name" type="text" name="view_name" value="
    @if (!empty($_SESSION['view_name'])) {
        echo $_SESSION['view_name'];
    @endif">
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
		<h2><?php echo $value['view_name']; ?></h2>
		<time><?php echo date('Y年m月d日　H:i',
        strtotime($value['post_date'])); ?></time>
		<p>
        <a href="{{ url('/edit')}}">edit</a>
        <a href="{{ url('/delete')}}">delete</a></p>
	</div>
	<p><?php echo nl2br($value['message']); ?></p>
</article>
@endforeach
@endif
</section>
</body>
</html>
