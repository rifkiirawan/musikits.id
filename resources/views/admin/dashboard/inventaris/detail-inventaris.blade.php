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
            <h1>LIST ALAT BARANG INVENTARIS {{ $inventaris[0]->bulan }} - {{ $inventaris[0]->tahun }}</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">Alat Barang</li>
                <li class="breadcrumb-item">List Alat Barang Inventaris {{ $inventaris[0]->bulan }} - {{ $inventaris[0]->tahun }}</li>
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
                            <th>Gambar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($alats as $alat)
                            <tr>
                                <td>{{ $alat->nama_alat }}</td>
                                <td>{{ $alat->status_barang }}</td>
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
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    {{-- {{ $alats->links() }} --}}
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

@section('scripts')

@endsection