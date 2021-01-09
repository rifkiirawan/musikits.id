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
            <h1>LIST INFORMASI</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">Informasi</li>
                <li class="breadcrumb-item text-blue"><a href="{{ route('admin/list/info') }}">List Informasi</a></li>
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
                            <th>Judul</th>
                            <th>Sub-judul</th>
                            <th>Tipe Informasi</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Admin Penulis</th>
                            <th>Created at</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($infos as $info)
                            <tr>
                                <td>{{ $info->nama }}</td>
                                <td>{{ $info->subjudul }}</td>
                                <td>{{ $info->tipe }}</td>
                                <td>
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-{{ $info->id }}">
                                    Lihat Deskripsi
                                </button>
                                <div class="modal fade" id="modal-{{ $info->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Deskripsi Informasi</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="display: block;">
                                            <p>{{$info->deskripsi}}</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                        </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                    </div>
                                </td>
                                <td>
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal1-{{ $info->id }}">
                                    Lihat Gambar
                                </button>
                                <div class="modal fade" id="modal1-{{ $info->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Gambar Informasi</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="display: block;">
                                                <img src="{{asset('Data/Informasi/').'/'.$info->gambar}}" width="100%" height="auto" frameborder="0" style="margin-left: auto; margin-right: auto; display:block;"></img>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                        </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                    </div>
                                </td>
                                <td>{{ $info->nama_admin }}</td>
                                <td>{{ $info->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    {{ $infos->links() }}
                    {{-- <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li> --}}
                </ul>
            </div>
        </div>
    </section>
</div>
@endsection