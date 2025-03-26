<?php $__env->startSection('template_title'); ?>
Licence Manager
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
    <i class="fa fa-lock fa-fw" aria-hidden="true"></i>
    Licence Manager 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('container'); ?>

    <p class="text-center">
        <ol>
            <li>Please go to <a href="https://codecanyon.net/downloads">Codecanyon.net/downloads</a></li>
            <li>Click the Download button in Doctorino row</li>
            <li>Select License Certificate &amp; Purchase code</li>
            <li>Copy Item Purchase Code</li>
         </ol>
    </p>
    <form method="post" action="<?php echo e(route('LaravelInstaller::saveLicence')); ?>" class="tabs-wrap">
        <?php echo csrf_field(); ?>
        <div class="form-group <?php echo e($errors->has('purchase_code') ? ' has-error ' : ''); ?>">
            <label for="purchase_code">
                Purchase Code
            </label>
            <input type="text" name="purchase_code" id="purchase_code" value="<?php echo e(session('purchase_code')); ?>" placeholder="Purchase Code" />
            <?php if($errors->has('purchase_code')): ?>
                <span class="error-block">
                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    <?php echo e($errors->first('purchase_code')); ?>

                </span>
            <?php endif; ?>
        </div>
        <div class="buttons">
            <button class="button" type="submit">
               Check & <?php echo e(trans('installer_messages.environment.wizard.form.buttons.install')); ?>

                <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
            </button>
        </div>
    </form>
    

<?php $__env->stopSection(); ?>

<?php echo $__env->make('vendor.installer.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/doctorino/v5.2.0/resources/views/vendor/installer/license.blade.php ENDPATH**/ ?>