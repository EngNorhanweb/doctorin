<?php $__env->startSection('title'); ?>
<?php echo e(__('Payment Settings')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row justify-content-center">
   <div class="col-md-10">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-dollar"></i> <?php echo e(__('Currency Options')); ?></h6>
         </div>
         <div class="card-body">
            <form method="post" action="<?php echo e(route('payment_settings.store')); ?>">
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="currency"><?php echo e(__('Default Currency')); ?></label>
                     <select name="currency" id="currency" class="form-control" data-live-search="true">
                        <?php $__currentLoopData = get_currency_symbol(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currencyName => $currencyData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($currencyName); ?>" <?php if($currencyData['ISO'] == get_option('currency')): ?> selected <?php endif; ?>><?php echo e($currencyName); ?> - <?php echo e($currencyData['ISO']); ?> (<?php echo e($currencyData['Symbol']); ?>)</option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </select>
                     <?php echo e(csrf_field()); ?>

                  </div>
                  <div class="form-group col-md-6">
                     <label for="currency_position"><?php echo e(__('Currency position')); ?></label>
                     <select name="currency_position" id="" class="select-control w-100">
                        <option value="left" <?php if(get_option('currency_position') == 'left'): ?> selected <?php endif; ?>>Left</option>
                        <option value="right" <?php if(get_option('currency_position') == 'right'): ?> selected <?php endif; ?>>Right</option>
                        <option value="left_with_space" <?php if(get_option('currency_position') == 'left_with_space'): ?> selected <?php endif; ?>>Left With Space</option>
                        <option value="right_with_space" <?php if(get_option('currency_position') == 'right_with_space'): ?> selected <?php endif; ?>>Right With Space</option>
                     </select>
                  </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="active_stripe"><?php echo e(__('VAT')); ?> (%)</label>
                     <input type="number" class="form-control" id="Currency" name="vat" value="<?php echo e(App\Setting::get_option('vat')); ?>" required>
                  </div>
               </div>
         </div>
      </div>
   </div>
</div>

<div class="row justify-content-center">
   <div class="col-md-10">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fab fa-stripe"></i> <?php echo e(__('Stripe')); ?></h6>
         </div>
         <div class="card-body">
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="active_stripe"><?php echo e(__('Status')); ?></label>
                     <select name="active_stripe" id="" class="select-control w-100">
                        <option value="1">Active</option>
                        <option value="0">Deactive</option>
                     </select>
                  </div>
                  <div class="form-group col-md-6">
                     <label for="stripe_mode"><?php echo e(__('Stripe Mode')); ?></label>
                     <select name="stripe_mode" id="" class="select-control w-100">
                        <option value="sandbox" <?php if(get_option('stripe_key')): ?> <?php endif; ?>>Test</option>
                        <option value="live">Live</option>
                     </select>
                  </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="stripe_secret"><?php echo e(__('Stripe Secret')); ?></label>
                     <input type="text" class="form-control" id="stripe_secret" name="stripe_secret" value="<?php echo e(get_option('stripe_secret')); ?>">
                  </div>
                  <div class="form-group col-md-6">
                     <label for="stripe_key"><?php echo e(__('Stripe Key')); ?></label>
                     <input type="text" class="form-control" id="stripe_key" name="stripe_key" value="<?php echo e(get_option('stripe_key')); ?>">
                  </div>
               </div>
         </div>
      </div>
   </div>
</div>

<div class="row justify-content-center">
   <div class="col-md-10">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fab fa-paypal"></i> <?php echo e(__('PayPal')); ?></h6>
         </div>
         <div class="card-body">
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="active_paypal"><?php echo e(__('Status')); ?></label>
                     <select name="active_paypal" id="" class="select-control w-100">
                        <option value="1">Active</option>
                        <option value="0">Deactive</option>
                     </select>
                  </div>
                  <div class="form-group col-md-6">
                     <label for="paypal_mode"><?php echo e(__('PayPal Mode')); ?></label>
                     <select name="paypal_mode" id="" class="select-control w-100">
                        <option value="sandbox">Sandbox</option>
                        <option value="live">Live</option>
                     </select>
                  </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="paypal_client_id"><?php echo e(__('PayPal Client ID')); ?></label>
                     <input type="text" class="form-control" id="paypal_client_id" name="paypal_client_id" value="<?php echo e(get_option('paypal_client_id')); ?>">
                  </div>
                  <div class="form-group col-md-6">
                     <label for="paypal_secret"><?php echo e(__('PayPal Secret')); ?></label>
                     <input type="text" class="form-control" id="paypal_secret" name="paypal_secret" value="<?php echo e(get_option('paypal_secret')); ?>">
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.'.Auth::user()->role.'_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/doctorino/v5.2.0/resources/views/settings/payment_settings.blade.php ENDPATH**/ ?>