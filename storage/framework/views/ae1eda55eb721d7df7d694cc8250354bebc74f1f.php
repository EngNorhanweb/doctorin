<?php $__env->startSection('title'); ?>
<?php echo e(__('All Tests')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<div class="row">
			<div class="col-8">
				<h6 class="m-0 font-weight-bold text-primary w-75 p-2"><?php echo e(__('All Tests')); ?></h6>
			</div>
			<div class="col-4">
				<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create diagnostic test')): ?>
				<a href="<?php echo e(route('test.create')); ?>" class="btn btn-outline-primary btn-sm float-right"><i class="fa fa-plus"></i> <?php echo e(__('Add Test')); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th class="text-center">ID</th>
						<th class="text-center"><?php echo e(__('Test Name')); ?></th>
						<th class="text-center"><?php echo e(__('Description')); ?></th>
						<th class="text-center"><?php echo e(__('Total Use')); ?></th>
						<th class="text-center"><?php echo e(__('Actions')); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $__empty_1 = true; $__currentLoopData = $tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
					<tr>
						<td class="text-center"><?php echo e($test->id); ?></td>
						<td class="text-center"><?php echo e($test->test_name); ?></td>
						<td class="text-center"> <?php echo e($test->comment ?? __('N/A')); ?> </td>
						<td class="text-center"><label class="badge badge-primary-soft"><i class="fa fa-clock"></i> <?php echo e(__('In Prescription')); ?> : <?php echo e($test->Prescription->count()); ?> <?php echo e(__('time use')); ?></label></td>
						<td class="text-center">
							<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit diagnostic test')): ?>
							<a href="<?php echo e(route('test.edit', ['id' => $test->id])); ?>" class="btn btn-outline-warning btn-sm"><i class="fa fa-pen"></i></a>
							<?php endif; ?>
							<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete diagnostic test')): ?>
							<a class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="<?php echo e(route('test.delete', ['id' => $test->id])); ?>"><i class="fa fa-trash"></i></a>
							<?php endif; ?>
						</td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
					<tr>
						<td colspan="5" class="text-center"><?php echo e(__('You don\'t have any Diagnosis Tests')); ?>, <a href="<?php echo e(route('test.create')); ?>"><?php echo e(__('create one')); ?></a></td>
					</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.'.Auth::user()->role.'_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/doctorino/v5.2.0/resources/views/test/all.blade.php ENDPATH**/ ?>