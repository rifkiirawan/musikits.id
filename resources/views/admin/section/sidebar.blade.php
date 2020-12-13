<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a class="d-block">ADMIN</a>
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
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>Beranda</p>
            </a>
          </li>
          {{-- Home --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Apply
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ml-4">
                <a href="#" class="nav-link">
                  @if (request()->path() == 'dashboard/list-current-apply')
                    <i class="fas fa-circle nav-icon text-info"></i>
                  @else
                    <i class="far fa-circle nav-icon"></i>
                  @endif
                  <p>Daftar apply semester ini</p>
                </a>
              </li>
              <li class="nav-item ml-4">
                <a href="#" class="nav-link">
                  @if (request()->path() == 'dashboard/history-apply')
                    <i class="fas fa-circle nav-icon text-info"></i>
                  @else
                    <i class="far fa-circle nav-icon"></i>
                  @endif
                  <p>Histori Apply</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- Kembali ke beranda --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-arrow-left"></i>
              <p>Kembali</p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>