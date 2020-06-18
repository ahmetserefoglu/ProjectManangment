@extends('adminlte::master')

@section('adminlte_css')
<link rel="stylesheet"
href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
@stack('css')
@yield('css')
@stop

@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
'boxed' => 'layout-boxed',
'fixed' => 'fixed',
'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@section('body')
<div class="wrapper">

    <section class="main-header">

        @include('vendor.adminlte.header')

    </section>

    @if(config('adminlte.layout') != 'top-nav')
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('/bower_components/admin-lte/dist/img/user1-128x128.jpg') }}" class="img-circle" alt="User Image" />

            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->name}}</p>
                <!-- Status -->
                @if (Auth::check())
                <a href="#"><i class="fa fa-circle text-success"></i> Online </a>
                @else
                <a href="#"><i class="fa fa-circle text-wrong"></i> Offline </a>
                @endif
            </div>
        </div>
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            @if(Auth::user()->rolename=='Super Admin')
            @each('adminlte::partials.menu-item', $adminlte->menu(), 'item')
            @elseif(Auth::user()->rolename=='Müşteri')
            <li class="header">Ana Menu</li>
            <li class="">
                <a href="/projeler">
                    <i class="fa fa-fw fa-plus-square "></i>
                    <span>Projeler</span>
                </a>
            </li>
            <li class="">
                <a href="/admin/mesajlar">
                    <i class="fa fa-fw fa-envelope-o "></i>
                    <span>Mesajlar</span>
                </a>
            </li>

            @else
            <li class="header">Ana Menu</li>
            <li class="">
                <a href="/projeler">
                    <i class="fa fa-fw fa-plus-square "></i>
                    <span>Projeler</span>
                </a>
            </li>
            <li class="">
                <a href="/admin/mesajlar">
                    <i class="fa fa-fw fa-envelope-o "></i>
                    <span>Mesajlar</span>
                </a>
            </li>
            @endif

        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
@endif

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @if(config('adminlte.layout') == 'top-nav')
    <div class="container">
        @endif

        <!-- Content Header (Page header) -->
        <section class="content-header">
            @yield('content_header')
        </section>

        <!-- Main content -->
        <section class="content">

            @yield('content')

        </section>
        <!-- /.content -->
        @if(config('adminlte.layout') == 'top-nav')
    </div>
    <!-- /.container -->
    @endif
</div>
<!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->
@stop

@section('adminlte_js')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>

<script src="{{ asset ('js/jquerycode-migrate-3.0.0.js') }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset ('/bower_components/admin-lte/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset ('/bower_components/admin-lte/plugins/fastclick/fastclick.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset ('/bower_components/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset ('/bower_components/admin-lte/dist/js/demo.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset ('/bower_components/admin-lte/dist/js/app.min.js') }}"></script>

