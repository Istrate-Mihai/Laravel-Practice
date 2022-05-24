<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use Faker\Core\Blood;
use Illuminate\Support\Facades\DB;
// use Illumintate\Support\Facades;

class PostsController extends Controller
{

  // public $posts = [
  //   1 => [
  //     'title' => 'Intro to Laravel',
  //     'content' => 'This is a short intro to Laravel',
  //     'is_new' => true
  //   ],
  //   2 => [
  //     'title' => 'Intro to PHP',
  //     'content' => 'This is a short intro to PHP',
  //     'is_new' => false
  //   ],
  //   3 => [
  //     'title' => 'Intro to Golang',
  //     'content' => 'This is a short intro to Golang',
  //     'is_new' => false
  //   ]
  // ];

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    // DB::connection()->enableQueryLog();

    // $posts = BlogPost::with('comments')->get(); // all();
    // foreach ($posts as $post) {
    //   foreach ($post->comments as $comment) {
    //     echo $comment;
    //   }
    // }

    // dd(DB::getQueryLog());

    return view(
      'posts.index',
      [
        'posts' => BlogPost::withCount('comments')->get()
      ]
    );
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('posts.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StorePost $request)
  {
    // dd($request);
    // $request->validate([
    //   'title' => 'bail | required | min:5 | max:100',
    //   'contents' => 'min:10',
    // ]);
    // $post = BlogPost::make($validated);
    // $post->save();
    // $post = new BlogPost();
    // $post->fill($validated);
    // $post->save();
    // $post->title = $validated['title']; // $request->input('title');
    // $post->contents = $validated['contents']; // $request->input('contents');
    // $post->save();

    $validated = $request->validated();
    $post = BlogPost::create($validated);
    $request->session()->flash('status', 'BlogPost was successfully created!');
    return redirect()->route('posts.show', ['post' => $post->id]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    return view(
      'posts.show',
      [
        'post' =>
        BlogPost::with('comments')->findOrFail($id)
      ]
    );
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $post = BlogPost::findOrFail($id);
    return view('posts.edit', ['post' => $post]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(StorePost $request, $id)
  {
    $validated = $request->validated();
    $post = BlogPost::findOrFail($id);
    $post->fill($validated);
    $post->save();
    $request->session()->flash('status', 'BlogPost was successfully updated!');
    return redirect()->route('posts.show', ['post' => $post->id]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $post = BlogPost::findOrFail($id);
    $post->delete();
    session()->flash('status', 'BlogPost was successfully deleted!');
    return redirect()->route('posts.index');
  }
}
