@extends('admin/section/app')
@section('stylesheets')
<style>
</style>
@endsection

@section('content')
<div class="content-wrapper">
    {{--<link rel="stylesheet" href="{{asset('css/admin_side.css')}}" type="text/css"/>--}}
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DAFTARKAN ADMIN</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Admin</li>
              <li class="breadcrumb-item text-blue"><a href="{{ route('admin/register') }}">Daftarkan Admin</a></li>
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
          <div class="main_container d-flex">
            <div class="part_left">
                <form role="form" action="{{ route('admin/register/process') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <div class="row px-3">
                            <label class="mb-1"> <h6 class="mb-0 text-sm text-bold">Nama Admin</h6></label>
                            <input class="form-control" type="text" name="nama" placeholder="Masukkan Nama Lengkap" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row px-3">
                            <label class="mb-1"> <h6 class="mb-0 text-sm text-bold">Alamat Email</h6></label>
                            <input class="form-control" type="email" name="email" placeholder="Masukkan Alamat Email" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row px-3">
                            <label class="mb-1"> <h6 class="mb-0 text-sm text-bold">Nomor HP</h6></label>
                            <input class="form-control" type="no_hp" name="no_hp" placeholder="Masukkan Nomor Handphone Aktif" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row px-3">
                            <label class="mb-1"> <h6 class="mb-0 text-sm text-bold">Password (nanti akan diganti oleh pengguna)</h6></label>
                            <input id="pass_create" class="form-control" type="password" name="password" placeholder="Masukkan Password"  required autofocus>
                        </div>
                    </div>
                    <div class="row mb-3 px-3"> <button type="submit" class="btn btn-primary text-center">Create</button> </div>
                </form>
            </div>
          </div>
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
@endsection