<script src="{{ asset ('/bower_components/admin-lte/dist/js/app.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset ('/bower_components/admin-lte/plugins/chart.js/Chart.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset ('/bower_components/admin-lte/plugins/raphael/raphael.min.js') }}"></script>
<!-- FLOT CHARTS -->
<script src="{{ asset ('/bower_components/admin-lte/plugins/Flot/jquery.flot.js') }}"></script>
<script src="{{ asset ('/bower_components/admin-lte/plugins/morris.js/morris.min.js') }}"></script>
<script src="{{ asset ('/bower_components/admin-lte/plugins/Flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset ('/bower_components/admin-lte/plugins/Flot/jquery.flot.pie.js') }}"></script>
<script src="{{ asset ('/bower_components/admin-lte/plugins/Flot/jquery.flot.categories.js') }}"></script>
<script src="{{ asset ('/bower_components/admin-lte/plugins/morris.js/morris.min.js') }}"></script>
<script src="{{ asset ('/bower_components/admin-lte/plugins/chart.js/Chart.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset ('/bower_components/admin-lte/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset ('/bower_components/admin-lte/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset ('/bower_components/admin-lte/plugins/iCheck/icheck.min.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset ('/bower_components/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset ('/bower_components/admin-lte/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('/bower_components/admin-lte/plugins/select2/select2.full.min.js')}}"></script>
<!-- InputMask -->
<script src="{{ asset('/bower_components/admin-lte/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{ asset('/bower_components/admin-lte/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{ asset('/bower_components/admin-lte/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('/bower_components/admin-lte/plugins/colorpicker/bootstrap-colorpicker.min.js')}}"></script>
<!-- bootstrap time picker -->
<script src="{{ asset('/bower_components/admin-lte/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<!-- date-range-picker -->
<script src="{{ asset('bower_components/admin-lte/plugins/moment/min/moment.min.js')}}"></script>
<script src="{{ asset('bower_components/admin-lte/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('bower_components/admin-lte/plugins/colorpicker/bootstrap-colorpicker.min.js')}}"></script>
<!-- bootstrap time picker -->
<script src="{{ asset('bower_components/admin-lte/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<!-- SlimScroll 1.3.0 -->
<script src="{{ asset('bower_components/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{ asset('bower_components/admin-lte/plugins/iCheck/icheck.min.js')}}"></script>
<!-- FastClick -->
<script src="{{ asset('bower_components/admin-lte/plugins/fastclick/fastclick.js')}}"></script>
<!-- PACE -->
<script src="{{ asset('/bower_components/admin-lte/plugins/pace/pace.min.js')}}"></script>
<!-- fullCalendar 2.2.5 -->
<script src="{{ asset('/bower_components/admin-lte/plugins/fullcalendar/fullcalendar.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('/bower_components/admin-lte/plugins/jQueryUI/jquery-ui.min.js')}}"></script>
<script src="{{ asset('/bower_components/admin-lte/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('bower_components/jquery-ui/ui/datepicker.js')}}"></script>
<!-- bootstrap datepicker -->
<script src="{{ asset('bower_components/admin-lte/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<!-- jvectormap -->
<script src="{{ asset('bower_components/admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{ asset('bower_components/admin-lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="{{ asset('datatable/angular-datatables.min.js')}}"></script>

<script src="{{asset('js/dirPagination.js')}}"></script>

<script src="{{asset('assets/js/app.js')}}"></script>

<script src="{{asset('assets/js/home.js')}}"></script>

<script src="{{asset('assets/js/shopping.js')}}"></script>

<script src="{{asset('assets/js/kullanici.js')}}"></script>

<script src="{{asset('assets/js/roller.js')}}"></script>

<script src="{{asset('assets/js/calendar.js')}}"></script>

<script src="{{asset('assets/js/mesajlar.js')}}"></script>

<script src="{{asset('assets/js/duyuru.js')}}"></script>

<script src="{{asset('assets/js/projetakipA.js')}}"></script>

<script src="{{asset('js/dropzone.min.js')}}"></script>

<script src="{{asset('js/dropzonefile.js')}}"></script>

<script src="{{asset('js/dropzone.js')}}"></script>

<script src="{{asset('assets/js/jspdf.js')}}"></script>

<script src="{{asset('js/lightbox.js')}}"></script>

<script src="{{asset('js/dhtmlxgantt.js')}}"></script>

<script src="{{asset('assets/js/gantt.js')}}"></script>

<script src="{{asset('assets/js/palet.js')}}"></script>

<script src="{{asset('assets/js/pdfFromHtml.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{ asset ('/js/adminlte.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset ('/js/adminlte.min.js') }}"></script>

<script src="{{ asset ('/js/sidebartoggle.js') }}"></script>

<script src="{{ asset ('/js/dataTables.cellEdit.js') }}"></script>

<script src="{{ asset ('/js/dataTables.alphabetSearch.min.js') }}"></script>

<script src="{{ asset ('/js/jquery.dataTables.rowReordering.js') }}"></script>

<script src="{{ asset ('/js/jquery.mockjax.min.js') }}"></script>

<script src="{{ asset ('/js/ColReorderWithResize.js') }}"></script>

<script src="{{ asset ('/js/bootstrap3-typeahead.js') }}"></script>




  @stack('js')
  @yield('js')
  @stop

