<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Ready to Leave')); ?></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body"><?php echo e(__('Ready to Leave Msg')); ?></div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button"
					data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
				<a class="btn btn-primary" href="<?php echo e(route('logout')); ?>"
					onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><?php echo e(__('Logout')); ?></a>
				<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
					<?php echo csrf_field(); ?>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Delete Modal-->
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Delete')); ?></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body"><?php echo e(__('Delete Alert')); ?></div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button"
					data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
				<a class="btn btn-danger" id="delete_link"><?php echo e(__('Delete')); ?></a>
			</div>
		</div>
	</div>
</div>
<!-- Archive Modal-->
<div class="modal fade" id="ArchiveModal" tabindex="-1" role="dialog" aria-labelledby="ArchiveModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Archive')); ?></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body"><?php echo e(__('Archive Alert')); ?></div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button"
					data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
				<a class="btn btn-warning" id="archive_link"><?php echo e(__('Archive')); ?></a>
			</div>
		</div>
	</div>
</div>
<!-- Update Appointment Status Modal-->
<div class="modal fade" id="EDITRDVModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('You are about to modify an appointment')); ?></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<p><b><?php echo e(__('Patient')); ?> :</b> <span id="patient_name"></span></p>
				<p><b><?php echo e(__('Date')); ?> :</b> <label class="badge badge-primary-soft" id="rdv_date"></label></p>
				<p><b><?php echo e(__('Time Slot')); ?> :</b> <label class="badge badge-primary-soft" id="rdv_time"></span></label>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
				<a class="btn btn-outline-success" onclick="event.preventDefault(); document.getElementById('rdv-form-confirm').submit();"><?php echo e(__('Confirm Appointment')); ?></a>
				<form id="rdv-form-confirm" action="<?php echo e(route('appointment.store_edit')); ?>" method="POST" class="d-none">
					<input type="hidden" name="rdv_id" id="rdv_id">
					<input type="hidden" name="rdv_status" value="1">
					<?php echo csrf_field(); ?>
				</form>
				<a class="btn btn-outline-danger" onclick="event.preventDefault(); document.getElementById('rdv-form-cancel').submit();"><?php echo e(__('Cancel Appointment')); ?></a>
				<form id="rdv-form-cancel" action="<?php echo e(route('appointment.store_edit')); ?>" method="POST" class="d-none">
					<input type="hidden" name="rdv_id" id="rdv_id2">
					<input type="hidden" name="rdv_status" value="2">
					<?php echo csrf_field(); ?>
				</form>
			</div>
		</div>
	</div>
</div><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/doctorino/v5.2.0/resources/views/layouts/modals.blade.php ENDPATH**/ ?>