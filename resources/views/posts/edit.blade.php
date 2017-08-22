@extends('layouts.app')
@section('content')

  <h1>Edit</h1>
  <!--Below is just basic syntax-->
  {!! Form::open(['action' => ['PostsController@update', $posts->id]]) !!} <!-- update is a function that we are submitting to
  in the post controller-->
  <div class="form-group">

    <!--Missing colon is for value and we dont need it for create -->
    {{Form::text('title', $posts->title, ['class' => 'form-control' , 'placeholder' => 'Title'])}}
  </div>

  <div class="form-group">
    {{Form::label('body', 'Body')}}
    <!--First denotes name, Missing colon is for value and we dont need it for create, last denotes class -->
    {{Form::textarea('body', $posts->body, ['id' => 'article-ckeditor' ,'class' => 'form-control' , 'placeholder' => 'Body'])}}
  </div>
 <!--The first value in case of a submit denotes its vcalue -->
 {{Form::hidden('_method', 'PUT')}}
  {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}

  {!! Form::close() !!}


@endsection
