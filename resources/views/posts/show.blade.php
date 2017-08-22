@extends('layouts.app')
@section('content')

  <a href="/posts" class="btn btn-default">Go back</a>
  <h1>{{$posts->title}}</h1>
    <img src="/storage/cover_image/{{$posts->cover_image}}" class="col-md-offset-3" style="width: 50%">
    <br><br>
  <div>
  {!!$posts->body!!}
  </div>

  <hr>

    <small>Written on {{$posts->created_at}}</small>
    <hr>
    @if (!Auth::guest())
    @if(Auth::user()->id == $posts->user_id)
  <a href="/posts/{{$posts->id}}/edit" class="btn btn-primary">Edit</a>
      {!! Form::open(['action' => ['PostsController@destroy', $posts->id], 'method' => 'POST']) !!}
      {{Form::hidden('_method', 'DELETE')}}
      {{Form::submit('Delete', ['class' => 'btn btn-danger pull-right'])}}
      {!! Form::close() !!}
    @endif
    @endif

@endsection
