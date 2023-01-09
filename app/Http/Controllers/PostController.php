<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function all()
    {
        return Post::all();
    }
    public function index($id)
    {
        return Post::find($id);
    }
    public function store(Request $request)
    {
        Post::create($request->all());
    }
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->update($request->all());
    }
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
    }
}
