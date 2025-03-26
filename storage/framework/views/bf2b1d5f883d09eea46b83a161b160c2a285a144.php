<?php $__env->startSection('title'); ?>
<?php echo e(__('New Appointment')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row justify-content-center">
   <div class="col-md-10">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('New Appointment')); ?></h6>
         </div>
         <div class="card-body">
            <div class="row">
               <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                     <label for="patient"><?php echo e(__('Patient')); ?> <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add patient')): ?> <a href="<?php echo e(route('patient.create')); ?>" class=""><i class="fa fa-user-plus"></i></a> <?php endif; ?></label>

                     <select class="selectpicker w-100" data-live-search="true" id="patient_name">
                        <option value="0"><?php echo e(__('Select Patient')); ?></option>
                        <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <option value="<?php echo e($patient->id); ?>"><?php echo e($patient->name); ?> (ID : <?php echo e($patient->id); ?>)</option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="rdvdate"><?php echo e(__('Date')); ?></label>
                     <input type="text" class="form-control target" readonly="readonly" id="rdvdate">
                     <small id="emailHelp" class="form-text text-muted"><?php echo e(__('Select the date to display the available time slots')); ?></small>

                  </div>
                  <div class="form-group">
                     <label for="reason"><?php echo e(__('Reason for visit')); ?></label>
                     <textarea class="form-control" id="reason"></textarea>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input" type="checkbox" id="email">
                     <label class="form-check-label" for="email">
                       <?php echo e(__('Send notification by E-mail')); ?>

                     </label>
                   </div>
                   <div class="form-check">
                     <input class="form-check-input" type="checkbox" id="sms">
                     <label class="form-check-label" for="sms">
                       <?php echo e(__('Notify by SMS')); ?>

                     </label>
                   </div>
                   <div class="form-check">
                     <input class="form-check-input" type="checkbox" id="whatsapp">
                     <label class="form-check-label" for="whatsapp">
                       <?php echo e(__('Notify by Whatsapp')); ?>

                     </label>
                   </div>
               </div>
               <div class="col-md-8 col-sm-12">
                  <label for="date"><?php echo e(__('Available Times')); ?></label> 
                  <hr>
                  <div class="row mb-2 myorders"></div>
                  <div class="alert alert-warning text-center" role="alert" id="help-block">
                     <img src="<?php echo e(asset('img/calendar.png')); ?>"><br>
                     <b><?php echo e(__('No dates selected, please select a date first')); ?></b>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Appointment Modal-->
<div class="modal fade" id="RDVModalSubmit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Are you sure of the date')); ?></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body">
               <p><b><?php echo e(__('Patient')); ?> :</b> <span id="patient_name"></span></p>
               <p><b><?php echo e(__('Date')); ?> :</b> <label class="badge badge-primary-soft" id="rdv_date"></label></p>
               <p><b><?php echo e(__('Time Slot')); ?> :</b> <label class="badge badge-primary-soft" id="rdv_time"></span></label></p>
               <p><b><?php echo e(__('Reason for visit')); ?> :</b> <label class="badge badge-primary-soft" id="reason_for_visit"></span></label></p>
         </div>
         <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
            <a class="btn btn-primary text-white"
               onclick="event.preventDefault();
               document.getElementById('rdv-form').submit();"><?php echo e(__('Save')); ?></a>
            <form id="rdv-form" action="<?php echo e(route('appointment.store')); ?>" method="POST" class="d-none">
               <input type="hidden" name="patient" id="patient_input">
               <input type="hidden" name="rdv_time_date" id="rdv_date_input">
               <input type="hidden" name="rdv_time_start" id="rdv_time_start_input">
               <input type="hidden" name="rdv_time_end" id="rdv_time_end_input">
               <input type="hidden" name="notifyby_sms" id="notifyby_sms">
               <input type="hidden" name="notifyby_whatsapp" id="notifyby_whatsapp">
               <input type="hidden" name="notifyby_email" id="notifyby_email">
               <input type="hidden" name="reason" id="reason_for_visit_input">
               <?php echo csrf_field(); ?>
            </form>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('header'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.'.Auth::user()->role.'_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/doctorino/v5.2.0/resources/views/appointment/create.blade.php ENDPATH**/ ?>