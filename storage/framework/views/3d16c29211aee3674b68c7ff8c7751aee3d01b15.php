<?php $__env->startSection('title'); ?>
<?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create prescription')): ?>
<div class="row">
	<div class="col">
		<div class="alert alert-warning"><?php echo e(__('Simplifies prescription and appointments, helping you to manage patients & you chamber in a smart way.')); ?> <br><b><a href="<?php echo e(route('appointment.create')); ?>">Create your first prescription</a></b> in less than 60 seconds.</div>
	</div>
</div>
<?php endif; ?>
<?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'Admin')): ?>
<div class="row">
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?php echo e(__('New Appointments')); ?></div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($total_appointments_today->count()); ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-calendar-check fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1"><?php echo e(__('Total Appointments')); ?></div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($total_appointments); ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-calendar fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Tasks Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-info shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-info text-uppercase mb-1"><?php echo e(__('New Patients')); ?></div>
						<div class="row no-gutters align-items-center">
							<div class="col-auto">
								<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo e($total_patients_today); ?></div>
							</div>
						</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-user-plus fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-warning shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><?php echo e(__('All Patients')); ?></div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($total_patients); ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-users fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?php echo e(__('Total Prescriptions')); ?></div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($total_prescriptions); ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-pills fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1"><?php echo e(__('Total Payments')); ?></div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($total_payments); ?></div>
					</div>
					<div class="col-auto">
						<i class="fa fa-wallet fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Tasks Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-secondary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-secondary text-uppercase mb-1"><?php echo e(__('Payments this month')); ?></div>
						<div class="row no-gutters align-items-center">
							<div class="col-auto">
								<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo e(formatCurrency($total_payments_month, get_option('currency_symbol'), get_option('currency_position'))); ?></div>
							</div>
						</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-danger shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-danger text-uppercase mb-1"><?php echo e(__('Payments this year')); ?></div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e(formatCurrency($total_payments_year, get_option('currency_symbol'), get_option('currency_position'))); ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'Receptionist')): ?>
<div class="row">
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?php echo e(__('New Appointments')); ?></div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($total_appointments_today->count()); ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-calendar-check fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1"><?php echo e(__('Total Appointments')); ?></div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($total_appointments); ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-calendar fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Tasks Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-info shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-info text-uppercase mb-1"><?php echo e(__('New Patients')); ?></div>
						<div class="row no-gutters align-items-center">
							<div class="col-auto">
								<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo e($total_patients_today); ?></div>
							</div>
						</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-user-plus fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-warning shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><?php echo e(__('All Patients')); ?></div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($total_patients); ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-users fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'Admin|Receptionist')): ?>
<div class="row">
	<div class="col">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<div class="row">
					<div class="col-8">
						<h6 class="m-0 font-weight-bold text-primary w-75 p-2"><i class="fas fa-calendar-alt mr-1"></i> <?php echo e(__('Today\'s Appointment')); ?> - <?php echo e(Today()->toFormattedDateString()); ?></h6>
					</div>
					<div class="col-4">
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view all appointments')): ?>
						<a href="<?php echo e(route('appointment.all')); ?>" class="btn btn-outline-primary btn-sm float-right"><i class="fas fa-calendar mr-1"></i> <?php echo e(__('All Appointments')); ?></a>
						<?php endif; ?>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create appointment')): ?>
						<a href="<?php echo e(route('appointment.create')); ?>" class="btn btn-outline-primary btn-sm float-right mr-2"><i class="fas fa-calendar-plus mr-1"></i> <?php echo e(__('New Appointment')); ?></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table" id="dataTable" width="100%">
						<thead>
							<tr>
								<th class="text-center">ID</th>
								<th class="text-center"><?php echo e(__('Patient Name')); ?></th>
								<th class="text-center"><?php echo e(__('Date')); ?></th>
								<th class="text-center"><?php echo e(__('Time Slot')); ?></th>
								<th class="text-center"><?php echo e(__('Status')); ?></th>
								<th class="text-center"><?php echo e(__('Created at')); ?></th>
								<th class="text-center"><?php echo e(__('Actions')); ?></th>
							</tr>
						</thead>
						<tbody>
							<?php $__empty_1 = true; $__currentLoopData = $total_appointments_today; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
							<tr>
								<td class="text-center"><?php echo e($appointment->id); ?></td>
								<td class="text-center">
									<a href="<?php echo e(route('patient.view', ['id' => $appointment->user_id])); ?>"> <?php echo e($appointment->User->name); ?> </a>
								</td>
								<td class="text-center">
									<label class="badge badge-primary-soft"><i class="far fa-calendar-check"></i> <?php echo e($appointment->date->format('d M Y')); ?> </label>
								</td>
								<td class="text-center">
									<label class="badge badge-primary-soft"><i class="far fa-clock"></i> <?php echo e($appointment->time_start); ?> - <?php echo e($appointment->time_end); ?></label>
								</td>
								<td class="text-center">
									<?php if($appointment->visited == 0): ?>
									<label class="badge badge-warning-soft">
									<i class=" fas fa-user-clock"></i> <?php echo e(__('Not Yet Visited')); ?>

									</label>
									<?php elseif($appointment->visited == 1): ?>
									<label class="badge badge-success-soft">
									<i class="fas fa-user-check"></i> <?php echo e(__('Visited')); ?>

									</label>
									<?php else: ?>
									<label class="badge badge-danger-soft">
									<i class="fas fa-user-times"></i> <?php echo e(__('Cancelled')); ?>

									</label>
									<?php endif; ?>
								</td>
								<td class="text-center"><?php echo e($appointment->created_at->format('d M Y H:i')); ?></td>
								<td class="text-center">
									<?php if($appointment->date->isFuture()): ?>
									<a class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="<?php echo e(url('appointment/delete/'.$appointment->id)); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('Send Notification To Patient')); ?>"><i class="far fa-bell"></i></a>
									<?php endif; ?>
									<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit appointment')): ?>
									<a data-rdv_id="<?php echo e($appointment->id); ?>" data-rdv_date="<?php echo e($appointment->date->format('d M Y')); ?>" data-rdv_time_start="<?php echo e($appointment->time_start); ?>" data-rdv_time_end="<?php echo e($appointment->time_end); ?>" data-patient_name="<?php echo e($appointment->User->name); ?>" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#EDITRDVModal"><i class="fas fa-check"></i></a>
									<?php endif; ?>
									<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete appointment')): ?>
									<a class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="<?php echo e(route('appointment.destroy', ['id' => $appointment->id])); ?>"><i class="fas fa-trash"></i></a>    
									<?php endif; ?>                  
								</td>
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
							<tr>
								<td colspan="7" class="text-center"><img src="<?php echo e(asset('img/rest.png')); ?> "/> <br><br> <b class="text-muted"><?php echo e(__('You have no appointment today')); ?></b></td>
							</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('header'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.'.Auth::user()->role.'_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/doctorino/v5.2/resources/views/home/staff.blade.php ENDPATH**/ ?>