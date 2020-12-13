<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin/section/admin_head')
    @yield('stylesheets')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('admin/section/admin_header')
        @include('admin/section/sidebar')
        @yield('content')
        @include('admin/section/admin_footer')
        @yield('scripts')
    </div>
</body>
</html>