<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="author" content="Digit94Team">
		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
		<title>Doctorino - @yield('title') </title>
		<!-- Custom fonts for this template-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link
			href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
			rel="stylesheet" media="all">
		<!-- Custom styles for this template-->
		<link href="{{ asset('dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet" media="all">
		<link href="{{ asset('dashboard/css/gijgo.min.css') }}" rel="stylesheet" media="all">
		<script>
			"use strict";
			const SITE_URL = "{{ url('/') }}";
		</script>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
		<!-- Custom styles for this template-->
		@yield('header')
	</head>
	<body id="page-top">
		<div id="app">
			<!-- Page Wrapper -->
			<div id="wrapper">
				<!-- Sidebar -->
				<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
					<!-- Sidebar - Brand -->
					<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
						<div class="sidebar-brand-icon rotate-n-15 d-none d-lg-block d-xl-none">
							<i class="fas fa-user-md"></i>
						</div>
						<div class="sidebar-brand-text mx-3"><img src="{{ asset('img/logo.svg') }}" class="img-fluid"></div>
					</a>
					<!-- Divider -->
					<hr class="sidebar-divider my-0">
					<!-- Nav Item - Dashboard -->
					<li class="nav-item active">
						<a class="nav-link" href="{{ route('home') }}">
						<i class="fas fa-fw fa-home"></i>
						<span>{{ __('Dashboard') }}</span></a>
					</li>
					@if (Auth::user()->can('add patient') || Auth::user()->can('view all patients'))
					
					<li class="nav-item">
						<a class="nav-link collapsed" href="#" data-toggle="collapse"
							data-target="#collapsePatient" aria-expanded="true" aria-controls="collapseTwo">
						<i class="fas fa-fw fa-user-injured"></i>
						<span>{{ __('Patients') }}</span>
						</a>
						<div id="collapsePatient" class="collapse" aria-labelledby="headingTwo"
							data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner">
								@can('add patient')
								<a class="collapse-item"
									href="{{ route('patient.create') }}">{{ __('New Patient') }}</a>
								@endcan
								@can('view all patients')
								<a class="collapse-item"
									href="{{ route('patient.all') }}">{{ __('All Patients') }}</a>
								@endcan
							</div>
						</div>
					</li>
					@endif
					@if (Auth::user()->can('create appointment') ||
					Auth::user()->can('view all appointments') ||
					Auth::user()->can('delete appointment'))
					
					<li class="nav-item">
						<a class="nav-link collapsed" href="#" data-toggle="collapse"
							data-target="#collapseAppointment" aria-expanded="true" aria-controls="collapseAppointment">
						<i class="far fa-fw fa-calendar-plus"></i>
						<span>{{ __('Appointments') }}</span>
						</a>
						<div id="collapseAppointment" class="collapse" aria-labelledby="headingTwo"
							data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner">
								@can('create appointment')
								<a class="collapse-item"
									href="{{ route('appointment.create') }}">{{ __('New Appointment') }}</a>
								@endcan
								@can('view all appointments')
								<a class="collapse-item" href="{{ route('appointment.upcoming') }}">{{ __('Upcoming Appointments') }}</a>
								<a class="collapse-item" href="{{ route('appointment.today') }}">{{ __('Today\'s Appointments') }}</a>
								<a class="collapse-item" href="{{ route('appointment.all') }}">{{ __('All Appointments') }}</a>
								@endcan
							</div>
						</div>
					</li>
					@endif
					@if (Auth::user()->can('create prescription') ||
					Auth::user()->can('view all prescriptions') ||
					Auth::user()->can('view prescription') ||
					Auth::user()->can('view prescription'))
					
					<li class="nav-item">
						<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
							aria-expanded="true" aria-controls="collapseTwo">
						<i class="fas fa-fw fa-prescription"></i>
						<span>{{ __('Prescriptions') }}</span>
						</a>
						<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
							data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner">
								@can('create prescription')
								<a class="collapse-item"
									href="{{ route('prescription.create') }}">{{ __('Create New') }}</a>
								@endcan
								@can('view all prescriptions')
								<a class="collapse-item"
									href="{{ route('prescription.all') }}">{{ __('All Prescriptions') }}</a>
								@endcan
							</div>
						</div>
					</li>
					@endif
					@if (Auth::user()->can('create drug') ||
					Auth::user()->can('view all drugs') ||
					Auth::user()->can('view drug') ||
					Auth::user()->can('edit drug'))
					
					<li class="nav-item">
						<a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages"
							aria-expanded="true" aria-controls="collapsePages">
						<i class="fas fa-fw fa-pills"></i>
						<span>{{ __('Drugs') }}</span>
						</a>
						<div id="collapsePages" class="collapse" aria-labelledby="headingPages"
							data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner">
								@can('view all drugs')
								<a class="collapse-item" href="{{ route('drug.all') }}">{{ __('All Drugs') }}</a>
								@endcan
								@can('create drug')
								<a class="collapse-item" href="{{ route('drug.create') }}">{{ __('Add New') }}</a>
								<a class="collapse-item" href="{{ route('drug.bulk_upload') }}">{{ __('Bulk Import Drugs') }}</a>
								@endcan
							</div>
						</div>
					</li>
					@endif
					@if (Auth::user()->can('create diagnostic test') ||
					Auth::user()->can('edit diagnostic test') ||
					Auth::user()->can('view all diagnostic tests'))
					
					<li class="nav-item">
						<a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTests"
							aria-expanded="true" aria-controls="collapseTests">
						<i class="fas fa-fw fa-heartbeat"></i>
						<span>{{ __('Diagnostic Tests') }}</span>
						</a>
						<div id="collapseTests" class="collapse" aria-labelledby="headingPages"
							data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner">
								@can('create diagnostic test')
								<a class="collapse-item"
									href="{{ route('test.create') }}">{{ __('Add Test') }}</a>
								@endcan
								@can('view all diagnostic tests')
								<a class="collapse-item"
									href="{{ route('test.all') }}">{{ __('All Tests') }}</a>
								@endcan
							</div>
						</div>
					</li>
					@endif
					@if (Auth::user()->can('create invoice') ||
					Auth::user()->can('edit invoice') ||
					Auth::user()->can('view invoice') ||
					Auth::user()->can('view all invoices'))
					<li class="nav-item">
						<a class="nav-link collapsed" href="#" data-toggle="collapse"
							data-target="#collapseBilling" aria-expanded="true" aria-controls="collapseBilling">
						<i class="fas fa-fw fa-hand-holding-usd"></i>
						<span>{{ __('Financial Activities') }}</span>
						</a>
						<div id="collapseBilling" class="collapse" aria-labelledby="headingUtilities"
							data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner">
								@can('create invoice')
								<a class="collapse-item"
									href="{{ route('billing.create') }}">{{ __('Create Invoice') }}</a>
								@endcan
								@can('view all invoices')
								<a class="collapse-item"
									href="{{ route('billing.all') }}">{{ __('All Invoices') }}</a>
								@endcan
								<div class="dropdown-divider"></div>
								@can('create invoice')
								<a class="collapse-item"
									href="{{ route('expense.create') }}">{{ __('Create Expense') }}</a>
								@endcan
								@can('view all invoices')
								<a class="collapse-item"
									href="{{ route('expense.all') }}">{{ __('All Expenses') }}</a>
								@endcan

							</div>
						</div>
					</li>
					@endif
					@if(Auth::user()->can('manage waiting room'))
					<!-- Nav Item - Utilities Collapse Menu -->
					<li class="nav-item">
						<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseWR" aria-expanded="true" aria-controls="collapseWR">
						<i class="fas fa-fw fa-user-clock"></i>
						<span>{{ __('Waiting Room') }}</span>
						</a>
						<div id="collapseWR" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner">
								@can('create invoice')
								<a class="collapse-item" href="{{ route('wr.view') }}">{{ __('View Waiting room') }}</a>
								@endcan
								@can('view all invoices')
								<a class="collapse-item" href="{{ route('wr.archive.all') }}">{{ __('Archive') }}</a>
								@endcan
							</div>
						</div>
					</li>
					@endif

					@if (Auth::user()->can('create notification') ||
					Auth::user()->can('edit notification') ||
					Auth::user()->can('view notification') ||
					Auth::user()->can('view all notifications'))
					<li class="nav-item">
						<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNotifications" aria-expanded="true" aria-controls="collapseNotifications">
						<i class="fas fa-fw fa-bell"></i>
						<span>{{ __('Notifications') }}</span>
						</a>
						<div id="collapseNotifications" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner">
								@can('create notification')
								<a class="collapse-item"
									href="{{ route('notification.create') }}">{{ __('Create New') }}</a>
								@endcan
								@can('view all notifications')
								<a class="collapse-item" href="{{ route('notification.all') }}">{{ __('Notifications') }}</a>
								@endcan
							</div>
						</div>
					</li>
					@endif

					@if (Auth::user()->can('manage roles'))
					
					<li class="nav-item">
						<a class="nav-link collapsed" href="#" data-toggle="collapse"
							data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
						<i class="fas fa-fw fa-users"></i>
						<span>{{ __('Staffs') }}</span>
						</a>
						<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
							data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner">
								<a class="collapse-item"
									href="{{ route('user.create') }}">{{ __('Create New Account') }}</a>
								<a class="collapse-item"
									href="{{ route('user.all') }}">{{ __('All Staffs') }}</a>
								<a class="collapse-item"
									href="{{ route('roles.all') }}">{{ __('Roles & Permissions') }}</a>
							</div>
						</div>
					</li>
					@endif
					@if (Auth::user()->can('manage settings'))
					
					<li class="nav-item">
						<a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseSettings"
							aria-expanded="true" aria-controls="collapseSettings">
						<i class="fas fa-fw fa-cogs"></i>
						<span>{{ __('Settings') }}</span>
						</a>
						<div id="collapseSettings" class="collapse" aria-labelledby="headingPages"
							data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner">
									
									<a class="collapse-item"
									href="{{ route('doctorino_settings') }}">{{ __('General Settings') }}</a>
									<a class="collapse-item"
									href="{{ route('prescription_settings') }}">{{ __('Prescription Settings') }}</a>
									<a class="collapse-item"
									href="{{ route('appointment_settings') }}">{{ __('Appointment Settings') }}</a>
								<a class="collapse-item"
									href="{{ route('payment_settings') }}">{{ __('Payment Settings') }}</a>
								<a class="collapse-item"
									href="{{ route('notifications_settings') }}">{{ __('Notifications Settings') }}</a>
									<a class="collapse-item"
									href="{{ route('activation') }}">{{ __('License') }}</a>
								
							</div>
						</div>
					</li>
					@endif
					<!-- Divider -->
					<hr class="sidebar-divider d-none d-md-block">
					<!-- Sidebar Toggler (Sidebar) -->
					<div class="text-center d-none d-md-inline">
						<button class="rounded-circle border-0" id="sidebarToggle"></button>
					</div>
					<div class="sidebar-card d-none d-lg-flex">
						<img class="sidebar-card-illustration mb-2" src="https://startbootstrap.github.io/startbootstrap-sb-admin-2/img/undraw_rocket.svg" alt="...">
						<p class="text-center mb-2"><strong>JOIN THE DISCORD COMMUNITY! 🥰</strong><br> Be up to date on new features, suggestions, tips and more!</p>
						<a class="btn btn-primary btn-sm" href="https://discord.gg/jUd5nXCa">Join now !</a>
					</div>
				</ul>
				<!-- End of Sidebar -->
				<!-- Content Wrapper -->
				<div id="content-wrapper" class="d-flex flex-column">
					<!-- Main Content -->
					<div id="content">
						<!-- Topbar -->
						<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
							<!-- Sidebar Toggle (Topbar) -->
							<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
							<i class="fa fa-bars"></i>
							</button>
							<div class="dropdown shortcut-menu mr-4">
								<button type="button" class="btn btn-doctorino brd-20 dropdown-toggle"
									data-toggle="dropdown" aria-expanded="false">
								{{ __('Create as new') }} </button>
								<div class="dropdown-menu shadow">
									@if (Auth::user()->can('create prescription'))
									<a class="dropdown-item"
										href="{{ route('prescription.create') }}">{{ __('Prescription') }}</a>
									@endif
									@if (Auth::user()->can('add patient'))
									<a class="dropdown-item"
										href="{{ route('patient.create') }}">{{ __('Patient') }}</a>
									@endif
									@if (Auth::user()->can('create appointment'))
									<a class="dropdown-item"
										href="{{ route('appointment.create') }}">{{ __('Appointment') }}</a>
									@endif
									@if (Auth::user()->can('create invoice'))
									<a class="dropdown-item"
										href="{{ route('billing.create') }}">{{ __('Invoice') }}</a>
									@endif
									@if (Auth::user()->can('create expense'))
									<a class="dropdown-item"
										href="{{ route('expense.create') }}">{{ __('Expense') }}</a>
									@endif
									@if (Auth::user()->can('create drug'))
									<a class="dropdown-item"
										href="{{ route('drug.create') }}">{{ __('Drug') }}</a>
									@endif
									@if (Auth::user()->can('create diagnostic test'))
									<a class="dropdown-item"
										href="{{ route('test.create') }}">{{ __('Diagnosis Test') }}</a>
									@endif
								</div>
							</div>
							@can('view all patients')
							<form
								class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
								action="{{ route('patient.search') }}" method="post">
								<div class="input-group">
									<input type="text" class="form-control bg-light border-0 small"
										placeholder="{{ __('Search for') }}..." aria-label="Search" aria-describedby="basic-addon2"
										name="term">
									@csrf
									<div class="input-group-append">
										<button class="btn btn-primary" type="submit">
										<i class="fas fa-search fa-sm"></i>
										</button>
									</div>
								</div>
							</form>
							@endcan
							<!-- Topbar Navbar -->
							<ul class="navbar-nav ml-auto">
								<!-- Nav Item - User Information -->
								<li class="nav-item dropdown no-arrow">
									<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
										data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span
										class="mr-2 d-none d-lg-inline text-gray-900 small-600">{{ Auth::user()->name }}</span>
									<img class="img-profile rounded-circle" src="{{ asset('img/favicon.png') }}">
									</a>
									<!-- Dropdown - User Information -->
									<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
										aria-labelledby="userDropdown">
										<a class="dropdown-item" href="{{ route('user.edit_profile') }}">
										<i class="fas fa-pen fa-sm fa-fw mr-2 text-gray-400"></i>
										{{ __('Update Account') }}
										</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#" data-toggle="modal"
											data-target="#logoutModal">
										<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
										{{ __('Logout') }}
										</a>
									</div>
								</li>
							</ul>
						</nav>
						<!-- End of Topbar -->
						<!-- Begin Page Content -->
						<div class="container-fluid">
							<div class="row">
								<div class="col">
									@if ($errors->any())
									<div class="alert alert-danger">
										<ul>
											@foreach ($errors->all() as $error)
											<li>{{ $error }}</li>
											@endforeach
										</ul>
									</div>
									@endif
								</div>
							</div>

							
							@yield('content')
							<!-- Page Heading -->
						</div>
						<!-- /.container-fluid -->
					</div>
					<!-- End of Main Content -->
					<!-- Footer -->
					<footer class="sticky-footer bg-white">
						<div class="container my-auto">
							<div class="copyright my-auto">
								<span>Copyright &copy; Created by <a href="https://getdoctorino.com" target="_blank">
								Digit94Team</a> {{ date('Y') }}</span>
								<span style="float: right;">Version {{ get_option('current_version') }}</span>
							</div>
						</div>
					</footer>
					<!-- End of Footer -->
				</div>
				<!-- End of Content Wrapper -->
			</div>
			<!-- End of Page Wrapper -->
		</div>
		<!-- Scroll to Top Button-->
		<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
		</a>
		@include('layouts.modals')
		<script src="{{ asset('dashboard/js/vue.js') }}"></script>
		<script src="{{ asset('dashboard/vendor/jquery/jquery.min.js') }}"></script>
		<!-- Bootstrap core JavaScript-->
		<script src="{{ asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
		<script src="{{ asset('dashboard/js/gijgo.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('dashboard/js/jquery.repeatable.js') }}" type="text/javascript"></script>
		<script src="{{ asset('dashboard/js/bootstrap-notify.min.js') }}"></script>
		<script src="{{ asset('https://jasonday.github.io/printThis/printThis.js') }}"></script>
		<script src="{{ asset('dashboard/js/custom.js') }}"></script>
		@if (session('success'))
		<script type="text/javascript">
			$.notify({
			    message: "<?php echo session('success'); ?>"
			}, {
			    type: "success",
			    delay: 5000,
			});
		</script>
		@endif
		@if (session('danger'))
		<script type="text/javascript">
			$.notify({
			    message: "<?php echo session('danger'); ?>"
			}, {
			    type: "danger",
			    delay: 5000,
			});
		</script>
		@endif
		@if (session('warning'))
		<script type="text/javascript">
			$.notify({
			    message: "<?php echo session('warning'); ?>"
			}, {
			    type: "warning",
			    delay: 5000,
			});
		</script>
		@endif
		<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
		<script>
			$(document).ready(function () {
			    $('select').selectpicker();
			});
		</script>
		@yield('footer')
	</body>
</html>