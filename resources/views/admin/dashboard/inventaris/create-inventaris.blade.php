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
    {{--<link rel="stylesheet" href="{{asset('css/admin_side.css')}}" type="text/css"/>--}}
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>TAMBAHKAN INVENTARIS</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Inventaris</li>
              <li class="breadcrumb-item text-blue"><a href="{{ route('show-create-inventory') }}">Tambahkan Inventaris</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
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
        <div class="card-body">
                <form role="form" action="{{ route('create-inventory') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="row px-3">
                            <label class="mb-1"> <h6 class="mb-0 text-sm text-bold">Tahun<p class="red">*</p></h6></label>
                            <input class="form-control" type="number" name="tahun" placeholder="Masukkan Tahun Inventaris" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row px-3">
                            <label class="mb-1"> <h6 class="mb-0 text-sm text-bold">Bulan: <p class="red">*</p></h6></label><br>
                            <input class="form-control" type="text" id="bulan" name="bulan" value="{{ old('bulan') }}" placeholder="Masukkan Bulan Inventaris" required autofocus readonly>
                            <div class="dropdown">
                              <div class="btn btn-primary mb-2 mt-2" type="button" data-toggle="dropdown">Bulan
                                  <i class="fas fa-caret-down"></i>
                              </div>
                              <ul class="dropdown-menu univ_dropdown">
                                  <li class="dropdown-item">
                                      <a onclick="bulanSetter('Januari')">Januari</a>
                                  </li>
                                  <li class="dropdown-item">
                                      <a onclick="bulanSetter('Februari')">Februari</a>
                                  </li>
                                  <li class="dropdown-item">
                                      <a onclick="bulanSetter('Maret')">Maret</a>
                                  </li>
                                  <li class="dropdown-item">
                                      <a onclick="bulanSetter('April')">April</a>
                                  </li>
                                  <li class="dropdown-item">
                                      <a onclick="bulanSetter('Mei')">Mei</a>
                                  </li>
                                  <li class="dropdown-item">
                                      <a onclick="bulanSetter('Juni')">Juni</a>
                                  </li>
                                  <li class="dropdown-item">
                                      <a onclick="bulanSetter('Juli')">Juli</a>
                                  </li>
                                  <li class="dropdown-item">
                                      <a onclick="bulanSetter('Agustus')">Agustus</a>
                                  </li>
                                  <li class="dropdown-item">
                                      <a onclick="bulanSetter('September')">September</a>
                                  </li>
                                  <li class="dropdown-item">
                                      <a onclick="bulanSetter('Oktober')">Oktober</a>
                                  </li>
                                  <li class="dropdown-item">
                                      <a onclick="bulanSetter('November')">November</a>
                                  </li>
                                  <li class="dropdown-item">
                                      <a onclick="bulanSetter('Desember')">Desember</a>
                                  </li>
                              </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 px-3"> <button type="submit" class="btn btn-primary text-center">Create</button> </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered" id="admin_table">
                        <thead class="thead-dark">
                        <tr>
                            <th>Nama Alat</th>
                            <th>Status Alat</th>
                            <th>Harga Sewa</th>
                            <th>Gambar</th>
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
                                                <img src="{{asset('Data/AlatBarang/').'/'.$alat->gambar}}" width="100%" height="auto" frameborder="0" style="margin-left: auto; margin-right: auto; display:block;"></img>
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
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
@endsection

@section('scripts')
<script>
function bulanSetter(bulan){
  document.getElementById('bulan').value = bulan;
}
</script>
@endsection
