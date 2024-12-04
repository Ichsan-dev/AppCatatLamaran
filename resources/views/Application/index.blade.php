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
              <li class="breadcrumb-item active">Application Letter Page</li>
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
            <a href="{{route('Apps')}}" class="nav-link active">
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
                <h3 class="card-title">Application Letter Table</h3>
                <button type="button" class="btn btn-success ml-auto" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-plus-square"></i> New Cover Letter</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr class="text-center">
                      <th style="width: 10px">#</th>
                      <th>Company Name</th>
                      <th>Position</th>
                      <th>Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($dataApp as $index => $item)
                    <tr>
                      <td>{{$dataApp->firstItem() + $index }}</td>
                      <td>{{ $item->jobs->company->name ?? 'N/A' }}</td>
                      <td>{{ $item->jobs->position ?? 'N/A' }}</td>
                      <td>
                        {{$item->application_date}}
                      </td>
                      <td class=" text-center">
                        <span 
                            class="badge py-2 px-3 rounded-pill
                            {{ $item->status == 'Accepted' ? 'bg-success' : ($item->status == 'Rejected' ? 'bg-danger' : ($item->status == 'Pending' ? 'bg-warning text-dark' : 'bg-secondary')) }}">
                            {{ $item->status }}
                        </span>
                      </td>
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
                                <h5 class="modal-title" id="exampleModalLabel">Form Edit Letter</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('AppsEdit', ['id' => $item->id])}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                       <div class="form-group">
                                            <label for="exampleInputSiswa">Position Name</label>
                                            <select name="job_id" class="form-control" id="job_id">
                                                <option disabled value="{{$item->job_id}}">-- {{$item->jobs->position}} --</option>
                                                @foreach($dataJobs as $job)
                                                    <option value="{{ $job->id }}" 
                                                        {{ isset($dataApp) && $dataApp->contains('job_id', $job->id) ? 'selected' : '' }}>
                                                        {{ $job->position }} di {{$job->company->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="application_date">Application Date</label>
                                            <input type="date" name="application_date" class="form-control" id="application_date" value="{{$item->application_date}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <!-- Opsi pertama menampilkan status yang ada di database -->
                                                <option value="{{$item->status}}" disabled selected>-- {{$item->status}} --</option>
                                                
                                                <!-- Opsi berikutnya sesuai dengan status yang ada -->
                                                <option value="Pending" {{ old('status', $application->status ?? '') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="Interview" {{ old('status', $application->status ?? '') == 'Interview' ? 'selected' : '' }}>Interview</option>
                                                <option value="Accepted" {{ old('status', $application->status ?? '') == 'Accepted' ? 'selected' : '' }}>Accepted</option>
                                                <option value="Rejected" {{ old('status', $application->status ?? '') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                            </select>
                                        </div>
                                         <div class="form-group">
                                <label for="exampleFormControlInput1">Notes</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Test pertama" value="{{$item->notes}}" name="notes">
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
                                  <p>Apakah anda yakin ingin menghapus data lamaran pekerjaan <b>{{ $item->jobs->position}}</b> ?</p>
                                </div>
                                <div class="modal-footer" style="display: flex; justify-content: flex-end;">
                                  <form action="{{route('AppsDelete', ['id' => $item->id])}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
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
               {{ $dataApp->links('pagination::bootstrap-4') }}
              </div>
            </div>

        <!-- /.row -->
      </div><!-- /.container-fluid -->

      <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form New Jobs</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('AppsProses')}}" method="POST">
                        @csrf
                         <div class="form-group">
                                <label for="exampleInputSiswa">Position Name</label>
                                <select name="job_id" class="form-control" id="job_id">
                                    <option disabled value="">-- Pilih Posisi --</option>
                                    @foreach($dataJobs as $job)
                                        <option value="{{ $job->id }}" 
                                            {{ isset($dataApp) && $dataApp->contains('job_id', $job->id) ? 'selected' : '' }}>
                                            {{ $job->position }} di {{$job->company->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="application_date">Application Date</label>
                                <input type="date" name="application_date" class="form-control" id="application_date" required>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="Pending" {{ old('status', $application->status ?? '') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Interview" {{ old('status', $application->status ?? '') == 'Interview' ? 'selected' : '' }}>Interview</option>
                                    <option value="Accepted" {{ old('status', $application->status ?? '') == 'Accepted' ? 'selected' : '' }}>Accepted</option>
                                    <option value="Rejected" {{ old('status', $application->status ?? '') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Notes</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Test pertama" name="notes">
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