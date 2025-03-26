<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">{{ __('Ready to Leave') }}</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">{{ __('Ready to Leave Msg') }}</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button"
					data-dismiss="modal">{{ __('Cancel') }}</button>
				<a class="btn btn-primary" href="{{ route('logout') }}"
					onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
				<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
					@csrf
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
				<h5 class="modal-title" id="exampleModalLabel">{{ __('Delete') }}</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">{{ __('Delete Alert') }}</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button"
					data-dismiss="modal">{{ __('Cancel') }}</button>
				<a class="btn btn-danger" id="delete_link">{{ __('Delete') }}</a>
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
				<h5 class="modal-title" id="exampleModalLabel">{{ __('Archive') }}</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">{{ __('Archive Alert') }}</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button"
					data-dismiss="modal">{{ __('Cancel') }}</button>
				<a class="btn btn-warning" id="archive_link">{{ __('Archive') }}</a>
			</div>
		</div>
	</div>
</div>
<!-- Update Appointment Status Modal-->
<div class="modal fade" id="EDITRDVModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">{{ __('You are about to modify an appointment') }}</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<p><b>{{ __('Patient') }} :</b> <span id="patient_name"></span></p>
				<p><b>{{ __('Date') }} :</b> <label class="badge badge-primary-soft" id="rdv_date"></label></p>
				<p><b>{{ __('Time Slot') }} :</b> <label class="badge badge-primary-soft" id="rdv_time"></span></label>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">{{ __('Close') }}</button>
				<a class="btn btn-outline-success" onclick="event.preventDefault(); document.getElementById('rdv-form-confirm').submit();">{{ __('Confirm Appointment') }}</a>
				<form id="rdv-form-confirm" action="{{ route('appointment.store_edit') }}" method="POST" class="d-none">
					<input type="hidden" name="rdv_id" id="rdv_id">
					<input type="hidden" name="rdv_status" value="1">
					@csrf
				</form>
				<a class="btn btn-outline-danger" onclick="event.preventDefault(); document.getElementById('rdv-form-cancel').submit();">{{ __('Cancel Appointment') }}</a>
				<form id="rdv-form-cancel" action="{{ route('appointment.store_edit') }}" method="POST" class="d-none">
					<input type="hidden" name="rdv_id" id="rdv_id2">
					<input type="hidden" name="rdv_status" value="2">
					@csrf
				</form>
			</div>
		</div>
	</div>
</div>