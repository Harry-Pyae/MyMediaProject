<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Media Admin</title>
  <link rel="icon" type="image/x-icon" href="{{asset('defaultImage/admin-site-logo.ico')}}">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">

      <span class="brand-text font-weight-light"> My Media Admins Site </span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link">
              <i class="fas fa-user-circle"></i>
              <p>
                Profile
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('admin#list')}}" class="nav-link">
                <i class="fa-solid fa-user-group"></i>
              <p>
                Admin List
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('admin#category')}}" class="nav-link">
              <i class="fa-solid fa-list"></i>
              <p>
                Category
              </p>
            </a>
          </li>

         <li class="nav-item">
            <a href="{{route('admin#post')}}" class="nav-link">
                <i class="fa-solid fa-cloud-arrow-up"></i>
              <p>
                Posts
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('admin#trendPost')}}" class="nav-link">
                <i class="fa-solid fa-rocket"></i>
              <p>
                Trend Posts
              </p>
            </a>
          </li>

          <li class="nav-item">
            <form action="{{route('logout')}}" method="POST">
                @csrf
                <button type="submit" class="btn bg-dark nav-link">
                    <i class="fas fa-sign-out-alt"></i>
                    <p>
                        Logout
                      </p>
                </button>
            </form>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
            @yield('content')
        </div>
        </div>
      </div>
    </section>
  </div>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('dist/js/demo.js')}}"></script>
</body>
</html>
