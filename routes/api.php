<?php

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api','scopes:get-email')->get('/user', function (Request $request) {
    return $request->user()->makeVisible([
        'email'
    ]);
});

Route::get('/posts', function(Request $request) {
    return Post::with('user')->get();
});

Route::middleware('auth:api','scopes:create-posts')->post('/posts/new', function (Request $request) {
    return $request->user()->posts()->create($request->only(['title','content']));
});
