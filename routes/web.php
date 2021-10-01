<?php

use App\Http\Controllers\HomeController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return Product::all();
    $products = Product::all();
    return view('welcome', compact('products'));
});

Route::get('export', [HomeController::class, 'export']);


Route::post('import', [HomeController::class, 'import'])->name('import');
