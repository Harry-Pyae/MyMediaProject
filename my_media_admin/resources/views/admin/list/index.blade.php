@extends('admin.layouts.app')

@section('content')
<div class="col-12">

    {{-- alert start --}}
    <div class="row">
        @if (Session::has('DeleteSuccess'))
            <div class="d-block offset-3 col-5 alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('DeleteSuccess') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
        @endif
    </div>
    {{-- alert end --}}

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Admin List</h3>

        <div class="card-tools">
          <form action="{{route('admin#searchList')}}" method="post">
            @csrf
            <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="adminSearchKey" value="{{ old('adminSearchKey') }}" class="form-control float-right" placeholder="Search...">

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
              <th>Admin ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Gender</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($userData as $user)
            <tr>
                <td>{{ $user['id'] }}</td>
                <td>{{ $user['name'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td>{{ $user['phone'] }}</td>
                <td>{{ $user['address'] }}</td>
                <td>{{ $user['gender'] }}</td>
                <td>
                    @if ( Auth::user()->id == $user['id'] )

                    @else
                    <a href="{{route('admin#delete', $user['id'])}}">
                        <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
                    @endif
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
@endsection
