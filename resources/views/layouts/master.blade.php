<!DOCTYPE html>
<!--
Template Name: NobleUI - Laravel Admin Dashboard Template
Author: NobleUI
Website: https://www.nobleui.com
Contact: nobleui123@gmail.com
License: You must have a valid license purchased only from https://themeforest.net/user/nobleui/portfolio/ in order to legally use the theme for your project.
-->
<html>
<head>
  <title>Sahabat Multi Teknik</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">
  
  <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

  <!-- plugin css -->
  <link href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />
  <!-- end plugin css -->

{{-- // sweetalert --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>


    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href={{ asset('app-assets/vendors/css/vendors.min.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('app-assets/vendors/css/charts/apexcharts.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('app-assets/vendors/css/extensions/toastr.min.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('app-assets/vendors/css/vendors.min.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('app-assets/vendors/css/pickers/pickadate/pickadate.css') }}>
    <link rel="stylesheet" type="text/css"
        href={{ asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}>
    <!-- END: Vendor CSS-->

    {{-- BEGIN: Vendor DataTables --}}
    <link rel="stylesheet" type="text/css"
        href={{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}>
    <link rel="stylesheet" type="text/css"
        href={{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}>
    <link rel="stylesheet" type="text/css"
        href={{ asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}>
    {{-- END: Vendor DataTables --}}

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href={{ asset('app-assets/css/bootstrap.min.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('app-assets/css/bootstrap-extended.min.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('app-assets/css/colors.min.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('app-assets/css/components.min.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('app-assets/css/themes/dark-layout.min.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('app-assets/css/themes/bordered-layout.min.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('app-assets/css/themes/semi-dark-layout.min.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}>

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href={{ asset('app-assets/css/core/menu/menu-types/vertical-menu.min.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('app-assets/css/pages/dashboard-ecommerce.min.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('app-assets/css/plugins/charts/chart-apex.min.css') }}>
    <link rel="stylesheet" type="text/css"
        href={{ asset('app-assets/css/plugins/extensions/ext-component-toastr.min.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('app-assets/css/plugins/forms/form-validation.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('app-assets/css/pages/app-user.min.css') }}>
    <link rel="stylesheet" type="text/css"
        href={{ asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.min.css') }}>
    <link rel="stylesheet" type="text/css"
        href={{ asset('app-assets/css/plugins/forms/pickers/form-pickadate.min.css') }}>
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href={{ asset('assets/css/style.css') }}>


    <!-- END: Custom CSS-->




  @stack('plugin-styles')

  <!-- common css -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
  <!-- end common css -->

  @stack('style')
</head>
<body data-base-url="{{url('/')}}">

  <script src="{{ asset('assets/js/spinner.js') }}"></script>

  <div class="main-wrapper" id="app">
    @include('layouts.sidebar')
    <div class="page-wrapper">
      @include('layouts.header')
      <div class="page-content">
        @yield('content')
      </div>
      @include('layouts.footer')
    </div>
  </div>

    <!-- base js -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/plugins/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <!-- end base js -->


    <!-- plugin js -->
    @stack('plugin-scripts')
    <!-- end plugin js -->

    <!-- common js -->
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <!-- end common js -->

    





                <!-- BEGIN: Vendor JS-->
                <script src={{ asset('app-assets/vendors/js/vendors.min.js') }}></script>
                <!-- BEGIN Vendor JS-->


                <!-- BEGIN: Page Vendor JS-->
                <script src={{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}></script>
                <script src={{ asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}></script>
                <script src={{ asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}></script>
                <script src={{ asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js') }}></script>
                <script src={{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}></script>
                <script src={{ asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}></script>
                <script src={{ asset('app-assets/vendors/js/charts/apexcharts.min.js') }}></script>
                <script src={{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}></script>

                <script src={{ asset('app-assets/vendors/js/pickers/pickadate/picker.js') }}></script>
                <script src={{ asset('app-assets/vendors/js/pickers/pickadate/picker.date.js') }}></script>
                <script src={{ asset('app-assets/vendors/js/pickers/pickadate/picker.time.js') }}></script>
                <script src={{ asset('app-assets/vendors/js/pickers/pickadate/legacy.js') }}></script>
                <script src={{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}></script>

                <script src={{ asset('app-assets/vendors/js/charts/apexcharts.min.js') }}></script>

                <!-- END: Page Vendor JS-->

                <!-- BEGIN: Theme JS-->
                <script src={{ asset('app-assets/js/core/app-menu.min.js') }}></script>
                <script src={{ asset('app-assets/js/core/app.min.js') }}></script>
                <script src={{ asset('app-assets/js/scripts/customizer.min.js') }}></script>
                <!-- END: Theme JS-->


                <!-- BEGIN: Page JS-->

                <script src={{ asset('app-assets/js/scripts/cards/card-analytics.min.js') }}></script>
                <script src={{ asset('app-assets/js/scripts/forms/form-select2.min.js') }}></script>
                <script src={{ asset('app-assets/js/scripts/pages/dashboard-ecommerce.min.js') }}></script>
                <script src={{ asset('app-assets/js/scripts/pages/app-user-list.min.js') }}></script>
                <script src={{ asset('app-assets/js/scripts/tables/table-datatables-advanced.min.js') }}></script>
                <script src={{ asset('app-assets/js/scripts/forms/pickers/form-pickers.min.js') }}></script>




    @stack('custom-scripts')
</body>
</html>