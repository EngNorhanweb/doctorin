<?php $__env->startSection('title'); ?>
<?php echo e(__('Doctorino Settings')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row justify-content-center">
   <div class="col-md-8">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('Appointment Settings')); ?></h6>
         </div>
         <div class="card-body">
            <form method="post" action="<?php echo e(route('appointment_settings.store')); ?>" enctype="multipart/form-data">
            

               <div class="form-group row">
                  <label for="appointment_interval" class="col-sm-3 col-form-label"><?php echo e(__('Appointment Interval')); ?></label>
                  <div class="col-sm-9">
                     <select class="form-control" name="appointment_interval" id="appointment_interval" required>
                        <option value="<?php echo e(get_option('appointment_interval')); ?>"><?php echo e(get_option('appointment_interval')); ?> <?php echo e(__('minutes')); ?></option>
                        <option value="10">10 <?php echo e(__('minutes')); ?></option>
                        <option value="15">15 <?php echo e(__('minutes')); ?></option>
                        <option value="20">20 <?php echo e(__('minutes')); ?></option>
                        <option value="25">25 <?php echo e(__('minutes')); ?></option>
                        <option value="30">30 <?php echo e(__('minutes')); ?></option>
                        <option value="35">35 <?php echo e(__('minutes')); ?></option>
                        <option value="40">40 <?php echo e(__('minutes')); ?></option>
                        <option value="45">45 <?php echo e(__('minutes')); ?></option>
                        <option value="50">50 <?php echo e(__('minutes')); ?></option>
                        <option value="55">55 <?php echo e(__('minutes')); ?></option>
                        <option value="60">60 <?php echo e(__('minutes')); ?></option>
                     </select>
                     <?php echo e(csrf_field()); ?>

                     <small id="emailHelp" class="form-text text-muted"><?php echo e(__('Modifying the interval will distort the dates of the appointments')); ?></small>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Saturday" class="col-sm-4 col-md-3 col-form-label"><?php echo e(__('Saturday')); ?></label>
                  <div class="col-sm-4 col-md-4" >
                     <input type="time" class="form-control" id="Saturday" name="saturday_from" value="<?php echo e(get_option('saturday_from')); ?>">
                  </div>
                  <div class="col-sm-4 col-md-4">
                     <input type="time" class="form-control" id="Saturday" name="saturday_to" value="<?php echo e(get_option('saturday_to')); ?>">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Sunday" class="col-sm-4 col-md-3 col-form-label"><?php echo e(__('Sunday')); ?></label>
                  <div class="col-sm-4 col-md-4" >
                     <input type="time" class="form-control" id="Sunday" name="sunday_from" value="<?php echo e(get_option('sunday_from')); ?>">
                  </div>
                  <div class="col-sm-4 col-md-4">
                     <input type="time" class="form-control" id="Sunday" name="sunday_to" value="<?php echo e(get_option('sunday_to')); ?>">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Monday" class="col-sm-4 col-md-3 col-form-label"><?php echo e(__('Monday')); ?></label>
                  <div class="col-sm-4 col-md-4" >
                     <input type="time" class="form-control" id="Monday" name="monday_from" value="<?php echo e(get_option('monday_from')); ?>">
                  </div>
                  <div class="col-sm-4 col-md-4">
                     <input type="time" class="form-control" id="Monday" name="monday_to" value="<?php echo e(get_option('monday_to')); ?>">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Tuesday" class="col-sm-4 col-md-3 col-form-label"><?php echo e(__('Tuesday')); ?></label>
                  <div class="col-sm-4 col-md-4" >
                     <input type="time" class="form-control" id="Tuesday" name="tuesday_from" value="<?php echo e(get_option('tuesday_from')); ?>">
                  </div>
                  <div class="col-sm-4 col-md-4">
                     <input type="time" class="form-control" id="Tuesday" name="tuesday_to" value="<?php echo e(get_option('tuesday_to')); ?>">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Wednseday" class="col-sm-4 col-md-3 col-form-label"><?php echo e(__('Wednseday')); ?></label>
                  <div class="col-sm-4 col-md-4" >
                     <input type="time" class="form-control" id="Wednseday" name="wednesday_from" value="<?php echo e(get_option('wednesday_from')); ?>">
                  </div>
                  <div class="col-sm-4 col-md-4">
                     <input type="time" class="form-control" id="Wednseday" name="wednesday_to" value="<?php echo e(get_option('wednesday_to')); ?>">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Thurday" class="col-sm-4 col-md-3 col-form-label"><?php echo e(__('Thurday')); ?></label>
                  <div class="col-sm-4 col-md-4" >
                     <input type="time" class="form-control" id="Thurday" name="thursday_from" value="<?php echo e(get_option('thursday_from')); ?>">
                  </div>
                  <div class="col-sm-4 col-md-4">
                     <input type="time" class="form-control" id="Thurday" name="thursday_to" value="<?php echo e(get_option('thursday_to')); ?>">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Friday" class="col-sm-4 col-md-3 col-form-label"><?php echo e(__('Friday')); ?></label>
                  <div class="col-sm-4 col-md-4" >
                     <input type="time" class="form-control" id="Friday" name="friday_from" value="<?php echo e(get_option('friday_from')); ?>">
                  </div>
                  <div class="col-sm-4 col-md-4">
                     <input type="time" class="form-control" id="Friday" name="friday_to" value="<?php echo e(get_option('friday_to')); ?>">
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-9">
                     <button type="submit" class="btn btn-primary"><?php echo e(__('Save')); ?></button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
<style type="text/css">
   input[type="file"] {
   display: none;
   }
   .custom-file-upload {
   border: 1px solid #ccc;
   display: inline-block;
   padding: 6px 12px;
   cursor: pointer;
   }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.'.Auth::user()->role.'_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/doctorino/v5.2.0/resources/views/settings/appointment_settings.blade.php ENDPATH**/ ?>