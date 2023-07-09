@extends('admin.layouts.app')

@section('content')
<div class="">
    <div class="row">
        <div class="offset-2 col-3">
            <a href="{{route('admin#post')}}"><button class="btn bg-black text-white my-3"><i class="fa-solid fa-backward me-2"></i>List</button></a>
        </div>
    </div>
    <div class="offset-2 col-8">
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{route('post#edit', $post->post_id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex justify-content-center my-2 row">
                        <h2 class="text-center text-primary col-sm-12 p-1">Edit Post Details</h2>
                        <h2 class="text-center text-dark col-sm-12 p-1">Title - (" {{$post->title}} ")</h2>
                    </div>
                    <div class="form-group row mt-2">
                      <label for="" class="col-sm-3 col-form-label text-center">Title</label>
                      <div class="col-sm-9">
                        <input type="hidden" name="postID" class="form-control" value="{{$post->post_id}}">
                        <input type="text" class="form-control" name="postTitle" placeholder="Edit Title" value="{{$post->title}}">
                        @error('postTitle')
                            <div class="text-danger">{{$message}}</div>
                          @enderror
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="" class="col-sm-3 col-form-label text-center">Description</label>
                      <div class="col-sm-9">
                        <textarea cols="30" rows="10" name="postDescription" placeholder="Edit Description" class="form-control">{{ $post->description }}</textarea>
                        @error('postDescription')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="" class="col-sm-3 col-form-label text-center">Image</label>
                        <div class="col-sm-9">
                            <img @if ($post->image == null)
                                src='{{asset('defaultImage/no-image-icon-6.png')}}'
                            @else
                            src="{{asset('postImage/'. $post->image)}}"
                            @endif class="form-control rounded shadow-sm w-50 h-75 m-1 mb-2" alt="">
                          <input type="file" name="postImage" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="" class="col-sm-3 col-form-label text-center">Category</label>
                        <div class="col-sm-9">
                            <select name="postCategory" id="" class="form-control">
                                <option value="">Choose one option</option>
                                @foreach ($category as $c)
                                <option value="{{$c->category_id}}" @if ($c->category_id == $post->category_id) selected @endif>{{$c->title}}</option>
                                @endforeach
                            </select>
                            @error('postCategory')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row pt-2">
                      <div class="row offset-8 col-3">
                        <button type="submit" class="btn bg-dark text-white text-center">Update</button>
                      </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
