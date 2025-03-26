<?php $__env->startSection('title'); ?>
<?php echo e(__('All users')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

          <div class="card shadow mb-4">
            <div class="card-header py-3">
               <div class="row">
                <div class="col-8">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2"><?php echo e(__('All Users')); ?></h6>
                </div>
                <div class="col-4">
                  <a href="<?php echo e(route('user.create')); ?>" class="btn btn-outline-primary btn-sm float-right "><i class="fa fa-plus"></i> <?php echo e(__('New User')); ?></a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="text-center">
                      <th>ID</th>
                      <th><?php echo e(__('Name')); ?></th>
                      <th><?php echo e(__('Email')); ?></th>
                      <th><?php echo e(__('Register Date')); ?></th>
                      <th><?php echo e(__('Roles')); ?></th>
                      <th><?php echo e(__('Actions')); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="text-center">
                      <td><?php echo e($user->id); ?></td>
                      <td><?php echo e($user->name); ?></td>
                      <td> <?php echo e($user->email); ?> </td>
                      <td><label class="badge badge-primary-soft"><?php echo e($user->created_at->format('d M Y H:i')); ?></label></td>
                      <td>
                        <?php $__empty_1 = true; $__currentLoopData = $user->getRoleNames(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <label class="badge badge-warning-soft"><?php echo e(ucfirst($role)); ?></label> 
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>  
                        <label class="badge badge-warning-soft">no role for <?php echo e($user->name); ?></label> 
                        <?php endif; ?>
                      </td>
                      <td>
                        <a href="<?php echo e(route('user.edit',['id' => $user->id])); ?>" class="btn btn-outline-warning btn-sm"><i class="fa fa-pen"></i></a>
                        <a href="#" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="<?php echo e(route('patient.destroy',['id' => $user->id])); ?>"><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   
                  </tbody>
                </table>
               <span class="float-right mt-3"><?php echo e($users->links()); ?></span>

              </div>
            </div>
          </div>
<?php $__env->stopSection(); ?>

  
<?php echo $__env->make('layouts.'.Auth::user()->role.'_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/doctorino/v5.2.0/resources/views/user/all.blade.php ENDPATH**/ ?>