<?php $__env->startSection('title'); ?>
<?php echo e(__('Doctorino Settings')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row justify-content-center">
   <div class="col-md-8">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('Doctorino Settings')); ?></h6>
         </div>
         <div class="card-body">
            <form method="post" action="<?php echo e(route('doctorino_settings.store')); ?>" enctype="multipart/form-data">
               <div class="form-group row">
                  <label for="system_name" class="col-sm-3 col-form-label"><?php echo e(__('System Name')); ?> </label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="system_name" name="system_name" value="<?php echo e(get_option('system_name')); ?>" required>
                     <?php echo e(csrf_field()); ?>

                  </div>
               </div>
               <div class="form-group row">
                  <label for="Title" class="col-sm-3 col-form-label"><?php echo e(__('Docteur Name')); ?></label>
                  <div class="col-sm-9">
                     <input type="title" class="form-control" id="Title" name="title" value="<?php echo e(get_option('title')); ?>" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="logo" class="col-sm-3 col-form-label"><?php echo e(__('Logo')); ?></label>
                  <div class="col-sm-9">
                     <label for="file-upload" class="custom-file-upload w-100">
                     <i class="fa fa-cloud-upload"></i> Select Logo to Upload
                     </label>
                     <input type="file" class="form-control" id="file-upload" name="logo">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Address" class="col-sm-3 col-form-label"><?php echo e(__('Address')); ?></label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="Address" name="address" value="<?php echo e(get_option('address')); ?>" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Phone" class="col-sm-3 col-form-label"><?php echo e(__('Phone')); ?> </label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="Phone" name="phone" value="<?php echo e(get_option('phone')); ?>" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="hospital_email" class="col-sm-3 col-form-label"><?php echo e(__('Hospital Email')); ?></label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="hospital_email" name="hospital_email" value="<?php echo e(get_option('hospital_email')); ?>" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Language" class="col-sm-3 col-form-label"><?php echo e(__('Language')); ?></label>
                  <div class="col-sm-9">
                     <select class="form-control" name="language" id="Language" required>
                        <option value="<?php echo e(get_option('language')); ?>"><?php echo e($language[get_option('language')]); ?></option>
                        <option value="en">English</option>
                        <option value="es">Spanish</option>
                        <option value="fr">French</option>
                        <option value="de">Dutch</option>
                        <option value="it">Italian</option>
                        <option value="pt">Portuguese</option>
                        <option value="in">Hindi</option>
                        <option value="bn">Bengali</option>
                        <option value="id">Indonesian</option>
                        <option value="tr">Turkish</option>
                        <option value="ru">Russian</option>
                        <option value="ar">Arabic</option>
                     </select>
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
<?php echo $__env->make('layouts.'.Auth::user()->role.'_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/doctorino/v5.2.0/resources/views/settings/doctorino_settings.blade.php ENDPATH**/ ?>