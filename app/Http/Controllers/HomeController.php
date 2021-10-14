<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use App\Models\Post;
use Maatwebsite\Excel\Facades\Excel;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    public function export()
    {
        return Excel::download(new ProductsExport, 'products-backup.xlsx');
    }

    public function import(Request $request)
    {
        Excel::import(new ProductsImport, $request->file('data'));
        return redirect()->back();
    }

    public function image()
    {
        return view('image');
    }

    public function imageSubmit(Request $request)
    {
        // $request // object request from
        // request() // Global Helper method

        // dd($request->file('image'));

        // change the file name to prevent the data redundancy
        $ex = $request->file('image')->getClientOriginalExtension();
        $image_name = 'maan_image_' . time() .'_' . rand() . '.' . $ex;


        $img = Image::make($request->file('image'));

        $image = $img->resize(100, null);
        $image->save('images/thumb100/' . $image_name);

        $image = $img->resize(300, 300);
        $image->save('images/thumb300/' . $image_name);

        $img->save('images/full/' . $image_name);

        // return $image->response('jpg');
        return 'done';

        return view('image');
    }

    public function blog()
    {
        $blogs = Post::all();

        return view('blog', compact('blogs'));
        // return view('blog')->with('blogs', $blogs);
        // return view('blog', [
        //     'blogs' => $blogs
        // ]);
    }
}
