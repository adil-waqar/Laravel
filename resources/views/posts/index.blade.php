@extends('layouts.app')
@section('content')

  <h1>Posts</h1>
  @if (count($posts)>0)
    @foreach ($posts as $post)
      <div class="well">
        <h1><a href="posts\ {{$post->id}}">{{$post->title}}</a></h1>
        <small>Written on {{$post->created_at}}</small>
      </div>

    @endforeach
    //For pagination
    {{$posts->links()}}
  @else
    <h3>No Posts found.</h3>
  @endif


@endsection
