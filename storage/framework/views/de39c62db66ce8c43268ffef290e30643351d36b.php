<?php $__env->startSection('title'); ?>
<?php echo e(__('Create Notification')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
   <div class="col-md-8">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('Add New Notification')); ?></h6>
         </div>
         <div class="card-body">
            
            <form method="post" action="<?php echo e(route('notification.store')); ?>">
               <div class="form-group">
                  <label for="title"><?php echo e(__('Title')); ?></label>
                  <input type="text" class="form-control" name="title" id="title" aria-describedby="title">
                  <?php echo e(csrf_field()); ?>

               </div>
               <div class="form-group">
                  <label for="content"><?php echo e(__('Content')); ?></label>
                  <textarea class="form-control" name="content" id="content" aria-describedby="content" cols="30" rows="5"></textarea>
                  <?php echo e(csrf_field()); ?>

               </div>
               <div class="form-group">
                  <label for="type"><?php echo e(__('Color')); ?></label>
                  <select type="text" class="form-control" name="type" id="type">
                     <option value="success">Success</option>
                     <option value="danger">Danger</option>
                     <option value="warning">Warning</option>
                     <option value="info">Info</option>
                  </select>
               </div>
               <div class="form-group">
                  <label for="start_date"><?php echo e(__('Start Date')); ?></label>
                  <input type="date" class="form-control" name="start_date" id="start_date">
               </div>
               <div class="form-group">
                  <label for="end_date"><?php echo e(__('End Date')); ?></label>
                  <input type="date" class="form-control" name="end_date" id="end_date">
               </div>
              
               <button type="submit" class="btn btn-primary"><?php echo e(__('Save')); ?></button>
            </form>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.'.Auth::user()->role.'_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/doctorino/v5.2.0/resources/views/notification/create.blade.php ENDPATH**/ ?>