@extends('admin/section/app')
@section('stylesheets')
<style>
.red{
  color: red;
  font-weight: bold;
  display: inline;
}
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
                            <th>Edit</th>
                            <th>Hapus</th>
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
                                <td>
                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal2-{{ $info->id }}">
                                    Edit
                                </button>
                                <div class="modal fade" id="modal2-{{ $info->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Informasi</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="display: block;">
                                        <form role="form" action="{{ route('admin/update/info') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                                            @csrf
                                            <input id="id_info" name="id_info" value="{{$info->id}}" hidden/>
                                            <div class="form-group">
                                                <div class="row px-3">
                                                    <label class="mb-1"> <h6 class="mb-0 text-sm text-bold">Judul<p class="red">*</p></h6></label>
                                                    <input class="form-control" type="text" name="nama" value="{{ $info->nama }}" placeholder="Masukkan Judul Informasi" required autofocus>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row px-3">
                                                    <label class="mb-1"> <h6 class="mb-0 text-sm text-bold">Sub-judul<p class="red">*</p></h6></label>
                                                    <input class="form-control" type="text" name="subjudul" value="{{ $info->subjudul }}" placeholder="Masukkan Sub-judul Informasi" required autofocus>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row px-3">
                                                    <label class="mb-1"> <h6 class="mb-0 text-sm text-bold">Deskripsi Informasi</h6></label>
                                                    <textarea type="text" name="deskripsi" class="form-control" value="{{ $info->deskripsi }}" id="summernote" placeholder="Masukkan Deskripsi Informasi yang baru"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row px-3">
                                                    <label class="mb-1"> <h6 class="mb-0 text-sm text-bold">Gambar</h6></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <button type="button" id="inputGroupFileAddon03"><i class="fas fa-file-upload"></i>
                                                            </button>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="gambar" accept="image/png" id="gambar" aria-describedby="inputGroupFileAddon03">
                                                            <label class="custom-file-label"  id="idgambar" for="gambar">Upload Gambar Terbaru</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row px-3">
                                                    <label class="mb-1"> <h6 class="mb-0 text-sm text-bold">Tipe Informasi: <p class="red">*</p></h6></label><br>
                                                    <input class="form-control" type="text" id="tipe" name="tipe" value="{{ $info->tipe }}" placeholder="Masukkan Tipe Informasi" required autofocus readonly>
                                                    <div class="dropdown">
                                                    <div class="btn btn-primary mb-2 mt-2" type="button" data-toggle="dropdown">Tipe Informasi
                                                        <i class="fas fa-caret-down"></i>
                                                    </div>
                                                    <ul class="dropdown-menu univ_dropdown">
                                                        <li class="dropdown-item">
                                                            <a onclick="semesterSetter('Artikel')">Artikel</a>
                                                        </li>
                                                        <li class="dropdown-item">
                                                            <a onclick="semesterSetter('Kegiatan')">Kegiatan</a>
                                                        </li>
                                                    </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3 px-3"> <button type="submit" class="btn btn-primary text-center">Edit</button> </div>
                                        </form>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                        </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                    </div>
                                </td>
                                <td>
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal3-{{ $info->id }}">
                                    Hapus
                                </button>
                                    <div class="modal fade" id="modal3-{{ $info->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p style="text-align: center; font-weight: bold; font-size: 16px">Apakah anda yakin ingin menghapus informasi ini?</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Tidak</button>
                                            <form action="{{ route('admin/delete/info', $info->id) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
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
                                <td>{{ $info->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0">
                    {{ $infos->links("pagination::bootstrap-4") }}
                </ul>
            </div>
        </div>
    </section>
</div>
@endsection
@section('scripts')
<script>
$(document).ready(function(){
  $('#gambar').change(function(e2){
		var gambar = e2.target.files[0].name;
        // dd(gambar);
		$('#idgambar').html(gambar);
	});
});
function semesterSetter(semester){
  document.getElementById('tipe').value = semester;
}
</script>
@endsection
