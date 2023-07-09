@extends('admin.layouts.app')

@section('content')
<div class="">
    <div class="row">
        <div class="offset-2 col-3">
            <a href="{{route('admin#trendPost')}}"><button class="btn bg-black text-white my-3"><i class="fa-solid fa-backward me-2"></i>List</button></a>
        </div>
    </div>
    <div class="offset-2 col-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-center my-2 row">
                    <h2 class="text-center text-info col-sm-12">Post Details</h2>
                </div>
                <div style="border: 1px solid rgb(88, 88, 88);"></div>
                <div class="d-flex justify-content-center align-items-center mt-4">
                    <h2 name="postTitle" class="text-center text-bold">{{$post->title}}</h2>
                    <div style="border: 1px solid rgb(88, 88, 88);"></div>
                </div>
                <div class="d-flex justify-content-center align-items-center mt-4">
                    <h3 name="postDescription" class="col-8 text-center text-wrap">{{$post->description}}</h3>
                </div>
                <div class="d-flex justify-content-center align-items-center mt-4">
                    <img @if ($post->image == null)
                        src='{{asset('defaultImage/no-image-icon-6.png')}}'
                    @else
                        src="{{asset('postImage/'. $post->image)}}"
                    @endif class="form-control rounded shadow-sm m-1 mb-2" style="width: 333px; height: 333px;" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
