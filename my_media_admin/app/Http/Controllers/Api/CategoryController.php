<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    // get all categories
    public function getAllCategory(){
        $category = Category::select('category_id', 'title', 'description', 'created_at')->get();
        return response()->json([
            'category' => $category,
        ]);
    }

    // redirect to specific category
    public function selectCategory(Request $request){
        $category = Category::select('posts.*')->join('posts', 'categories.category_id', 'posts.category_id')->
        where('categories.title', 'like', '%'.$request->key.'%')->get();
        return response()->json([
            'result' => $category,
        ]);
    }
}
