<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a class="d-block">{{$nama}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-header">MENU UTAMA</li>

          {{-- Home --}}
          <li class="nav-item">
            <a href="{{ route('admin/home')}}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>Beranda</p>
            </a>
          </li>
          {{-- Home --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                Admin
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ml-4">
                <a href="{{route('admin/register')}}" class="nav-link">
                  @if (request()->path() == 'admin/dashboard/register-admin')
                    <i class="fas fa-circle nav-icon text-info"></i>
                  @else
                    <i class="far fa-circle nav-icon"></i>
                  @endif
                  <p>Daftarkan admin</p>
                </a>
              </li>
              <li class="nav-item ml-4">
                <a href="{{route('admin/list')}}" class="nav-link">
                  @if (request()->path() == 'admin/dashboard/list-admin')
                    <i class="fas fa-circle nav-icon text-info"></i>
                  @else
                    <i class="far fa-circle nav-icon"></i>
                  @endif
                  <p>List Admin</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- Home --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Pengguna
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ml-4">
                <a href="{{route('list-account-anggota')}}" class="nav-link">
                  @if (request()->path() == 'admin/dashboard/list-account-anggota')
                    <i class="fas fa-circle nav-icon text-info"></i>
                  @else
                    <i class="far fa-circle nav-icon"></i>
                  @endif
                  <p>Daftar Pengguna Anggota</p>
                </a>
              </li>
              <li class="nav-item ml-4">
                <a href="{{route('list-account-umum')}}" class="nav-link">
                  @if (request()->path() == 'admin/dashboard/list-account-umum')
                    <i class="fas fa-circle nav-icon text-info"></i>
                  @else
                    <i class="far fa-circle nav-icon"></i>
                  @endif
                  <p>Daftar Pengguna Umum</p>
                </a>
              </li>
              <li class="nav-item ml-4">
                <a href="{{route('list-new-account-anggota')}}" class="nav-link">
                  @if (request()->path() == 'admin/dashboard/list-new-account-anggota')
                    <i class="fas fa-circle nav-icon text-info"></i>
                  @else
                    <i class="far fa-circle nav-icon"></i>
                  @endif
                  <p>Verifikasi Pengguna Anggota</p>
                </a>
              </li>
              <li class="nav-item ml-4">
                <a href="{{route('list-new-account-umum')}}" class="nav-link">
                  @if (request()->path() == 'admin/dashboard/list-new-account-umum')
                    <i class="fas fa-circle nav-icon text-info"></i>
                  @else
                    <i class="far fa-circle nav-icon"></i>
                  @endif
                  <p>Verifikasi Pengguna Umum</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-info-circle"></i>
              <p>
                Informasi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ml-4">
                <a href="{{route('admin/create/info')}}" class="nav-link">
                  @if (request()->path() == 'admin/dashboard/create-info')
                    <i class="fas fa-circle nav-icon text-info"></i>
                  @else
                    <i class="far fa-circle nav-icon"></i>
                  @endif
                  <p>Tambahkan Informasi</p>
                </a>
              </li>
              <li class="nav-item ml-4">
                <a href="{{route('admin/list/info')}}" class="nav-link">
                  @if (request()->path() == 'admin/dashboard/list-info')
                    <i class="fas fa-circle nav-icon text-info"></i>
                  @else
                    <i class="far fa-circle nav-icon"></i>
                  @endif
                  <p>List Informasi</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Alat Barang
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ml-4">
                <a href="{{route('admin/create/stuff')}}" class="nav-link">
                  @if (request()->path() == 'admin/dashboard/create-stuff')
                    <i class="fas fa-circle nav-icon text-info"></i>
                  @else
                    <i class="far fa-circle nav-icon"></i>
                  @endif
                  <p>Tambahkan Alat Barang</p>
                </a>
              </li>
              <li class="nav-item ml-4">
                <a href="{{route('admin/list/stuff')}}" class="nav-link">
                  @if (request()->path() == 'admin/dashboard/list-stuff')
                    <i class="fas fa-circle nav-icon text-info"></i>
                  @else
                    <i class="far fa-circle nav-icon"></i>
                  @endif
                  <p>List Alat Barang</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-dolly-flatbed"></i>
              <p>
                Inventaris
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ml-4">
                <a href="{{route('show-create-inventory')}}" class="nav-link">
                  @if (request()->path() == 'admin/dashboard/create-inventory')
                    <i class="fas fa-circle nav-icon text-info"></i>
                  @else
                    <i class="far fa-circle nav-icon"></i>
                  @endif
                  <p>Buat Inventaris</p>
                </a>
              </li>
              <li class="nav-item ml-4">
                <a href="{{route('show-list-inventory')}}" class="nav-link">
                  @if (request()->path() == 'admin/dashboard/list-inventory')
                    <i class="fas fa-circle nav-icon text-info"></i>
                  @else
                    <i class="far fa-circle nav-icon"></i>
                  @endif
                  <p>Daftar Inventaris</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Sewa Studio
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ml-4">
                <a href="{{route('list-booking-studio')}}" class="nav-link">
                  @if (request()->path() == 'admin/dashboard/list-studio-booking')
                    <i class="fas fa-circle nav-icon text-info"></i>
                  @else
                    <i class="far fa-circle nav-icon"></i>
                  @endif
                  <p>Daftar Sewa Studio</p>
                </a>
              </li>
              <li class="nav-item ml-4">
                <a href="{{route('list-new-booking-studio')}}" class="nav-link">
                  @if (request()->path() == 'admin/dashboard/list-new-studio-booking')
                    <i class="fas fa-circle nav-icon text-info"></i>
                  @else
                    <i class="far fa-circle nav-icon"></i>
                  @endif
                  <p>Verifikasi Sewa Studio</p>
                </a>
              </li>
              <li class="nav-item ml-4">
                <a href="{{route('calendar-booking-studio')}}" class="nav-link">
                  @if (request()->path() == 'admin/dashboard/calendar-studio-booking')
                    <i class="fas fa-circle nav-icon text-info"></i>
                  @else
                    <i class="far fa-circle nav-icon"></i>
                  @endif
                  <p>Kalender Sewa Studio</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book-open"></i>
              <p>
                Sewa Alat
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ml-4">
                <a href="{{route('list-booking-stuff')}}" class="nav-link">
                  @if (request()->path() == 'admin/dashboard/list-stuff-booking')
                    <i class="fas fa-circle nav-icon text-info"></i>
                  @else
                    <i class="far fa-circle nav-icon"></i>
                  @endif
                  <p>Daftar Sewa Alat</p>
                </a>
              </li>
              <li class="nav-item ml-4">
                <a href="{{route('list-new-booking-stuff')}}" class="nav-link">
                  @if (request()->path() == 'admin/dashboard/list-new-stuff-booking')
                    <i class="fas fa-circle nav-icon text-info"></i>
                  @else
                    <i class="far fa-circle nav-icon"></i>
                  @endif
                  <p>Verifikasi Sewa Alat</p>
                </a>
              </li>
              <li class="nav-item ml-4">
                <a href="{{route('calendar-booking-stuff')}}" class="nav-link">
                  @if (request()->path() == 'admin/dashboard/calendar-stuff-booking')
                    <i class="fas fa-circle nav-icon text-info"></i>
                  @else
                    <i class="far fa-circle nav-icon"></i>
                  @endif
                  <p>Kalender Sewa Alat</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>