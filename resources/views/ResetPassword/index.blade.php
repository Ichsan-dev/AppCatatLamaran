@extends('Halaman-Dashboard.index')
@section('Content-Header')
     <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Password Change Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
@endsection
@section('NavLink')
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('Company')}}" class="nav-link">
                <i class="fas fa-building nav-icon"></i>
              <p>
                Companies
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('Jobs')}}" class="nav-link">
               <i class="fas fa-briefcase nav-icon"></i>
              <p>
                Jobs
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('Apps')}}" class="nav-link">
                <i class="far fa-clipboard nav-icon"></i>
              <p>
                Aplications
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('ResetPassword')}}" class="nav-link active">
                <i class="fas fa-unlock-alt nav-icon"></i>
              <p>
                Ubah Password
              </p>
            </a>
          </li>
        </ul>
      </nav>
@endsection
@section('Content')
    <div class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card" style="margin: 3rem">
                  <div class="card-header">Reset Kata Sandi</div>

                  <div class="card-body">
                      @if (session('status'))
                          <div class="alert alert-success" role="alert">
                              {{ session('status') }}
                          </div>
                      @endif
                      @if (session('error'))
                          <div class="alert alert-danger" role="alert">
                              {{ session('error') }}
                          </div>
                      @endif

                      <form method="POST" action="{{ route('UpdatePassword') }}">
                          @csrf
                          <div class="form-group">
                              <label for="current_password">Kata Sandi Saat Ini</label>
                              <input id="current_password" type="password" class="form-control" name="current_password" value="" required>
                          </div>

                          <div class="form-group">
                              <label for="new_password">Kata Sandi Baru</label>
                              <input id="new_password" type="password" class="form-control" name="new_password" required>
                          </div>

                          <div class="form-group">
                              <label for="new_password_confirmation">Konfirmasi Kata Sandi Baru</label>
                              <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" required>
                          </div>

                          <div class="form-group mb-0">
                              <button type="submit" class="btn btn-primary">
                                  Reset Kata Sandi
                              </button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
@endsection