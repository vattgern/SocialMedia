<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function all(): \Illuminate\Http\JsonResponse
    {
        $posts = PostResource::collection(Post::all());
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
    public function allMyPosts(){
        $posts = PostResource::collection(Post::all()->where('user_id', Auth::user()->id));
        return response()->json([
            'message' => 'Мои посты',
            'data' => $posts,
            'count' => $posts->count(),
        ]);
    }
    public function allPostsUser($id){
        $posts = PostResource::collection(Post::all()->where('user_id', $id));
        return response()->json([
            'message' => 'Посты пользователя',
            'data' => $posts,
            'count' => $posts->count(),
        ]);
    }
    public function index($id)
    {
        if(Post::find($id) != null){
            return response()->json([
               'message' => 'Пост найден',
               'data' => new PostResource(Post::find($id))
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
            'category_id' => $request->input('category_id'),
            'user_id' =>Auth::user()->id,
        ]);
        $files = $request->file('files');
        foreach ($files as $file) {
            $path = Storage::disk('public')->put('postImages',$file);
            Image::create([
                'url' => $path,
                'post_id' => $post->id,
            ]);
        }
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
        $images = Image::all()->where('post_id', $id);
        foreach ($images as $image) {
            Storage::disk('public')->delete($image->url);
            $image->delete();
        }
        $post = Post::where('user_id',Auth::user()->id)->where('id', $id);
        $post->delete();
        return response()->json([
            'message' => 'Пост удален'
        ]);
    }
}
