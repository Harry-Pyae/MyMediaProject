@extends('admin.layouts.app')

@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Trend Post Table</h3>

        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr class="row">
              <th class="col-1">Post ID</th>
              <th class="col-2">Title</th>
              <th class="col-4">Image</th>
              <th class="col-1">View Count</th>
              <th class="col-2">Created At</th>
              <th class="col-2"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($action_data as $a)
            <tr class="row">
                <td class="col-1">{{$a->post_id}}</td>
                <td class="col-2 text-wrap">{{$a->title}}</td>
                <td class="col-4"><img @if ($a->image == null)  src='{{asset('defaultImage/no-image-icon-6.png')}}' @else src="{{ asset('postImage/'.$a->image) }}" @endif class="img-thumbnail shadow-sm" width="150px" height="150px" alt=""></td>
                <td class="col-1"><i class="fa-solid fa-eye mr-1"></i>{{$a->action_count}}</td>
                <td class="col-2 text-wrap">{{$a->created_at->format('j F Y | h:i:s')}}</td>
                <td class="col-2">
                    <a href="{{route('admin#trendPostDetails', $a->post_id)}}">
                        <button class="btn btn-sm bg-dark text-white"><i class="fa-solid fa-circle-info fa-lg"></i></button>
                    </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="d-flex justify-content-center mt-3">
          {{-- {{$action_data->links()}} --}}
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
@endsection
