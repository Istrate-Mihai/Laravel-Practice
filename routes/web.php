<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PostsController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//   return view('home.index');
// })->name('home.index');

// Route::get('/contact', function () {
//   return view('home.contact');
// })->name('home.contact');

// Route::resource('/posts', PostsController::class);
// Route::get('/', [HomeController::class, 'home'])->name('home.index');
// Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');
// Route::get('/single', AboutController::class);

// Route::get('/posts', function () use ($posts) {
//   // dd(request()->all());
//   // dd((int)request()->input('page', 1));
//   // dd((int)request()->query('page', 1));

//   return view('posts.index', ['posts' => $posts]);
// })->name('posts.index'); //->middleware('auth');

// Route::get('/posts/{id}', function ($id) use ($posts) {
//   abort_if(!isset($posts[$id]), 404);
//   return view('posts.show', ['post' => $posts[$id]]);
// })->name('posts.show');

// Route::get('/recent-posts/{recent_post?}', function ($recent_post = 20) {
//   return 'Post ' . $recent_post;
// })->name('posts.recent.index');

// Route::prefix('/fun')->name('fun.')->group(function () use ($posts) {
//   Route::get('/responses', function () use ($posts) {
//     return response($posts, 201)
//       ->header('Content-Type', 'application/json')
//       ->cookie('MY_COOKIE', 'Piotr Jura', 3600);
//   })->name('responses');

//   Route::get('/redirect', function () {
//     return redirect('/contact');
//   })->name('redirect');

//   Route::get('/back', function () {
//     return back();
//   })->name('back');

//   Route::get('/named-route', function () {
//     return redirect()->route('posts.show', ['id' => 1]);
//   })->name('named-route');

//   Route::get('/away', function () {
//     return redirect()->away('https://laravel.com/docs/9.x/redirects?msclkid=1dc334ffcfc911ec960f93b54a99cec0');
//   })->name('away');

//   Route::get('/json', function () use ($posts) {
//     return response()->json($posts);
//   })->name('json');

//   Route::get('/download', function () {
//     return response()->download(public_path('daniel.jpg'), 'facePhoto', []);
//   })->name('download');
// });

Route::view('/', 'home.index')->name('home.index');
Route::view('/contact', 'home.contact')->name('home.contact');
Route::resource('/posts', PostsController::class);
Auth::routes();
