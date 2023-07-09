@extends('admin.layouts.app')

@section('content')
<div class="col-3">
    <div class="card">
        <div class="card-body">
            <form action="{{route('post#create')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-2">
                  <label class="form-label">Post Title</label>
                  <input name="postTitle" type="text" class="form-control" placeholder="Enter Post Title...">
                  @error('postTitle')
                    <div class="text-danger">{{$message}}</div>
                  @enderror
                </div>
                <div class="mb-2">
                    <label class="form-label">Description</label>
                    <textarea name="postDescription" class="form-control" id="" cols="30" rows="10" placeholder="Enter Description..."></textarea>
                    @error('postDescription')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label class="form-label">Image</label>
                    <input type="file" name="postImage" class="form-control">
                    @error('postImage')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label class="form-label">Category</label>
                    <select name="postCategory" id="" class="form-control">
                        <option value="">Choose one option</option>
                        @foreach ($category as $c)
                        <option value="{{$c->category_id}}">{{$c->title}}</option>
                        @endforeach
                    </select>
                    @error('postCategory')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
              </form>
        </div>
    </div>
</div>
<div class="col-9">
    {{-- alert start --}}
    <div class="row">
        @if (Session::has('deleteSuccess'))
            <div class="d-block offset-3 col-5 alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('deleteSuccess') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
        @endif
    </div>
    <div class="row">
        @if (Session::has('editSuccess'))
            <div class="d-block offset-3 col-5 alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('editSuccess') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
        @endif
    </div>
    {{-- alert end --}}

    <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Post List Table</h3>

            <div class="card-tools">
              <form action="{{route('post#search')}}" method="post">
                @csrf
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="postKey" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
              </form>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap text-center">
              <thead>
                <tr class="row">
                  <th class="col-1">Post ID</th>
                  <th class="col-1 text-wrap">Title</th>
                  <th class="col-3 text-wrap">Description</th>
                  <th class="col-2">Image</th>
                  <th class="col-2">Category ID</th>
                  <th class="col-2">Created At</th>
                  <th class="col-1"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($post as $p)
                <tr class="row">
                  <td class="col-1">{{$p->post_id}}</td>
                  <td class="col-1 text-wrap"><p class="text-bold">{{$p->title}}</p></td>
                  <td class="col-3 text-wrap">{{$p->description}}</td>
                  <td class="col-2"><img @if ($p->image == null)  src='{{asset('defaultImage/no-image-icon-6.png')}}' @else src="{{ asset('postImage/'.$p->image) }}" @endif class="img-thumbnail shadow-sm" width="150px" height="150px" alt=""></td>
                  <td class="col-2">{{$p->category_id}}</td>
                  <td class="col-2 text-wrap">{{$p->created_at->format('j F Y h:i:s')}}</td>
                  <td class="col-1 py-1">
                    <a href="{{route('post#editPage', $p->post_id)}}">
                        <button class="btn btn-sm bg-dark text-white px-1" title="Edit"><i class="fas fa-edit"></i></button></a>
                    <a href="{{route('post#delete', $p->post_id)}}">
                        <button class="btn btn-sm bg-danger text-white px-1" title="Delete"><i class="fas fa-trash-alt"></i></button></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="d-flex justify-content-center mt-3">
                {{$post->links()}}
              </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
</div>
@endsection
