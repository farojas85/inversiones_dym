<!DOCTYPE html>
<html lang="es">
<!-- BEGIN HEAD -->
    @include('layouts.home.header')
<!-- END HEAD -->
<body >
	<!-- Begin page -->
	<div id="wrapper">

		@include('layouts.home.navbar')
		@include('layouts.home.sidebar')

		<div class="content-page">
			<div class="content">
			<!-- Start Content-->
			<div class="container-fluid">      
				@yield('page-content')
			</div>
			<div class="modal fade" id="modal-default" tabindex="-1" role="dialog" 
				aria-labelledby="modalDefaultLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="modal-default-title">Modal title</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body" id="modal-default-body">
							<p class="mb-0">Modal body text goes here.</p>
						</div>
						<div class="modal-footer">
						</div>
					</div>
				</div>
			</div>
			<!-- Large Modal -->
			<div id="modal-large" class="modal fade">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content ">
						<div class="modal-header pd-x-20">
							<h6 class="modal-title" id="modal-large-title">Message Preview</h6>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body pd-20" id="modal-large-body">
						</div>
						<div class="modal-footer">
						</div>
					</div>
				</div>
			</div>
			<!-- Footer Start -->
			<footer class="footer">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-6">
							2015 - 2018 &copy; UBold theme by <a href="">Coderthemes</a> 
						</div>
						<div class="col-md-6">
							<div class="text-md-right footer-links d-none d-sm-block">
								<a href="javascript:void(0);">About Us</a>
								<a href="javascript:void(0);">Help</a>
								<a href="javascript:void(0);">Contact Us</a>
							</div>
						</div>
					</div>
				</div>
			</footer>
			<!-- end Footer -->
		</div>
	</div>   

	@include('layouts.home.rightbar')
	<!-- Right bar overlay-->
	<div class="rightbar-overlay"></div>

    @include('layouts.home.script')

    @yield('scripties')
</body>
</html>