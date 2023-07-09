<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    // post page
    public function index(){
        $category = Category::get();
        $post = Post::paginate(4);
        return view('admin.post.index', compact('category', 'post'));
    }

    // create post
    public function createPost(Request $request){
        $validator = $this->checkValidation($request);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        if(!empty($request->postImage)){
            $file = $request->file('postImage');
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            $file->move(public_path().'/postImage',$fileName);

            $data = $this->getPostData($request, $fileName);
        } else {
            $data = $this->getPostData($request, null);
        }
        Post::create($data);

        return back();
    }

    // post search
    public function searchPost(Request $request){
        $post = Post::orWhere('post_id', 'like', '%'.$request->postKey.'%')
                    ->orWhere('title', 'like', '%'.$request->postKey.'%')
                    ->orWhere('description', 'like', '%'.$request->postKey.'%')->paginate(4);
        $category = Category::get();
        return view('admin.post.index', compact('category', 'post'));
    }

    // direct edit post page
    public function editPostPage($id){
        $category = Category::get();
        $post = Post::where('post_id', $id)->first();
        return view('admin.post.edit', compact('category', 'post'));
    }

    // post edit function
    public function edit(Request $request, $id){
        $validator = $this->checkValidation($request);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $data = $this->requestEditPostData($request);

        if(isset($request->postImage)){
            $this->storeUpdatedImage($request, $id, $data);
        } else {
            Post::where('post_id', $id)->update($data);
        }
        $category = Category::get();
        $post = Post::paginate(4);
        return view('admin.post.index', compact('category', 'post'))->with(['editSuccess'=>'The post has been edited']);
    }

    // delete post data
    public function delete($id){
        $postID = Post::where('post_id', $id)->first();
        $dbImage = $postID['image'];
        Post::where('post_id', $id)->delete();

        if(File::exists(public_path('/postImage/'.$dbImage))){
            File::delete(public_path('/postImage/'.$dbImage));
        }
        return back()->with(['deleteSuccess'=>'Post deleted successfully']);
    }

    // get post data
    private function getPostData($request, $fileName){
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'image' => $fileName,
            'category_id' => $request->postCategory,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    // get edit post data
    private function requestEditPostData($request){
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'category_id' => $request->postCategory,
            'updated_at' => Carbon::now(),
        ];
    }

    // store new image in database and delete original image from public path
    private function storeUpdatedImage($request, $id, $data){

        // get photo from request
        $file = $request->file('postImage');
        $fileName = uniqid().'_'.$file->getClientOriginalName();
        $data['image'] = $fileName;

        // get image from database
        $postID = Post::where('post_id', $id)->first();
        $dbImage = $postID['image'];

        // delete image from public folder
        if(File::exists(public_path('/postImage/'.$dbImage))){
            File::delete(public_path('/postImage/'.$dbImage));
        }

        // store new image
        $file->move(public_path().'/postImage',$fileName);

        // update new photo data
        Post::where('post_id', $id)->update($data);
    }

    // post validation check
    private function checkValidation($request){
        return Validator::make($request->all(), [
            'postTitle' => 'required',
            'postDescription' => 'required',
            'postCategory' => 'required'
        ]);
    }
}
