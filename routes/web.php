<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PaymentController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


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

    Route::get('payment', [PaymentController::class, 'payment']);
    Route::post('payment', [PaymentController::class, 'paymentSubmit'])->name('payment');

    Route::get('payment2', [PaymentController::class, 'payment2']);
    Route::get('payment2-success', [PaymentController::class, 'payment2_success'])->name('payment2_success');

    // Route::get('todos', function() {
    //     return view('todos.index');
    // });

    Route::view('todos', 'todos.index');

    Route::get('/posts/create', [HomeController::class, 'create_post'])->name('create_post');
    Route::post('/posts/create', [HomeController::class, 'create_post_submit']);

    Route::get('/posts/show/{id}', [HomeController::class, 'show_post'])->name('show_post');

});

// /post/{id}/comments/{user}

// url( '/post//' . id . '/comments//' . user );
// route('user_comments', [id, user]);
