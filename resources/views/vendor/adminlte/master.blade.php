<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title_prefix', config('adminlte.title_prefix', ''))</title>


    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link href="{{ asset('/bower_components/admin-lte/dist/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Bootstrap time Picker -->
    <link href="{{ asset('/bower_components/admin-lte//plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/timepicker/bootstrap-timepicker.min.css')}}">

    <link rel="stylesheet" href="{{ asset('css/w3schools.css')}}">

    <link href="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
       <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/dist/css/skins/_all-skins.min.css')}}">
       <!-- Pace style -->
       <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/pace/pace.min.css')}}">
       <!-- bootstrap wysihtml5 - text editor -->
       <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
       <!-- iCheck for checkboxes and radio inputs -->
       <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/iCheck/all.css')}}">
       <!-- Bootstrap 3.3.6 -->
       <link href="{{ asset('/bower_components/admin-lte/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
       <!-- fullCalendar 2.2.5-->
       <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/fullcalendar/fullcalendar.min.css')}}">
       <!-- bootstrap datepicker -->
       <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/datepicker/datepicker3.css')}}">
       <!-- iCheck for checkboxes and radio inputs -->
       <link rel="stylesheet" href="{{ asset('css/spinner.css')}}">
       <!-- DataTables -->
       <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
       <!-- jvectormap -->
       <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">

       <link href="{{ asset('/bower_components/admin-lte/plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css" />
       <!-- DropZone -->
       <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

       <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css"> <!-- LightBox -->
       <link rel="stylesheet" href="{{ asset('css/lightbox.css')}}">
       
       <link rel="stylesheet" href="{{ asset('css/dataTables.alphabetSearch.css')}}">
       @if(config('adminlte.plugins.select2'))
       <!-- Select2 -->
       <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css">
       @endif

       <!-- Theme style -->
       <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">

       @if(config('adminlte.plugins.datatables'))
       <!-- DataTables with bootstrap 3 style -->
       <link rel="stylesheet" href="//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.css">
       @endif

       <style type="text/css">
       
       #gallery-images img{
        width: 240px;
        height: 160px;
        border: 2px solid black;
        margin-bottom: 10px;
       }

       #gallery-images ul{
        margin: 0;
        padding: 0;
       }


       #gallery-images li{
        margin: 0;
        padding: 0;
        list-style: none;
        float: left;
        padding-left: 10px;
       }

       .gallery
       {
        display: inline-block;
        margin-top: 20px;
    }
    .close-icon{
        border-radius: 50%;
        position: absolute;
        right: 5px;
        top: -10px;
        padding: 5px 8px;
    }
    .form-image-upload{
        background: #e8e8e8 none repeat scroll 0 0;
        padding: 15px;
    }
</style>
@yield('adminlte_css')

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="@yield('body_class')">

    @yield('body')

   
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.slimscroll.min.js') }}"></script>

    @if(config('adminlte.plugins.select2'))
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    @endif


    @if(config('adminlte.plugins.chartjs'))
    <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js"></script>
    @endif

    @yield('adminlte_js')

</body>
</html>
