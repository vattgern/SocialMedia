<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function all(): \Illuminate\Http\JsonResponse
    {
        $posts = Post::all();
        if($posts->count() > 0){
            return response()->json([
               'message' => 'Все посты',
               'data' => $posts
            ]);
        } else {
            return response()->json([
                'message' => 'Посты отсутствуют'
            ]);
        }
    }
    public function index($id)
    {
        if(Post::find($id) != null){
            return response()->json([
               'message' => 'Пост найден',
               'data' => Post::find($id)
            ]);
        } else {
            return response()->json([
                'message' => 'Поста не существует'
            ]);
        }
    }
    public function store(Request $request)
    {
        $post = Post::create([
            'content' => $request->input('content'),
            'images' => 'some url',
            'category_id' => $request->input('category_id'),
            'user_id' => Auth::user()->id,
        ]);
        return response()->json([
           'message' => 'Пост создан',
           'data' =>  $post,
        ]);
    }
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->update($request->all());
    }
    public function destroy($id)
    {
        $post = Post::where('user_id',Auth::user()->id)->where('id', $id);
        $post->delete();
        return response()->json([
            'message' => 'Пост удален'
        ]);
    }
}
