<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;


Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{

    Route::get('/', function () {
        // return Product::all();
        // $products = Product::all();


        // $post = Post::find(1);
        // $post->comments()->create([
        //     'user_id' => 3,
        //     'comment' => 'this is another test comment'
        // ]);
        // return $post->comments;

        // Comment::where('parent_id', $post->id)->where('parent_type', 'post')->get();

        // $product = Product::find(1);

        // $product->comments()->create([
        //     'user_id' => 3,
        //     'comment' => 'This is comment for produnct'
        // ]);

        // return $product->comments;

        $user = User::find(1);
        // $user->courses()->attach([1,2]);
        // $user->courses()->detach([1,2]);
        $user->courses()->sync([1, 5]);


        return $user;


        // return view('welcome', compact('products'));
    });

    Route::get('export', [HomeController::class, 'export']);
    Route::post('import', [HomeController::class, 'import'])->name('import');

    Route::get('image', [HomeController::class, 'image'])->name('image');
    Route::post('image', [HomeController::class, 'imageSubmit']);

    Route::get('blog', [HomeController::class, 'blog']);

    Route::resource('posts', PostController::class);
    Route::get('getData', [PostController::class, 'getData'])->name('posts.getData');

    Route::get('ajax-file', [PostController::class, 'ajax_file']);
    Route::post('ajax-file', [PostController::class, 'ajax_file_store'])->name('ajax_file_store');

    Route::get('posts-api', [PostController::class, 'posts_api']);

});

// /post/{id}/comments/{user}

// url( '/post//' . id . '/comments//' . user );
// route('user_comments', [id, user]);
