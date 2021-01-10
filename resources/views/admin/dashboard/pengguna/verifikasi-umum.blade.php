@extends('admin/section/app')
@section('stylesheets')
<style>
</style>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>VERIFIKASI PENGGUNA UMUM</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">Pengguna</li>
                <li class="breadcrumb-item text-blue"><a href="{{ route('list-new-account-umum') }}">Verifikasi Pengguna Umum</a></li>
            </ol>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </div>

    {{-- main content --}}
    <section class="content">
        <div class="card">
        <div class="card-header">
          @if ($message = Session::get('sukses'))
            <div class="alert alert-success">
                {{$message}}
            </div>
          @elseif($message = Session::get('gagal'))
            <div class="alert alert-danger">
                {{$message}}
            </div>
          @endif
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="admin_table">
                        <thead class="thead-dark">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>No Telp</th>
                            <th>ID Line</th>
                            <th>Approve</th>
                            <th>Reject</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->nama_pengguna }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->alamat }}</td>
                                <td>{{ $user->no_telp }}</td>
                                <td>{{ $user->id_line }}</td>
                                <td>
                                  <span style="font-size: 25px; color: green;">
                                    <i class="far fa-check-circle" data-toggle="modal" data-target="#modal1-{{ $user->id }}"></i>
                                  </span>
                                <div class="modal fade" id="modal1-{{ $user->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p style="text-align: center; font-weight: bold; font-size: 16px">Apakah anda yakin ingin meng-approve akun ini secara permanen?</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Tidak</button>
                                            <form action="{{ route('umum.approve', $user->id) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('put') }}
                                                <button type="submit" class="btn btn-sm btn-success">Yakin</button>
                                            </form>
                                        </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
                                </td>
                                <td>
                                    <span style="font-size: 25px; color: red;">
                                      <i class="fas fa-times-circle" data-toggle="modal" data-target="#modal2-{{ $user->id }}"></i>
                                    </span>
                                    <div class="modal fade" id="modal2-{{ $user->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p style="text-align: center; font-weight: bold; font-size: 16px">Apakah anda yakin ingin me-reject akun ini secara permanen?</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Tidak</button>
                                            <form action="{{ route('umum.reject', $user->id) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('put') }}
                                                <button type="submit" class="btn btn-sm btn-danger">Yakin</button>
                                            </form>
                                        </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0">
                    {{ $users->links("pagination::bootstrap-4") }}
                </ul>
            </div>
        </div>
    </section>
</div>
@endsection