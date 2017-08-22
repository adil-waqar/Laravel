@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  <a href="/posts/create" class="btn btn-primary">Create Post</a>
                    <h3>Your BlogPosts</h3>
                    <table class="table table-striped">
                      <tr>
                        <th>Title</th>
                      </tr>
                    </table>
                      @foreach ($posts as $post)
                        <table class="table table-striped">
                        <tr>
                          <th><a href="/posts/{{$post->id}}">{{$post->title}}</a></th>
                          <th>
                            <a href="/posts/{{$post->id}}/edit" class="btn btn-default pull-left">Edit</a>

                          </th>
                          <th>{!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST']) !!}
                          {{Form::hidden('_method', 'DELETE')}}
                          {{Form::submit('Delete', ['class' => 'btn btn-danger pull-right'])}}
                          {!! Form::close() !!}</th>
                        </tr>
                      @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
