<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="author" content="Digit94Team">
		<!-- CSRF Token -->
		<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
		<link rel="icon" type="image/png" href="<?php echo e(asset('img/favicon.png')); ?>">
		<title>Doctorino - <?php echo $__env->yieldContent('title'); ?> </title>
		<!-- Custom fonts for this template-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link
			href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
			rel="stylesheet" media="all">
		<!-- Custom styles for this template-->
		<link href="<?php echo e(asset('dashboard/css/sb-admin-2.min.css')); ?>" rel="stylesheet" media="all">
		<link href="<?php echo e(asset('dashboard/css/gijgo.min.css')); ?>" rel="stylesheet" media="all">
		<script>
			"use strict";
			const SITE_URL = "<?php echo e(url('/')); ?>";
		</script>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
		<!-- Custom styles for this template-->
		<?php echo $__env->yieldContent('header'); ?>
	</head>
	<body id="page-top">
		<div id="app">
			<!-- Page Wrapper -->
			<div id="wrapper">
				<!-- Sidebar -->
				<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
					<!-- Sidebar - Brand -->
					<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo e(route('home')); ?>">
						<div class="sidebar-brand-icon rotate-n-15 d-none d-lg-block d-xl-none">
							<i class="fas fa-user-md"></i>
						</div>
						<div class="sidebar-brand-text mx-3"><img src="<?php echo e(asset('img/logo.svg')); ?>" class="img-fluid"></div>
					</a>
					<!-- Divider -->
					<hr class="sidebar-divider my-0">
					<!-- Nav Item - Dashboard -->
					<li class="nav-item active">
						<a class="nav-link" href="<?php echo e(route('home')); ?>">
						<i class="fas fa-fw fa-home"></i>
						<span><?php echo e(__('Dashboard')); ?></span></a>
					</li>
					<?php if(Auth::user()->can('add patient') || Auth::user()->can('view all patients')): ?>
					
					<li class="nav-item">
						<a class="nav-link collapsed" href="#" data-toggle="collapse"
							data-target="#collapsePatient" aria-expanded="true" aria-controls="collapseTwo">
						<i class="fas fa-fw fa-user-injured"></i>
						<span><?php echo e(__('Patients')); ?></span>
						</a>
						<div id="collapsePatient" class="collapse" aria-labelledby="headingTwo"
							data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner">
								<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add patient')): ?>
								<a class="collapse-item"
									href="<?php echo e(route('patient.create')); ?>"><?php echo e(__('New Patient')); ?></a>
								<?php endif; ?>
								<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view all patients')): ?>
								<a class="collapse-item"
									href="<?php echo e(route('patient.all')); ?>"><?php echo e(__('All Patients')); ?></a>
								<?php endif; ?>
							</div>
						</div>
					</li>
					<?php endif; ?>
					<?php if(Auth::user()->can('create appointment') ||
					Auth::user()->can('view all appointments') ||
					Auth::user()->can('delete appointment')): ?>
					
					<li class="nav-item">
						<a class="nav-link collapsed" href="#" data-toggle="collapse"
							data-target="#collapseAppointment" aria-expanded="true" aria-controls="collapseAppointment">
						<i class="far fa-fw fa-calendar-plus"></i>
						<span><?php echo e(__('Appointments')); ?></span>
						</a>
						<div id="collapseAppointment" class="collapse" aria-labelledby="headingTwo"
							data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner">
								<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create appointment')): ?>
								<a class="collapse-item"
									href="<?php echo e(route('appointment.create')); ?>"><?php echo e(__('New Appointment')); ?></a>
								<?php endif; ?>
								<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view all appointments')): ?>
								<a class="collapse-item" href="<?php echo e(route('appointment.upcoming')); ?>"><?php echo e(__('Upcoming Appointments')); ?></a>
								<a class="collapse-item" href="<?php echo e(route('appointment.today')); ?>"><?php echo e(__('Today\'s Appointments')); ?></a>
								<a class="collapse-item" href="<?php echo e(route('appointment.all')); ?>"><?php echo e(__('All Appointments')); ?></a>
								<?php endif; ?>
							</div>
						</div>
					</li>
					<?php endif; ?>
					<?php if(Auth::user()->can('create prescription') ||
					Auth::user()->can('view all prescriptions') ||
					Auth::user()->can('view prescription') ||
					Auth::user()->can('view prescription')): ?>
					
					<li class="nav-item">
						<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
							aria-expanded="true" aria-controls="collapseTwo">
						<i class="fas fa-fw fa-prescription"></i>
						<span><?php echo e(__('Prescriptions')); ?></span>
						</a>
						<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
							data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner">
								<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create prescription')): ?>
								<a class="collapse-item"
									href="<?php echo e(route('prescription.create')); ?>"><?php echo e(__('Create New')); ?></a>
								<?php endif; ?>
								<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view all prescriptions')): ?>
								<a class="collapse-item"
									href="<?php echo e(route('prescription.all')); ?>"><?php echo e(__('All Prescriptions')); ?></a>
								<?php endif; ?>
							</div>
						</div>
					</li>
					<?php endif; ?>
					<?php if(Auth::user()->can('create drug') ||
					Auth::user()->can('view all drugs') ||
					Auth::user()->can('view drug') ||
					Auth::user()->can('edit drug')): ?>
					
					<li class="nav-item">
						<a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages"
							aria-expanded="true" aria-controls="collapsePages">
						<i class="fas fa-fw fa-pills"></i>
						<span><?php echo e(__('Drugs')); ?></span>
						</a>
						<div id="collapsePages" class="collapse" aria-labelledby="headingPages"
							data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner">
								<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view all drugs')): ?>
								<a class="collapse-item" href="<?php echo e(route('drug.all')); ?>"><?php echo e(__('All Drugs')); ?></a>
								<?php endif; ?>
								<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create drug')): ?>
								<a class="collapse-item" href="<?php echo e(route('drug.create')); ?>"><?php echo e(__('Add New')); ?></a>
								<a class="collapse-item" href="<?php echo e(route('drug.bulk_upload')); ?>"><?php echo e(__('Bulk Import Drugs')); ?></a>
								<?php endif; ?>
							</div>
						</div>
					</li>
					<?php endif; ?>
					<?php if(Auth::user()->can('create diagnostic test') ||
					Auth::user()->can('edit diagnostic test') ||
					Auth::user()->can('view all diagnostic tests')): ?>
					
					<li class="nav-item">
						<a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTests"
							aria-expanded="true" aria-controls="collapseTests">
						<i class="fas fa-fw fa-heartbeat"></i>
						<span><?php echo e(__('Diagnostic Tests')); ?></span>
						</a>
						<div id="collapseTests" class="collapse" aria-labelledby="headingPages"
							data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner">
								<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create diagnostic test')): ?>
								<a class="collapse-item"
									href="<?php echo e(route('test.create')); ?>"><?php echo e(__('Add Test')); ?></a>
								<?php endif; ?>
								<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view all diagnostic tests')): ?>
								<a class="collapse-item"
									href="<?php echo e(route('test.all')); ?>"><?php echo e(__('All Tests')); ?></a>
								<?php endif; ?>
							</div>
						</div>
					</li>
					<?php endif; ?>
					<?php if(Auth::user()->can('create invoice') ||
					Auth::user()->can('edit invoice') ||
					Auth::user()->can('view invoice') ||
					Auth::user()->can('view all invoices')): ?>
					<li class="nav-item">
						<a class="nav-link collapsed" href="#" data-toggle="collapse"
							data-target="#collapseBilling" aria-expanded="true" aria-controls="collapseBilling">
						<i class="fas fa-fw fa-hand-holding-usd"></i>
						<span><?php echo e(__('Financial Activities')); ?></span>
						</a>
						<div id="collapseBilling" class="collapse" aria-labelledby="headingUtilities"
							data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner">
								<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create invoice')): ?>
								<a class="collapse-item"
									href="<?php echo e(route('billing.create')); ?>"><?php echo e(__('Create Invoice')); ?></a>
								<?php endif; ?>
								<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view all invoices')): ?>
								<a class="collapse-item"
									href="<?php echo e(route('billing.all')); ?>"><?php echo e(__('All Invoices')); ?></a>
								<?php endif; ?>
								<div class="dropdown-divider"></div>
								<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create invoice')): ?>
								<a class="collapse-item"
									href="<?php echo e(route('expense.create')); ?>"><?php echo e(__('Create Expense')); ?></a>
								<?php endif; ?>
								<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view all invoices')): ?>
								<a class="collapse-item"
									href="<?php echo e(route('expense.all')); ?>"><?php echo e(__('All Expenses')); ?></a>
								<?php endif; ?>

							</div>
						</div>
					</li>
					<?php endif; ?>
					<?php if(Auth::user()->can('manage waiting room')): ?>
					<!-- Nav Item - Utilities Collapse Menu -->
					<li class="nav-item">
						<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseWR" aria-expanded="true" aria-controls="collapseWR">
						<i class="fas fa-fw fa-user-clock"></i>
						<span><?php echo e(__('Waiting Room')); ?></span>
						</a>
						<div id="collapseWR" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner">
								<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create invoice')): ?>
								<a class="collapse-item" href="<?php echo e(route('wr.view')); ?>"><?php echo e(__('View Waiting room')); ?></a>
								<?php endif; ?>
								<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view all invoices')): ?>
								<a class="collapse-item" href="<?php echo e(route('wr.archive.all')); ?>"><?php echo e(__('Archive')); ?></a>
								<?php endif; ?>
							</div>
						</div>
					</li>
					<?php endif; ?>

					<?php if(Auth::user()->can('create notification') ||
					Auth::user()->can('edit notification') ||
					Auth::user()->can('view notification') ||
					Auth::user()->can('view all notifications')): ?>
					<li class="nav-item">
						<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNotifications" aria-expanded="true" aria-controls="collapseNotifications">
						<i class="fas fa-fw fa-bell"></i>
						<span><?php echo e(__('Notifications')); ?></span>
						</a>
						<div id="collapseNotifications" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner">
								<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create notification')): ?>
								<a class="collapse-item"
									href="<?php echo e(route('notification.create')); ?>"><?php echo e(__('Create New')); ?></a>
								<?php endif; ?>
								<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view all notifications')): ?>
								<a class="collapse-item" href="<?php echo e(route('notification.all')); ?>"><?php echo e(__('Notifications')); ?></a>
								<?php endif; ?>
							</div>
						</div>
					</li>
					<?php endif; ?>

					<?php if(Auth::user()->can('manage roles')): ?>
					
					<li class="nav-item">
						<a class="nav-link collapsed" href="#" data-toggle="collapse"
							data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
						<i class="fas fa-fw fa-users"></i>
						<span><?php echo e(__('Staffs')); ?></span>
						</a>
						<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
							data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner">
								<a class="collapse-item"
									href="<?php echo e(route('user.create')); ?>"><?php echo e(__('Create New Account')); ?></a>
								<a class="collapse-item"
									href="<?php echo e(route('user.all')); ?>"><?php echo e(__('All Staffs')); ?></a>
								<a class="collapse-item"
									href="<?php echo e(route('roles.all')); ?>"><?php echo e(__('Roles & Permissions')); ?></a>
							</div>
						</div>
					</li>
					<?php endif; ?>
					<?php if(Auth::user()->can('manage settings')): ?>
					
					<li class="nav-item">
						<a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseSettings"
							aria-expanded="true" aria-controls="collapseSettings">
						<i class="fas fa-fw fa-cogs"></i>
						<span><?php echo e(__('Settings')); ?></span>
						</a>
						<div id="collapseSettings" class="collapse" aria-labelledby="headingPages"
							data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner">
									
									<a class="collapse-item"
									href="<?php echo e(route('doctorino_settings')); ?>"><?php echo e(__('General Settings')); ?></a>
									<a class="collapse-item"
									href="<?php echo e(route('prescription_settings')); ?>"><?php echo e(__('Prescription Settings')); ?></a>
									<a class="collapse-item"
									href="<?php echo e(route('appointment_settings')); ?>"><?php echo e(__('Appointment Settings')); ?></a>
								<a class="collapse-item"
									href="<?php echo e(route('payment_settings')); ?>"><?php echo e(__('Payment Settings')); ?></a>
								<a class="collapse-item"
									href="<?php echo e(route('notifications_settings')); ?>"><?php echo e(__('Notifications Settings')); ?></a>
									<a class="collapse-item"
									href="<?php echo e(route('activation')); ?>"><?php echo e(__('License')); ?></a>
								
							</div>
						</div>
					</li>
					<?php endif; ?>
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
								<?php echo e(__('Create as new')); ?> </button>
								<div class="dropdown-menu shadow">
									<?php if(Auth::user()->can('create prescription')): ?>
									<a class="dropdown-item"
										href="<?php echo e(route('prescription.create')); ?>"><?php echo e(__('Prescription')); ?></a>
									<?php endif; ?>
									<?php if(Auth::user()->can('add patient')): ?>
									<a class="dropdown-item"
										href="<?php echo e(route('patient.create')); ?>"><?php echo e(__('Patient')); ?></a>
									<?php endif; ?>
									<?php if(Auth::user()->can('create appointment')): ?>
									<a class="dropdown-item"
										href="<?php echo e(route('appointment.create')); ?>"><?php echo e(__('Appointment')); ?></a>
									<?php endif; ?>
									<?php if(Auth::user()->can('create invoice')): ?>
									<a class="dropdown-item"
										href="<?php echo e(route('billing.create')); ?>"><?php echo e(__('Invoice')); ?></a>
									<?php endif; ?>
									<?php if(Auth::user()->can('create expense')): ?>
									<a class="dropdown-item"
										href="<?php echo e(route('expense.create')); ?>"><?php echo e(__('Expense')); ?></a>
									<?php endif; ?>
									<?php if(Auth::user()->can('create drug')): ?>
									<a class="dropdown-item"
										href="<?php echo e(route('drug.create')); ?>"><?php echo e(__('Drug')); ?></a>
									<?php endif; ?>
									<?php if(Auth::user()->can('create diagnostic test')): ?>
									<a class="dropdown-item"
										href="<?php echo e(route('test.create')); ?>"><?php echo e(__('Diagnosis Test')); ?></a>
									<?php endif; ?>
								</div>
							</div>
							<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view all patients')): ?>
							<form
								class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
								action="<?php echo e(route('patient.search')); ?>" method="post">
								<div class="input-group">
									<input type="text" class="form-control bg-light border-0 small"
										placeholder="<?php echo e(__('Search for')); ?>..." aria-label="Search" aria-describedby="basic-addon2"
										name="term">
									<?php echo csrf_field(); ?>
									<div class="input-group-append">
										<button class="btn btn-primary" type="submit">
										<i class="fas fa-search fa-sm"></i>
										</button>
									</div>
								</div>
							</form>
							<?php endif; ?>
							<!-- Topbar Navbar -->
							<ul class="navbar-nav ml-auto">
								<!-- Nav Item - User Information -->
								<li class="nav-item dropdown no-arrow">
									<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
										data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span
										class="mr-2 d-none d-lg-inline text-gray-900 small-600"><?php echo e(Auth::user()->name); ?></span>
									<img class="img-profile rounded-circle" src="<?php echo e(asset('img/favicon.png')); ?>">
									</a>
									<!-- Dropdown - User Information -->
									<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
										aria-labelledby="userDropdown">
										<a class="dropdown-item" href="<?php echo e(route('user.edit_profile')); ?>">
										<i class="fas fa-pen fa-sm fa-fw mr-2 text-gray-400"></i>
										<?php echo e(__('Update Account')); ?>

										</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#" data-toggle="modal"
											data-target="#logoutModal">
										<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
										<?php echo e(__('Logout')); ?>

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
									<?php if($errors->any()): ?>
									<div class="alert alert-danger">
										<ul>
											<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<li><?php echo e($error); ?></li>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</ul>
									</div>
									<?php endif; ?>
								</div>
							</div>

							
							<?php echo $__env->yieldContent('content'); ?>
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
								Digit94Team</a> <?php echo e(date('Y')); ?></span>
								<span style="float: right;">Version <?php echo e(get_option('current_version')); ?></span>
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
		<?php echo $__env->make('layouts.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<script src="<?php echo e(asset('dashboard/js/vue.js')); ?>"></script>
		<script src="<?php echo e(asset('dashboard/vendor/jquery/jquery.min.js')); ?>"></script>
		<!-- Bootstrap core JavaScript-->
		<script src="<?php echo e(asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
		<script src="<?php echo e(asset('dashboard/js/gijgo.min.js')); ?>" type="text/javascript"></script>
		<script src="<?php echo e(asset('dashboard/js/jquery.repeatable.js')); ?>" type="text/javascript"></script>
		<script src="<?php echo e(asset('dashboard/js/bootstrap-notify.min.js')); ?>"></script>
		<script src="<?php echo e(asset('https://jasonday.github.io/printThis/printThis.js')); ?>"></script>
		<script src="<?php echo e(asset('dashboard/js/custom.js')); ?>"></script>
		<?php if(session('success')): ?>
		<script type="text/javascript">
			$.notify({
			    message: "<?php echo session('success'); ?>"
			}, {
			    type: "success",
			    delay: 5000,
			});
		</script>
		<?php endif; ?>
		<?php if(session('danger')): ?>
		<script type="text/javascript">
			$.notify({
			    message: "<?php echo session('danger'); ?>"
			}, {
			    type: "danger",
			    delay: 5000,
			});
		</script>
		<?php endif; ?>
		<?php if(session('warning')): ?>
		<script type="text/javascript">
			$.notify({
			    message: "<?php echo session('warning'); ?>"
			}, {
			    type: "warning",
			    delay: 5000,
			});
		</script>
		<?php endif; ?>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
		<script>
			$(document).ready(function () {
			    $('select').selectpicker();
			});
		</script>
		<?php echo $__env->yieldContent('footer'); ?>
	</body>
</html><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/doctorino/v5.2.0/resources/views/layouts/staff_layout.blade.php ENDPATH**/ ?>