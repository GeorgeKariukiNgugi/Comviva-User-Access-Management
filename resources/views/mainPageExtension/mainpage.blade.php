<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Comviva Access Management</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{asset('interface\bower_components\bootstrap\dist\css\bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('interface\bower_components\font-awesome\css\font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('interface\bower_components\Ionicons\css\ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('interface\dist\css\css.min.css')}}">
  
  <link rel="stylesheet" href="{{asset('interface\bower_components\datatables.net-bs\css\dataTables.bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('interface\dist\css\skins\skin-blue.min.css')}}"> 
  <link rel="stylesheet" href="{{asset('select2\dist\css\select2.min.css')}}">  
  <link rel="stylesheet" href="{{asset('interface\bower_components\select2\dist\css\select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('interface\bower_components\bootstrap-datepicker\dist\css\bootstrap-datepicker.min.css')}}">
  <link rel="stylesheet" href="{{asset('interface\bower_components\bootstrap-daterangepicker\daterangepicker.css')}}">
  

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        <style>
          input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
        </style>
        
</head>

<body class="hold-transition  skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->      
      <!-- logo for regular state and mobile devices -->
      <span class="logo-mini"><b>C</b>AM</span>      
      <span class="logo-lg"><b>User Access .</span>
    </a>



    {{--! THIS SECTION WILL BE USED TO ADD THE NAVIGATION OF THE APPLIATION. --}}

        @yield('navigation')
                    

  </header>
  <!-- Left side column. contains the logo and sidebar -->
        @yield('aside')                    

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
        @yield('mainContentHeader')                    
      
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        @yield('mainContentData')                    
        
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
        @yield('footer')                    

  
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{{asset('interface\bower_components\jquery\dist\jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('interface\bower_components\bootstrap\dist\js\bootstrap.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('interface\dist\js\js.min.js')}}"></script>
<script src="{{asset('interface\bower_components\select2\dist\js\select2.full.min.js')}}"></script>
<script src="{{asset('js\searchCreteria.js')}}"></script>
<script src="{{asset('js\closingModal.js')}}"></script>
<script src="{{asset('js\checkingOutUserModal.js')}}"></script>
<script src="{{asset('interface\bower_components\datatables.net\js\jquery.dataTables.min.js')}}"></script>
<script src="{{asset('interface\bower_components\datatables.net-bs\js\dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('interface\dist\js\js.min.js')}}"></script>
<script src="{{asset('interface\bower_components\bootstrap-datepicker\dist\js\bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('interface\bower_components\moment\min\moment.min.js')}}"></script>
<script src="{{asset('interface\bower_components\bootstrap-daterangepicker\daterangepicker.js')}}"></script>
<script>
$(function () {
    //Initialize Select2 Elements
    $('.datepicker').datepicker({
      autoclose: true
    })
    $('#reservation').daterangepicker()
    $('.select2').select2()
    })   
    $('.example1').DataTable();
    $('#example1').DataTable();
    $('#example2').DataTable();
    $('#example3').DataTable();
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    }) 
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

@yield('charts')
@include('sweetalert::alert')
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>