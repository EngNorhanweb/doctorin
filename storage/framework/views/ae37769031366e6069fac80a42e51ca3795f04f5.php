<?php $__env->startSection('title'); ?>
<?php echo e(__('All Drugs')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<div class="row">
			<div class="col-8">
				<h6 class="m-0 font-weight-bold text-primary w-75 p-2"><?php echo e(__('All Drugs')); ?></h6>
			</div>
			<div class="col-4">
				<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create drug')): ?>
				<a href="<?php echo e(route('drug.bulk_upload')); ?>" class="btn btn-outline-primary btn-sm float-right"><i class="fa fa-cloud-upload-alt"></i> <?php echo e(__('Bulk Upload')); ?></a>
				<a href="<?php echo e(route('drug.create')); ?>" class="btn btn-outline-primary btn-sm float-right mr-2"><i class="fa fa-plus"></i> <?php echo e(__('Add Drug')); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr class="text-center">
						<th>ID</th>
						<th><?php echo e(__('Trade Name')); ?></th>
						<th><?php echo e(__('Generic Name')); ?></th>
						<th><?php echo e(__('Total Use')); ?></th>
						<th><?php echo e(__('Actions')); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $__empty_1 = true; $__currentLoopData = $drugs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
					<tr class="text-center">
						<td><?php echo e($drug->id); ?></td>
						<td><?php echo e(ucfirst($drug->trade_name)); ?></td>
						<td><?php echo e(ucfirst($drug->generic_name)); ?></td>
						<td><label class="badge badge-primary-soft"><?php echo e(__('In Prescription')); ?> : <?php echo e($drug->Prescription->count()); ?> <?php echo e(__('time use')); ?></label></td>
						<td>
							<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit drug')): ?>
							<a href="<?php echo e(route('drug.edit',['id' => $drug->id])); ?>" class="btn btn-outline-warning btn-sm"><i class="fa fa-pen"></i></a>
							<?php endif; ?>
							<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete drug')): ?>
							<a class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="<?php echo e(route('drug.destroy',['id' => $drug->id])); ?>"><i class="fas fa-trash"></i></a>
							<?php endif; ?>
						</td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
					<tr class="text-center">
						<td colspan="5"><?php echo e(__('You don\'t have any drug')); ?>, <a href="<?php echo e(route('drug.create')); ?>"><?php echo e(__('create one')); ?></a></td>
					</tr>
					<?php endif; ?>
				</tbody>
			</table>
			<span class="float-right mt-3"><?php echo e($drugs->links()); ?></span>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.'.Auth::user()->role.'_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/doctorino/v5.2/resources/views/drug/all.blade.php ENDPATH**/ ?>