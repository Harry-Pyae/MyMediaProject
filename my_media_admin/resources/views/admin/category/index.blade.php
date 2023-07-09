@extends('admin.layouts.app')

@section('content')
<div class="col-4">
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin#categoryCreate')}}" method="post">
                @csrf
                <div class="mb-2">
                  <label class="form-label">Category Name</label>
                  <input name="categoryName" type="text" class="form-control" placeholder="Enter Category Name...">
                  @error('categoryName')
                    <div class="text-danger">{{$message}}</div>
                  @enderror
                </div>
                <div class="mb-2">
                    <label class="form-label">Description</label>
                    <textarea name="categoryDescription" class="form-control" id="" cols="30" rows="10" placeholder="Enter Description..."></textarea>
                    @error('categoryDescription')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
              </form>
        </div>
    </div>
</div>
<div class="col-8">
    {{-- alert start --}}
    <div class="row">
        @if (Session::has('DeleteSuccess'))
            <div class="d-block offset-3 col-5 alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('DeleteSuccess') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
        @endif
    </div>
    {{-- alert end --}}

    <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Category List Table</h3>

            <div class="card-tools">
              <form action="{{route('category#search')}}" method="post">
                @csrf
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="categoryKey" class="form-control float-right" placeholder="Search">

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
                <tr>
                  <th>Category ID</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Created at</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($categoryData as $c)
                <tr>
                  <td>{{$c->category_id}}</td>
                  <td class="text-bold">{{$c->title}}</td>
                  <td class="text-wrap">{{$c->description}}</td>
                  <td class="text-wrap">{{$c->created_at->format('j F Y h:i:s')}}</td>
                  <td>
                    <a href="{{route('category#editPage', $c->category_id)}}">
                        <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>
                    <a href="{{route('category#delete', $c->category_id)}}">
                        <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
</div>
@endsection
