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
            <h1>VERIFIKASI SEWA ALAT</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">Sewa Alat</li>
                <li class="breadcrumb-item text-blue"><a href="{{ route('list-new-booking-stuff') }}">Verifikasi Sewa Alat</a></li>
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
                            <th>Nama Pengguna</th>
                            <th>No Telp</th>
                            <th>Waktu Mulai</th>
                            <th>Waktu Selesai</th>
                            <th>Approve</th>
                            <th>Reject</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td>{{ $booking->nama_alat }}</td>
                                <td>{{ $booking->nama_pengguna }}</td>
                                <td>{{ $booking->no_telp }}</td>
                                <td>{{ $booking->waktu_mulai }}</td>
                                <td>{{ $booking->waktu_selesai }}</td>
                                <td>
                                  <span style="font-size: 25px; color: green;">
                                    <i class="far fa-check-circle" data-toggle="modal" data-target="#modal1-{{ $booking->id }}"></i>
                                  </span>
                                <div class="modal fade" id="modal1-{{ $booking->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p style="text-align: center; font-weight: bold; font-size: 16px">Apakah anda yakin ingin meng-approve penyewaan ini secara permanen?</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Tidak</button>
                                            <form action="{{ route('booking.stuff.approve', $booking->id) }}" method="post">
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
                                      <i class="fas fa-times-circle" data-toggle="modal" data-target="#modal2-{{ $booking->id }}"></i>
                                    </span>
                                    <div class="modal fade" id="modal2-{{ $booking->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p style="text-align: center; font-weight: bold; font-size: 16px">Apakah anda yakin ingin me-reject penyewaan ini secara permanen?</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Tidak</button>
                                            <form action="{{ route('booking.stuff.reject', $booking->id) }}" method="post">
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
                    {{ $bookings->links("pagination::bootstrap-4") }}
                </ul>
            </div>
        </div>
    </section>
</div>
@endsection