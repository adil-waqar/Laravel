@extends('layouts.app')
@section('content')

  <h1>Create</h1>
  <!--Below is just basic syntax-->
  {!! Form::open(['action' => 'PostsController@store' , 'enctype' => 'multipart/form-data']) !!} <!-- Store is a function that we are submitting to
  in the post controller-->
  <div class="form-group">
    {{Form::label('title', 'Title')}}
    <!--Missing colon is for value and we dont need it for create -->
    {{Form::text('title', '', ['class' => 'form-control' , 'placeholder' => 'Title'])}}
  </div>

  <div class="form-group">
    {{Form::label('body', 'Body')}}
    <!--First denotes name, Missing colon is for value and we dont need it for create, last denotes class -->
    {{Form::textarea('body', '', ['id' => 'article-ckeditor','class' => 'form-control' , 'placeholder' => 'Body'])}}
  </div>

 <!--The first value in case of a submit denotes its vcalue -->
 <div class="form-group">
   {{Form::file('cover_image')}}
 </div>

  {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}


@endsection
