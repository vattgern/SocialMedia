<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function all()
    {
        return Category::all();
    }
    public function index($id)
    {
        return Category::find($id);
    }
    public function store(Request $request)
    {
        Category::create($request->all());
    }
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->update($request->all());
    }
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
    }
}
