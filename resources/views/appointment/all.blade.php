@extends('layouts.'.Auth::user()->role.'_layout')

@section('title')
{{ __(ucfirst(Request::segment(2)).' Appointments') }}
@endsection
@section('content')

<div class="card shadow mb-4">
	<div class="card-header py-3">
		<div class="row">
			<div class="col-6">
				<h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __(ucfirst(Request::segment(2)).' Appointments') }}</h6>
			</div>
			<div class="col-6">
				@can('create appointment')
				<a href="{{ route('appointment.create') }}" class="btn btn-outline-primary btn-sm float-right mr-2"><i class="fa fa-plus"></i> {{ __('New Appointment') }}</a>
				@endcan
				<a href="{{ route('appointment.cancelled') }}" class="btn btn-danger btn-sm float-right mr-2"><i class="fas fa-user-times"></i> {{ __('Cancelled') }}</a>
				<a href="{{ route('appointment.pending') }}" class="btn btn-warning btn-sm float-right mr-2"><i class="fas fa-user-clock"></i> {{ __('Pending') }}</a>
				<a href="{{ route('appointment.treated') }}" class="btn btn-success btn-sm float-right mr-2"><i class="fas fa-user-check"></i> {{ __('Treated') }}</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th class="text-center">ID</th>
						<th class="text-center">{{ __('Patient Name') }}</th>
						<th class="text-center">{{ __('Reason for visit') }}</th>
						<th class="text-center">{{ __('Schedule Info') }}</th>
						<th class="text-center">{{ __('Status') }}</th>
						<th class="text-center">{{ __('Created at') }}</th>
						<th class="text-center">{{ __('Actions') }}</th>
					</tr>
				</thead>
				<tbody>
					@forelse($appointments as $appointment)
					<tr>
						<td class="text-center">{{ $appointment->id }}</td>
						<td class="text-center"><a href="{{ url('patient/view/'.$appointment->user_id) }}"> {{ $appointment->User->name }} </a></td>
						<td class="text-center"><label class="badge badge-primary-soft">{{ $appointment->reason ?? 'N/A' }}</label></td>
						<td class="text-center"> 
							<label class="badge badge-primary-soft">
							<i class="far fa-calendar-check"></i> {{ $appointment->date->format('d M Y') }}
							</label>
							<label class="badge badge-primary-soft">
							<i class="far fa-clock"></i> {{ $appointment->time_start }} - {{ $appointment->time_end }}
							</label>
						</td>
						<td class="text-center">
							@if($appointment->visited == 0)
							<label class="badge badge-warning-soft">
							<i class="fas fa-user-clock"></i> {{ __('Not Yet Visited') }}
							</label>
							@elseif($appointment->visited == 1)
							<label class="badge badge-success-soft">
							<i class="fas fa-user-check"></i> {{ __('Visited') }}
							</label>
							@else
							<label class="badge badge-danger-soft">
							<i class="fas fa-user-times"></i> {{ __('Cancelled') }}
							</label>
							@endif
						</td>
						<td class="text-center"><label class="badge badge-primary-soft">{{ $appointment->created_at->format('d M Y H:i') }}</label></td>
						<td class="text-center">
							@can('edit appointment')
							@if($appointment->date->isFuture() and $appointment->visited == 0)
							<a class="btn btn-outline-info btn-sm"  href="{{ route('appointment.notify.whatsapp', ['id' => $appointment->id]) }}" data-toggle="tooltip" data-placement="top" title="{{ __('Send Notification To Patient') }}"><i class="fab fa-whatsapp"></i></a>
							<a class="btn btn-outline-info btn-sm"  href="{{ route('appointment.notify.email', ['id' => $appointment->id]) }}" data-toggle="tooltip" data-placement="top" title="{{ __('Send Notification To Patient') }}"><i class="far fa-envelope"></i></a>
							@endif
							@endcan
							@can('edit appointment')
							<a class="btn btn-outline-success btn-sm" data-rdv_id="{{ $appointment->id }}" data-rdv_date="{{ $appointment->date->format('d M Y') }}" data-rdv_time_start="{{ $appointment->time_start }}" data-rdv_time_end="{{ $appointment->time_end }}" data-patient_name="{{ $appointment->User->name }}" data-toggle="modal" data-target="#EDITRDVModal"><i class="fas fa-check"></i></a>
							@endcan
							@can('delete appointment')
							<a class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="{{ route('appointment.destroy', ['id' => $appointment->id]) }}"><i class="fas fa-trash"></i></a>
							@endcan
						</td>
					</tr>
					@empty
					<tr>
						<td colspan="7" align="center"><img src="{{ asset('img/rest.png') }} "/> <br><br> <b class="text-muted">You have no appointment</b></td>
					</tr>
					@endforelse
				</tbody>
			</table>
			<span class="float-right mt-3">{{ $appointments->links() }}</span>
		</div>
	</div>
</div>
@endsection
@section('header')
<style type="text/css">
	td > a {
	font-weight: 600;
	font-size: 15px;
	}
</style>
@endsection
@section('footer')
@endsection