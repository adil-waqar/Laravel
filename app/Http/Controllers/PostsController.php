<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\User;

class PostsController extends Controller
{
//Below is user authentication
  public function __construct()
  {
      $this->middleware('auth', ['except' => ['index', 'show']]);
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //You can basically limit the amount of posts that you want to display
      //  $posts = Post::OrderBy('title', 'desc')->take(1)->get();
      //Bottom in an example to paginate your posts depending upon your parameter for number of posts
      $posts = Post::OrderBy('created_at', 'desc')->paginate(10);

        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user()->id;
        return view('posts.create')->with('user' , $user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //This is the way to validate your form
      $this->validate($request, [
        'title' => 'required' ,
        'body' => 'required' ,
        'cover_image' => 'image|nullable|max:1999'
      ]);

      //Handle fileupload

      if ($request->hasFile('cover_image')) {
          //Grabbing the file name with extension
          $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
          //Grabbing just the filename
          $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
          //Get just ext
          $extension = $request->file('cover_image')->getClientOriginalExtension();
          //filename to Store
          $fileNameToStore = $filename.'_'.time().'.'.$extension;
          //Upload image
          $path = $request->file('cover_image')->storeAs('public/cover_image', $fileNameToStore);

      } else {
        $fileNameToStore = 'noimage.jpg';
      }

      // Setting up a create system and using tinker to link to the database
      $post = new Post;
      $post->title = $request->input('title');
      $post->body = $request->input('body');
      $post->user_id = auth()->user()->id;
      $post->cover_image = $fileNameToStore;
      $post->save();
      return redirect('/posts')->with('success', 'Post created!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = Post::find($id);
        return view('posts.show')->with('posts', $posts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $posts = Post::find($id);
      if (auth()->user()->id == $posts -> user_id) {
        return view('posts.edit')->with('posts', $posts);
      } else{
          return redirect('/posts')->with('error', 'Unauthorized Access!');
      }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'title' => 'required' ,
        'body' => 'required' ,
        'cover_image' => 'image|nullable|max:1999'
      ]);
      if ($request->hasFile('cover_image')) {
          //Grabbing the file name with extension
          $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
          //Grabbing just the filename
          $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
          //Get just ext
          $extension = $request->file('cover_image')->getClientOriginalExtension();
          //filename to Store
          $fileNameToStore = $filename.'_'.time().'.'.$extension;
          //Upload image
          $path = $request->file('cover_image')->storeAs('public/cover_image', $fileNameToStore);

      }

      $post = Post::find($id);
      $post->title = $request->input('title');
      $post->body = $request->input('body');
        if ($request->hasFile('cover_image')){
          $post->cover_image = $fileNameToStore;
        }
      $post->save();
      return redirect('/posts')->with('success', 'Post Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if (auth()->user()->id == $post -> user_id) {
          $post->delete();
          return redirect('/posts')->with('success', 'Post Deleted!');

        } else{
            return redirect('/posts')->with('error', 'Unauthorized Access!');
        }

    }
}
