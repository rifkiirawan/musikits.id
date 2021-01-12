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
            <h1>DAFTAR INVENTARIS</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">Inventaris</li>
                <li class="breadcrumb-item text-blue"><a href="{{ route('show-list-inventory') }}">Daftar Inventaris</a></li>
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
                            <th>ID Inventory</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Detail Inventaris</th>
                            <th>Hapus</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($inventaris as $inventory)
                            <tr>
                                <td>{{ $inventory->id }}</td>
                                <td>{{ $inventory->bulan }}</td>
                                <td>{{ $inventory->tahun }}</td>
                                <td>
                                    <a href="{{ route('detail-inventory', $inventory->id) }}">Lihat Detail</a>
                                </td>
                                <td>
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal3-{{ $inventory->id }}">
                                    Hapus
                                </button>
                                    <div class="modal fade" id="modal3-{{ $inventory->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p style="text-align: center; font-weight: bold; font-size: 16px">Apakah anda yakin ingin menghapus data inventaris ini?</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Tidak</button>
                                            <form action="{{ route('admin/delete/inventory', $inventory->id) }}" method="post">
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
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0">
                    {{ $inventaris->links("pagination::bootstrap-4") }}
                </ul>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')

@endsection