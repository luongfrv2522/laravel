<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('tittle','Website trực tuyến')</title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<base href="{{ asset('') }}">
	
	<link rel="icon" href="media/icons/icon-web.png">
	
	
	<!-- Bootstrap -->
	<link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- NProgress -->
	<link href="vendors/nprogress/nprogress.css" rel="stylesheet">
	<!-- iCheck -->
	<link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
	<!-- bootstrap-progressbar -->
	<link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">

	<!-- JQVMap -->
	<link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>

	<!-- bootstrap-daterangepicker -->
	<link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

	<!-- jQuery custom content scroller -->
	<link href="vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>
	
	<!-- Custom Theme Style -->
	<link rel="stylesheet" href="css/custom.min.css">
	<!-- My Global Style -->
	<link rel="stylesheet" href="css/global.css">
	<!-- ebd -->
	@yield('styles')
</head>
<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{route('root')}}" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            @include('Backend::shared.menu-quick-info')
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            @include('Backend::shared.menu')
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
			@include('Backend::shared.menu-footer-button')
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
		@include('Backend::shared.top-navigator')
        <!-- /top navigation -->

        <!-- page content -->
		<div class="right_col" role="main">
			<div class="">
				<div class="page-title">
	              <div class="title_left">
	                <h3>@yield('title-left', 'Title left')</h3>
	              </div>

	              <div class="title_right">
	                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
	                  {{-- <div class="input-group">
	                    <input type="text" class="form-control" placeholder="Tìm kiếm...">
	                    <span class="input-group-btn">
	                      <button class="btn btn-default" type="button">Tìm</button>
	                    </span>
	                  </div> --}}
	                </div>
	              </div>
	            </div>
	            <div class="clearfix"></div>
            	@yield('body')
			</div>
		</div>
		
        <!-- /page content -->

        <!-- footer content -->
		@include('Backend::shared.footer')
		<!-- /footer content -->
    </div>	
</div>

	<!-- scripts -->
	<!-- jQuery -->
	<script src="vendors/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- FastClick -->
	<script src="vendors/fastclick/lib/fastclick.js"></script>
	<!-- NProgress -->
	<script src="vendors/nprogress/nprogress.js"></script>
	<!-- jQuery custom content scroller -->
	<script src="vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>

	<!-- Custom Theme Scripts -->
	<script src="js/custom.min.js"></script>
	<!-- My Global Scripts -->
	<script src="js/global.js"></script>
	{{-- ebd --}}
	@yield('scripts')
  </body>
</html>