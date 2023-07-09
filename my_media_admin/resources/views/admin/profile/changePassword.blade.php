@extends('admin.layouts.app')

@section('content')
<div class="col-9 offset-3 mt-5">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">Change Password</legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
                {{-- alert start --}}
                @if (Session::has('failed'))
                    <div class="d-block alert alert-danger alert-dismissible fade show text-center" role="alert">
                        <strong>{{ Session::get('failed') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                @endif
                {{-- alert end --}}

              <form class="form-horizontal" method="post" action="{{route('admin#change')}}">
                @csrf
                <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label text-center">Old Password</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" name="oldPassword" id="" placeholder="Enter old password" value="">
                    @error('oldPassword')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label text-center">New Password</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" name="newPassword" id="" placeholder="Enter new password" value="">
                    @error('newPassword')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label text-center">Confirm Password</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control" name="confirmPassword" id="" placeholder="Enter confirm password" value="">
                      @error('confirmPassword')
                        <div class="text-danger">{{$message}}</div>
                      @enderror
                    </div>
                  </div>
                <div class="form-group row pt-2">
                  <div class="row offset-8 col-3">
                    <button type="submit" class="btn bg-dark text-white text-center">Change Password</button>
                  </div>
                </div>
              </form>

            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
