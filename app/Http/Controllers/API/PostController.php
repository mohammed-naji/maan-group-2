<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $posts = Post::latest()->select('id', 'title', 'content')->get();
        return response()->json(['status' => 'Ok', 'content' => $posts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'title' => 'required',
        //     'content' => 'required',
        // ]);

        // return $request->all();

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors());
        }

        return Post::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return $post;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // return $request->all();
        // $validator = Validator::make($request->all(), [
        //     'title' => 'required',
        //     'content' => 'required'
        // ]);

        // if($validator->fails()) {
        //     return response()->json($validator->errors());
        // }

        $update = $post->update($request->all());
        if($update) {
            return response()->json(['status' => 'Ok', 'post' => $post]);
        }else {
            return response()->json(['status' => 'Error', 'post' => []]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->delete()) {
            return response()->json(['status' => 'Ok', 'post' => []]);
        }
    }

    public function search()
    {
        // return $request->s;

        if(request()->has('s')) {
            $s = request()->s;
            return Post::where('title', 'like', '%' . $s . '%' )->orWhere('content',  'like', '%' . $s . '%')->get();
        }else {
            return response()->json(['status' => 'Error', 'message' => 'Please Enter Word to search']);
        }
    }

    public function token()
    {
        if(request()->has('api_token') && request()->api_token == env('API_TOKEN')) {
            return 'Done';
        }else {
            return response()->json(['status' => 'Error', 'message' => 'Please Submit Valid Token']);
        }
    }

    public function sanctum()
    {

        // $user = User::find(1)->createToken('myapp')->plainTextToken;

        // return $user;

        return 'Done';
    }
}
