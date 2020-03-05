@extends('layouts.app')

@section('titel','ひとり言掲示板 コメントページ')

@section('content')
<h1>ひとり言掲示板 コメントページ</h1>
@if ($errors->any())
	<ul class="error_message">
	  @foreach ($errors->all() as $error)
		<li>・{{$error}}</li>
	  @endforeach
	</ul>
@endif
<article>
  <div class="info">
    @if( !empty($post->view_name) )
    <h2 class="h5 mb-4">
        {{$post->view_name}}
    </h2>
    @endif
  </div>
  <br/>
  <div>
    @if(!empty($post->message))
    <p>
        {{$post->message}}
    </p>
    @endif
  </div>
</article>
<br/>
<div class="container mt-4">
<section>
    <h2 class="h5 mb-4">comment</h2>

    <div>
    <form class="mb-4" method="POST" action="{{ route('comments.store') }}">
        @csrf
        <input type="hidden" name="message_id" value="{{$post->id}}">
        <div class="form-group">
            <label for="body">
                本文
            </label>
            <textarea id="comment" name="comment" class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" rows="4">
                {{ old('comment') }}
            </textarea>
            @if( $errors->has('comment'))
                <div class="invalid-feedback">
                    {{ $errors->first('comment') }}
                </div>
            @endif
        </div>
        <div class="mt-4">
            <a class="btn_cancel" href="{{url('/')}}">back</a>
            <button type="submit" class="btn btn-primary">add comment</button>
    </div>
    </form>
</div>
    @forelse($post->comments as $comment)
        <div class="border-top p-4">
            <time class="text-secondary">
                {{ $comment->created_at->format('Y年m月d日 H:i') }}
            </time>
            <p>{!! nl2br(e($comment->comment)) !!}</p>
        </div>
    @empty
        <p>コメントはまだありません</p>
    @endforelse
</section>
</div>
  @endsection