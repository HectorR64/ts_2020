<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon"  href=" {{asset('/')}}web/iconos/taco.ico">
  @yield('title')

  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
 <link href="{{ asset('admin/assets/css/material-dashboard.min.css?v=2.1.0')}}" rel="stylesheet" />





 <!--Switchery [ OPTIONAL ]-->
 <link href="{{ asset('admin/plugins/switchery/switchery.min.css')}}" rel="stylesheet">

 <!--Select2 [ OPTIONAL ]-->
 <link href="{{ asset('admin/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

 <!--Chosen [ OPTIONAL ]-->
 {{-- <link href="{{ asset('plugins/chosen/chosen.min.css')}}" rel="stylesheet"> --}}

 <!--Bootstrap Tags Input [ OPTIONAL ]-->
 <link href="{{ asset('admin/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.css') }}" rel="stylesheet">


 <!--Custom Stylesheet [ REQUIRED ]-->
 <link href="{{ asset('admin/css/custom.css')}}" rel="stylesheet">


</head>

<body class="sidebar-mini">
    <div class="wrapper ">
        @include('admin.includes.sidebar')
      <div class="main-panel">
        @include('admin.includes.navbar')
        <!-- End Navbar -->
          <div class="content">
          <div class="content">
            <div class="container-fluid">
              <div class="row">

                <div class="col-md-12">

                      @yield('content')



                  </div>
              </div>
          </div>



      </div>

          @yield('script')

      </div>
    </div>




       <script src="{{asset('admin/js/jquery.min.js')}}"></script>
       <script src="{{asset('admin/assets/js/core/popper.min.js')}}"></script>
       <script src="{{asset('admin/assets/js/core/bootstrap-material-design.min.js')}}"></script>
       <script src="{{asset('admin/assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>

       <script src="{{asset('admin/assets/js/material-dashboard.min.js?v=2.1.0')}}"></script>
       <!-- Material Dashboard DEMO methods, don't include it in your project! -->


       <script src="{{ asset('admin/assets/js/plugins/jasny-bootstrap.min.js')}}"></script>

         <!--BootstrapJS [ RECOMMENDED ]-->
         <script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>

         <!--active-shop [ RECOMMENDED ]-->
         <script src="{{ asset('admin/js/active-shop.min.js') }}"></script>

         <!--Alerts [ SAMPLE ]-->
         <script src="{{ asset('admin/js/demo/ui-alerts.js') }}"></script>

         <!--Switchery [ OPTIONAL ]-->
         <script src="{{ asset('admin/plugins/switchery/switchery.min.js')}}"></script>

         <!--DataTables [ OPTIONAL ]-->
         <script src="{{ asset('admin/plugins/datatables/media/js/jquery.dataTables.js')}}"></script>
         <script src="{{ asset('admin/plugins/datatables/media/js/dataTables.bootstrap.js')}}"></script>
         <script src="{{ asset('admin/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>

         <!--DataTables Sample [ SAMPLE ]-->
         <script src="{{ asset('admin/js/demo/tables-datatables.js')}}"></script>

         <!--Select2 [ OPTIONAL ]-->
         <script src="{{ asset('admin/plugins/select2/js/select2.min.js')}}"></script>

         <!--Summernote [ OPTIONAL ]-->
         <script src="{{ asset('admin/js/jodit.min.js') }}"></script>

         <!--Bootstrap Tags Input [ OPTIONAL ]-->
         <script src="{{ asset('admin/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>

         <!--Bootstrap Validator [ OPTIONAL ]-->
         <script src="{{ asset('admin/plugins/bootstrap-validator/bootstrapValidator.min.js') }}"></script>

         <!--Bootstrap Wizard [ OPTIONAL ]-->
         <script src="{{ asset('admin/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>

         <!--Bootstrap Datepicker [ OPTIONAL ]-->
         <script src="{{ asset('admin/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

         <!--Form Component [ SAMPLE ]-->
      <!--Custom JavaScript [ REQUIRED ]-->
         <script src="{{ asset('admin/js/custom.js')}}"></script>
         <script src="{{asset('admin/js/demo/form-wizard.js')}}"></script>

         <!--Spectrum JavaScript [ REQUIRED ]-->
         <script src="{{ asset('admin/js/spectrum.js')}}"></script>

         <!--Spartan Image JavaScript [ REQUIRED ]-->
         <script src="{{ asset('admin/js/spartan-multi-image-picker-min.js') }}"></script>


         <script src="{{asset('admin/js/sale.js')}}"></script>
</body>

</html>
