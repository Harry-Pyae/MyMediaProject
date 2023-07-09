<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // category page
    public function index(){
        $categoryData = Category::get();
        return view('admin.category.index', compact('categoryData'));
    }

    // create category list
    public function createCategory(Request $request){
        $validator = $this->categoryValidationCheck($request);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $data = $this->getCategoryData($request);
        Category::create($data);
        return back();
    }

    // edit category page
    public function editCategoryPage($id){
        $category = Category::where('category_id', $id)->first();
        return view('admin.category.edit', compact('category')) ;
    }

    // edit category data
    public function edit(Request $request){

        $validator = $this->categoryEditValidationCheck($request);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $data = $this->requestCategorydata($request);

        Category::where('category_id', $request->categoryID)->update($data);
        return back()->with(['EditSuccess'=>'Category details have been successfully edited']);
    }

    // delete category data
    public function deleteCategory($id){
        Category::where('category_id', $id)->delete();
        return back()->with(['DeleteSuccess'=>'Category deleted successfully']);
    }

    // search category data
    public function searchCategory(Request $request){
        $categoryData = Category::orWhere('title', 'like', '%'.$request->categoryKey.'%')
                    ->orWhere('description', 'like', '%'.$request->categoryKey.'%')->get();
        return view('admin.category.index', compact('categoryData'));
    }

    // get category data
    private function getCategoryData($request){
        return [
            'title' => $request->categoryName,
            'description' => $request->categoryDescription,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    // request category edit details
    private function requestCategorydata($request){
        return [
            'title' => $request->categoryTitle,
            'description' => $request->categoryDescription
        ];
    }

    // category validation
    private function categoryValidationCheck($request){
        $validationRules = [
            'categoryName' => 'required',
            'categoryDescription' => 'required'
        ];
        return Validator::make($request->all(), $validationRules);
    }

    // edit validation
    private function categoryEditValidationCheck($request){
        $validationRules = [
            'categoryID' => 'required',
            'categoryTitle' => 'required',
            'categoryDescription' => 'required'
        ];
        return Validator::make($request->all(), $validationRules);
    }
}
