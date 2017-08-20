@extends('layouts.app')
@section('content')

  <a href="/posts" class="btn btn-default">Go back</a>
  <h1>{{$posts->title}}</h1>

  <div>
  {{$posts->body}}
  asd
  </div>

  <hr>

    <small>Written on {{$posts->created_at}}</small>
@endsection
