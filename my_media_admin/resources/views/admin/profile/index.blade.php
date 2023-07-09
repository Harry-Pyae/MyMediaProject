@extends('admin.layouts.app')

@section('content')
<div class="col-8 offset-3 mt-5">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">User Profile</legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
                {{-- alert start --}}
                @if (Session::has('updateSuccess'))
                    <div class="d-block alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('updateSuccess') }}</strong> You can update your account details any time.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                @endif
                {{-- alert end --}}

              <form class="form-horizontal" method="post" action="{{route('admin#update')}}">
                @csrf
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="adminName" id="inputName" placeholder="Enter your Name" value="{{ $user->name }}">
                    @error('adminName')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" name="adminEmail" id="inputEmail" placeholder="Enter your Email" value="{{ $user->email }}">
                    @error('adminEmail')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                      <input type="phone" class="form-control" name="adminPhone" id="inputNumber" placeholder="Enter your Phone number" value="{{ $user->phone }}">
                    </div>
                  </div>
                <div class="form-group row">
                    <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <textarea cols="30" rows="10" name="adminAddress" placeholder="Enter your Address" class="form-control">{{ $user->address }}</textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputGender" class="col-sm-2 col-form-label">Gender</label>
                    <div class="col-sm-10">
                        <select name="adminGender" class="form-control">
                            @if ($user->gender == 'male')
                            <option value="empty">Choose your gender</option>
                            <option value="male" selected>Male</option>
                            <option value="female">Female</option>

                            @elseif ($user->gender == 'female')
                            <option value="empty">Choose your gender</option>
                            <option value="male">Male</option>
                            <option value="female" selected>Female</option>

                            @else
                            <option value="empty" selected>Choose your gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            @endif
                        </select>
                    </div>
                  </div>

                <div class="form-group row">
                  <div class="offset-sm-8 col-sm-3 text-end">
                    <a href="{{route('admin#changePassword')}}">Change Password</a>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="offset-sm-9 col-sm-3 text-end">
                    <button type="submit" class="btn bg-dark text-white">Update</button>
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
