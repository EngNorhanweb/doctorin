<?php $__env->startSection('title'); ?>
<?php echo e(__(ucfirst(Request::segment(2)).' Appointments')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="card shadow mb-4">
	<div class="card-header py-3">
		<div class="row">
			<div class="col-6">
				<h6 class="m-0 font-weight-bold text-primary w-75 p-2"><?php echo e(__(ucfirst(Request::segment(2)).' Appointments')); ?></h6>
			</div>
			<div class="col-6">
				<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create appointment')): ?>
				<a href="<?php echo e(route('appointment.create')); ?>" class="btn btn-outline-primary btn-sm float-right mr-2"><i class="fa fa-plus"></i> <?php echo e(__('New Appointment')); ?></a>
				<?php endif; ?>
				<a href="<?php echo e(route('appointment.cancelled')); ?>" class="btn btn-danger btn-sm float-right mr-2"><i class="fas fa-user-times"></i> <?php echo e(__('Cancelled')); ?></a>
				<a href="<?php echo e(route('appointment.pending')); ?>" class="btn btn-warning btn-sm float-right mr-2"><i class="fas fa-user-clock"></i> <?php echo e(__('Pending')); ?></a>
				<a href="<?php echo e(route('appointment.treated')); ?>" class="btn btn-success btn-sm float-right mr-2"><i class="fas fa-user-check"></i> <?php echo e(__('Treated')); ?></a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th class="text-center">ID</th>
						<th class="text-center"><?php echo e(__('Patient Name')); ?></th>
						<th class="text-center"><?php echo e(__('Reason for visit')); ?></th>
						<th class="text-center"><?php echo e(__('Schedule Info')); ?></th>
						<th class="text-center"><?php echo e(__('Status')); ?></th>
						<th class="text-center"><?php echo e(__('Created at')); ?></th>
						<th class="text-center"><?php echo e(__('Actions')); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $__empty_1 = true; $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
					<tr>
						<td class="text-center"><?php echo e($appointment->id); ?></td>
						<td class="text-center"><a href="<?php echo e(url('patient/view/'.$appointment->user_id)); ?>"> <?php echo e($appointment->User->name); ?> </a></td>
						<td class="text-center"><label class="badge badge-primary-soft"><?php echo e($appointment->reason ?? 'N/A'); ?></label></td>
						<td class="text-center"> 
							<label class="badge badge-primary-soft">
							<i class="far fa-calendar-check"></i> <?php echo e($appointment->date->format('d M Y')); ?>

							</label>
							<label class="badge badge-primary-soft">
							<i class="far fa-clock"></i> <?php echo e($appointment->time_start); ?> - <?php echo e($appointment->time_end); ?>

							</label>
						</td>
						<td class="text-center">
							<?php if($appointment->visited == 0): ?>
							<label class="badge badge-warning-soft">
							<i class="fas fa-user-clock"></i> <?php echo e(__('Not Yet Visited')); ?>

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
						<td class="text-center"><label class="badge badge-primary-soft"><?php echo e($appointment->created_at->format('d M Y H:i')); ?></label></td>
						<td class="text-center">
							<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit appointment')): ?>
							<?php if($appointment->date->isFuture() and $appointment->visited == 0): ?>
							<a class="btn btn-outline-info btn-sm"  href="<?php echo e(route('appointment.notify.whatsapp', ['id' => $appointment->id])); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('Send Notification To Patient')); ?>"><i class="fab fa-whatsapp"></i></a>
							<a class="btn btn-outline-info btn-sm"  href="<?php echo e(route('appointment.notify.email', ['id' => $appointment->id])); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('Send Notification To Patient')); ?>"><i class="far fa-envelope"></i></a>
							<?php endif; ?>
							<?php endif; ?>
							<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit appointment')): ?>
							<a class="btn btn-outline-success btn-sm" data-rdv_id="<?php echo e($appointment->id); ?>" data-rdv_date="<?php echo e($appointment->date->format('d M Y')); ?>" data-rdv_time_start="<?php echo e($appointment->time_start); ?>" data-rdv_time_end="<?php echo e($appointment->time_end); ?>" data-patient_name="<?php echo e($appointment->User->name); ?>" data-toggle="modal" data-target="#EDITRDVModal"><i class="fas fa-check"></i></a>
							<?php endif; ?>
							<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete appointment')): ?>
							<a class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="<?php echo e(route('appointment.destroy', ['id' => $appointment->id])); ?>"><i class="fas fa-trash"></i></a>
							<?php endif; ?>
						</td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
					<tr>
						<td colspan="7" align="center"><img src="<?php echo e(asset('img/rest.png')); ?> "/> <br><br> <b class="text-muted">You have no appointment</b></td>
					</tr>
					<?php endif; ?>
				</tbody>
			</table>
			<span class="float-right mt-3"><?php echo e($appointments->links()); ?></span>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header'); ?>
<style type="text/css">
	td > a {
	font-weight: 600;
	font-size: 15px;
	}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.'.Auth::user()->role.'_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/doctorino/v5.2.0/resources/views/appointment/all.blade.php ENDPATH**/ ?>