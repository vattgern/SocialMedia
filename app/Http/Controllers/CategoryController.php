<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function all()
    {
        return CategoryResource::collection(Category::all());
    }
    public function index($id)
    {
        return new CategoryResource(Category::find($id));
    }
    public function store(Request $request)
    {
        if(Category::where('name', $request->input('name'))->exists()){
            return response()->json([
                'message' => 'Такая категория уже создана',
            ]);
        }
        $category = Category::create($request->all());
        return response()->json([
            'data' => new CategoryResource($category),
            'message' => 'Категория создана'
        ]);
    }
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->update($request->all());
        return new CategoryResource($category);
    }
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return response()->json([
           'message' => 'Категория удалена',
        ]);
    }
}
