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
              <li class="breadcrumb-item active">Companies Page</li>
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
            <a href="{{route('Company')}}" class="nav-link active">
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
            <a href="{{route('ResetPassword')}}" class="nav-link">
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
        
            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Company Table</h3>
                <button type="button" class="btn btn-success ml-auto" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-plus-square"></i> New Company</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Company Name</th>
                      <th>Location</th>
                      <th>Website</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($DataCompany as $index => $item)
                    <tr>
                      <td>{{$DataCompany->firstItem() + $index }}</td>
                      <td>{{$item->name}}</td>
                      <td class="text-truncate" style="max-width: 200px;">
                        {{$item->location}}
                      </td>
                      <td>{{$item->website}}</td>
                      <td class="d-flex justify-content-around">
                        <a data-toggle="modal" data-target="#modalEdit{{$item->id}}" class="btn-sm btn-warning">
                            <i class="fas fa-pen "></i>
                        </a>
                        <a data-toggle="modal" data-target="#modal-hapus{{ $item->id }}" class="btn-sm btn-danger">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                      </td>
                    </tr>

                     <!-- Modal Edit-->
                    <div class="modal fade" id="modalEdit{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Form Edit Company</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('CompanyEdit', ['id' => $item->id])}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Company Name</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1" value="{{$item->name}}" name="companyname">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Industry</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1" value="{{$item->industry}}" name="companyindustry">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Website</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1" value="{{$item->website}}" name="companywebsite">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Location</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="companylocation">{{$item->location}}</textarea>
                                        </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                            </form>
                            </div>
                        </div>
                    </div>
                {{-- Modal End --}}

                  <!-- Modal Hapus -->
                          <div class="modal fade" id="modal-hapus{{ $item->id}}">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <p>Apakah anda yakin ingin menghapus data perusahaan <b>{{ $item->name}}</b> ?</p>
                                </div>
                                <div class="modal-footer" style="display: flex; justify-content: flex-end;">
                                  <form action="{{route('CompanyDelete', ['id' => $item->id])}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
                                    <button type="submit" class="btn btn-warning">Ya, Hapus Data</button>
                                  </form>
                                </div>
                              </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>
                            <!-- Modal Hapus -->
                     @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix d-flex justify-content-end">
               {{ $DataCompany->links('pagination::bootstrap-4') }}
              </div>
            </div>

        <!-- /.row -->
      </div><!-- /.container-fluid -->

      <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form New Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('Company-Proses')}}" method="POST">
                        @csrf
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Company Name</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="PT ABC" name="companyname">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Industry</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Minning & Web Development" name="companyindustry">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Website</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="ABCJaya.Com" name="companywebsite">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Location</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="companylocation"></textarea>
                            </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
                </div>
            </div>
        </div>
    {{-- Modal End --}}

    </div>
@endsection