<?php $__env->startSection('title'); ?>
<?php echo e(__('All Patients')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<div class="row ">
			<div class="col-10">
				<h6 class="m-0 font-weight-bold text-primary w-75 p-2"><?php echo e(__('All Patients')); ?></h6>
			</div>
			<div class="col-2">
				<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add patient')): ?>
				<a href="<?php echo e(route('patient.create')); ?>" class="btn btn-outline-primary btn-sm float-right "><i class="fa fa-plus"></i> <?php echo e(__('New Patient')); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr class="text-center">
						<th><?php echo e(__('ID')); ?></th>
						<th><?php echo e(__('Patient Name')); ?></th>
						<th><?php echo e(__('Age')); ?></th>
						<th><?php echo e(__('Phone')); ?></th>
						<th><?php echo e(__('Blood Group')); ?></th>
						<th><?php echo e(__('Registered On')); ?></th>
						<th><?php echo e(__('Due Balance')); ?></th>
						<th><?php echo e(__('Prescriptions')); ?></th>
						<th><?php echo e(__('Actions')); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $__empty_1 = true; $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
					<tr class="text-center">
						<td><?php echo e($patient->id); ?> </td>
						<td><a href="<?php echo e(url('patient/view/'.$patient->id)); ?>"> <?php echo e($patient->name); ?> </a></td>
						<td> <?php echo e(@\Carbon\Carbon::parse($patient->Patient->birthday)->age ?? __('N/A')); ?> </td>
						<td> <?php echo e($patient->Patient->phone ?? __('N/A')); ?> </td>
						<td> <?php echo e(@$patient->Patient->blood ?? __('N/A')); ?> </td>
						<td><label class="badge badge-primary-soft"><?php echo e($patient->created_at->format('d M Y H:i')); ?></label></td>
						<td><label class="badge badge-primary-soft"><?php echo e(formatCurrency(Collect($patient->Billings)->where('payment_status','Partially Paid')->sum('due_amount'), get_option('currency_symbol'), get_option('currency_position'))); ?></label></td>
						<td>
							<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view patient')): ?>
							<a href="<?php echo e(route('prescription.view_for_user', ['id' => $patient->id])); ?>" class="btn btn-outline-primary btn-sm"><i class="fa fa-eye"></i> <?php echo e(__('View')); ?></a>
							<?php endif; ?>
						</td>
						<td>
							<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view patient')): ?>
							<a href="<?php echo e(route('patient.view', ['id' => $patient->id])); ?>" class="btn btn-outline-success btn-sm" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('View Patient Profile')); ?>"><i class="fa fa-eye"></i></a>
							<?php endif; ?>
							<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit patient')): ?>
							<a href="<?php echo e(route('patient.edit', ['id' => $patient->id])); ?>" class="btn btn-outline-warning btn-sm" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('Edit Patient')); ?>"><i class="fa fa-pen"></i></a>
							<a href="<?php echo e(route('patient.SendPassword', ['id' => $patient->id])); ?>" class="btn btn-outline-info btn-sm" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('Send New Credentials To Patient')); ?>"><i class="fa fa-key"></i></a>
							<?php endif; ?>
							<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete patient')): ?>
							<a href="#" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="<?php echo e(route('patient.destroy' , ['id' => $patient->id ])); ?>"><i class="fas fa-trash"></i></a>
							<?php endif; ?>
						</td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
					<tr class="text-center">
						<td colspan="9"><img src="<?php echo e(asset('img/rest.png')); ?> "/> <br><br> <b class="text-muted"><?php echo e(__('No patients found')); ?>, <a href="<?php echo e(route('patient.create')); ?>">Create new one</a></b>
						</td>
					</tr>
					<?php endif; ?>
				</tbody>
			</table>
			<span class="float-right mt-3"><?php echo e($patients->links()); ?></span>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.'.Auth::user()->role.'_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/doctorino/v5.2/resources/views/patient/all.blade.php ENDPATH**/ ?>