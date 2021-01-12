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
            <h1>LIST ALAT BARANG</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">Alat Barang</li>
                <li class="breadcrumb-item text-blue"><a href="{{ route('admin/list/stuff') }}">List Alat Barang</a></li>
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
                            <th>Nama Alat</th>
                            <th>Status Alat</th>
                            <th>Harga Sewa</th>
                            <th>Gambar</th>
                            <th>Admin Penginput</th>
                            <th>Edit</th>
                            <th>Hapus</th>
                            <th>Created at</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($alats as $alat)
                            <tr>
                                <td>{{ $alat->nama_alat }}</td>
                                <td>{{ $alat->status_barang }}</td>
                                <td>{{ $alat->harga_sewa }}</td>
                                <td>
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal1-{{ $alat->id }}">
                                    Lihat Gambar
                                </button>
                                <div class="modal fade" id="modal1-{{ $alat->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Gambar Alat Barang</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="display: block;">
                                                <img src="{{asset('Data/AlatBarang/').'/'.$alat->gambar}}" alt=" Belum ada gambar, silahkan tambah gambar melalui menu edit" width="100%" height="auto" frameborder="0" style="margin-left: auto; margin-right: auto; display:block;"></img>
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
                                <td>{{ $alat->nama_admin }}</td>
                                <td>
                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal2-{{ $alat->id }}">
                                    Edit
                                </button>
                                <div class="modal fade" id="modal2-{{ $alat->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Alat Barang</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="display: block;">
                                        <form role="form" action="{{ route('admin/update/stuff') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                                            @csrf
                                            <input id="id_alat" name="id_alat" value="{{$alat->id}}" hidden/>
                                            <div class="form-group">
                                                <div class="row px-3">
                                                    <label class="mb-1"> <h6 class="mb-0 text-sm text-bold">Nama Barang<p class="red">*</p></h6></label>
                                                    <input class="form-control" type="text" name="nama" value="{{$alat->nama_alat}}" placeholder="Masukkan Nama Lengkap Barang" required autofocus>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row px-3">
                                                    <label class="mb-1"> <h6 class="mb-0 text-sm text-bold">Harga Sewa<p class="red">*</p></h6></label>
                                                    <input class="form-control" type="text" name="harga" value="{{$alat->harga_sewa}}" placeholder="Masukkan Harga Sewa" required autofocus>
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
                                                            <label class="custom-file-label"  id="idgambar" for="gambar">Upload Gambar Barang Terbaru</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row px-3">
                                                    <label class="mb-1"> <h6 class="mb-0 text-sm text-bold">Status Barang: <p class="red">*</p></h6></label><br>
                                                    <input class="form-control" type="text" id="status" name="status" value="{{$alat->status_barang}}" placeholder="Status Barang" required autofocus readonly>
                                                    <div class="dropdown">
                                                    <div class="btn btn-primary mb-2 mt-2" type="button" data-toggle="dropdown">Pilih Status Barang
                                                        <i class="fas fa-caret-down"></i>
                                                    </div>
                                                    <ul class="dropdown-menu univ_dropdown">
                                                        <li class="dropdown-item">
                                                            <a onclick="semesterSetter('Baik')">Baik</a>
                                                        </li>
                                                        <li class="dropdown-item">
                                                            <a onclick="semesterSetter('Rusak')">Rusak</a>
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
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal3-{{ $alat->id }}">
                                    Hapus
                                </button>
                                    <div class="modal fade" id="modal3-{{ $alat->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p style="text-align: center; font-weight: bold; font-size: 16px">Apakah anda yakin ingin menghapus alat ini?</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Tidak</button>
                                            <form action="{{ route('admin/delete/stuff', $alat->id) }}" method="post">
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
                                <td>{{ $alat->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0">
                    {{ $alats->links("pagination::bootstrap-4") }}
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
  document.getElementById('status').value = semester;
}
</script>
@endsection