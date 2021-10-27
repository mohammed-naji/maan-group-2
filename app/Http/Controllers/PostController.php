<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = Post::create($request->all());
        return response()->json(['status' => 200, 'post' => $post]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Post::findOrFail($id)->delete();
    }

    public function getData()
    {
        return Post::all();
    }

    public function ajax_file()
    {
        return view('posts.ajax_file');
    }

    public function ajax_file_store(Request $request)
    {
        // $request->validate([
        //     'file' => 'required'
        // ]);

        $valid = Validator::make($request->all(), [
            'file' => 'required'
        ]);

        if($valid->fails()) {
            return '<div>File Field is required</div>';
        }

        $ex = $request->file('file')->getClientOriginalExtension();
        $new_name = time().'_'.rand().'.'.$ex;
        $request->file('file')->move(public_path('files'), $new_name);

        return "<img src='". asset("files/$new_name") ."' />";
    }
}
