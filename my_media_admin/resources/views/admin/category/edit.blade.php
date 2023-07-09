@extends('admin.layouts.app')

@section('content')
<div class="">
    {{-- alert start --}}
    <div class="row">
        @if (Session::has('EditSuccess'))
            <div class="d-block offset-3 col-5 alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('EditSuccess') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
        @endif
    </div>
    {{-- alert end --}}
    <div class="row">
        <div class="offset-2 col-3">
            <a href="{{route('admin#category')}}"><button class="btn bg-black text-white my-3"><i class="fa-solid fa-backward me-2"></i>List</button></a>
        </div>
    </div>
    <div class="offset-2 col-8">
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{route('category#edit')}}">
                    @csrf
                    <div class="d-flex justify-content-center my-2 row">
                        <h2 class="text-center text-primary col-sm-12 p-1">Edit Category Details</h2>
                        <h2 class="text-center text-dark col-sm-12 p-1">Title - (" {{$category->title}} ")</h2>
                    </div>
                    <div class="form-group row mt-2">
                      <label for="" class="col-sm-3 col-form-label text-center">Title</label>
                      <div class="col-sm-9">
                        <input type="hidden" name="categoryID" value="{{$category->category_id}}">
                        <input type="text" class="form-control" name="categoryTitle" placeholder="Edit Title" value="{{$category->title}}">
                        @error('categoryTitle')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="" class="col-sm-3 col-form-label text-center">Description</label>
                      <div class="col-sm-9">
                        <textarea cols="30" rows="10" name="categoryDescription" placeholder="Edit Description" class="form-control">{{$category->description}}</textarea>
                        @error('categoryDescription')
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
