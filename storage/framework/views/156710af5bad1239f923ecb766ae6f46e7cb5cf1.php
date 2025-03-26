<?php $__env->startSection('title'); ?>
<?php echo e(__('Create Expense')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
   <div class="col-md-8">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('Add New Expense')); ?></h6>
         </div>
         <div class="card-body">
            
            <form method="post" action="<?php echo e(route('expense.store')); ?>">
               <div class="form-group">
                  <label for="title"><?php echo e(__('Title')); ?></label>
                  <input type="text" class="form-control" name="title" id="title" aria-describedby="title">
                  <?php echo e(csrf_field()); ?>

               </div>
               <div class="form-group">
                  <label for="type"><?php echo e(__('Type')); ?></label>
                  <input type="text" class="form-control" name="type" id="type">
               </div>
               <div class="form-group">
                  <label for="amount"><?php echo e(__('Amount')); ?></label>
                  <input type="number" class="form-control" name="amount" id="amount">
               </div>
               <div class="form-group">
                  <label for="date"><?php echo e(__('Date')); ?></label>
                  <input type="date" class="form-control" name="date" id="date">
               </div>
               <div class="form-group">
                  <label for="note"><?php echo e(__('Note')); ?></label>
                  <input type="text" class="form-control" name="note" id="note">
               </div>
               <button type="submit" class="btn btn-primary"><?php echo e(__('Save')); ?></button>
            </form>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.'.Auth::user()->role.'_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/doctorino/v5.2.0/resources/views/expense/create.blade.php ENDPATH**/ ?>