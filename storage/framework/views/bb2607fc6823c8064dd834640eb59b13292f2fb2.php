<?php $__env->startSection('title' , __('Activate Doctorino')); ?>
<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header bg-gradient-primary text-white p-5">
                    <p class="mb-0 text-warning text-capitalize">Your version is not activated, consider purchasing a license before <?php echo e(Carbon\Carbon::parse(get_option('last_check'))->addDays(7)); ?></p>
                    <h1 class=""><?php echo e(__('You want a 20% discount?')); ?></h1>
                    <p class="mb-0 text-capitalize text-font-12">Use <b class="text-warning">WELCOME20</b> promotional code & Enjoy <b>Doctorino</b> features and updates without limits ! and a lifetime</p>
                    <a href="https://getdoctorino.com?utm_source=in-app&utm_medium=upgrade-box&utm_campaign=doctorino" class="btn btn-danger mt-3"><i class="fa fa-key mx-1"></i> Purchase New License</a>
                </div>
                <div class="card-body p-5">
                    <form method="post" action="<?php echo e(route('activation')); ?>" class="mt-4">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                           <div class="col-lg-12">
                              <div>
                                 <div class="mb-4">
                                    <label class="form-label" for="custom_css"><?php echo e(__('Purchase Code')); ?></label>
                                    <input name="purchase_code" type="text" class="form-control" placeholder="Your Purchase Code">
                                 </div>
                              </div>
                           </div>
                        </div>
                        
                        <button type="submit" class="btn btn-doctorino w-lg" name="form" value="activation"><?php echo e(__('Activate')); ?></button>
                      
                     </form>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->


    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.'.Auth::user()->role.'_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/doctorino/v5.2/resources/views/license/activation.blade.php ENDPATH**/ ?>