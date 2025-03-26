@extends('layouts.'.Auth::user()->role.'_layout')

@section('title')
{{ __('Dashboard') }}
@endsection
@section('content')
@role('Admin')
@if(get_option('available_version') != get_option('current_version'))
	<div class="alert alert-info">{{ __('A new version is available') }} : <a href="https://codecanyon.net/item/doctorino-doctor-chamber-management-system/28707541" target="_blank">Download Doctorino {{ get_option('available_version') }}</a></div>
@endif
@endrole
@can('create prescription')
<div class="row">
	<div class="col">
		<div class="alert alert-warning">{{ __('Simplifies prescription and appointments, helping you to manage patients & you chamber in a smart way.') }} <br><b><a href="{{ route('appointment.create') }}">Create your first prescription</a></b> in less than 60 seconds.</div>
	</div>
</div>
@endcan
@role('Admin')
<div class="row">
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('New Appointments') }}</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_appointments_today->count() }}</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-calendar-check fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{ __('Total Appointments') }}</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_appointments }}</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-calendar fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Tasks Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-info shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-info text-uppercase mb-1">{{ __('New Patients') }}</div>
						<div class="row no-gutters align-items-center">
							<div class="col-auto">
								<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $total_patients_today }}</div>
							</div>
						</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-user-plus fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-warning shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">{{ __('All Patients') }}</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_patients }}</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-users fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('Total Prescriptions') }}</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_prescriptions }}</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-pills fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{ __('Total Payments') }}</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_payments }}</div>
					</div>
					<div class="col-auto">
						<i class="fa fa-wallet fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Tasks Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-secondary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">{{ __('Payments this month') }}</div>
						<div class="row no-gutters align-items-center">
							<div class="col-auto">
								<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ formatCurrency($total_payments_month, get_option('currency_symbol'), get_option('currency_position')) }}</div>
							</div>
						</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-danger shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">{{ __('Payments this year') }}</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">{{ formatCurrency($total_payments_year, get_option('currency_symbol'), get_option('currency_position')) }}</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endrole
@role('Receptionist')
<div class="row">
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('New Appointments') }}</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_appointments_today->count() }}</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-calendar-check fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{ __('Total Appointments') }}</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_appointments }}</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-calendar fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Tasks Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-info shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-info text-uppercase mb-1">{{ __('New Patients') }}</div>
						<div class="row no-gutters align-items-center">
							<div class="col-auto">
								<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $total_patients_today }}</div>
							</div>
						</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-user-plus fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-warning shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">{{ __('All Patients') }}</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_patients }}</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-users fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endrole
@role('Admin|Receptionist')
<div class="row">
	<div class="col">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<div class="row">
					<div class="col-8">
						<h6 class="m-0 font-weight-bold text-primary w-75 p-2"><i class="fas fa-calendar-alt mr-1"></i> {{ __('Today\'s Appointment') }} - {{ Today()->toFormattedDateString() }}</h6>
					</div>
					<div class="col-4">
						@can('view all appointments')
						<a href="{{ route('appointment.all') }}" class="btn btn-outline-primary btn-sm float-right"><i class="fas fa-calendar mr-1"></i> {{ __('All Appointments') }}</a>
						@endcan
						@can('create appointment')
						<a href="{{ route('appointment.create') }}" class="btn btn-outline-primary btn-sm float-right mr-2"><i class="fas fa-calendar-plus mr-1"></i> {{ __('New Appointment') }}</a>
						@endcan
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table" id="dataTable" width="100%">
						<thead>
							<tr>
								<th class="text-center">ID</th>
								<th class="text-center">{{ __('Patient Name') }}</th>
								<th class="text-center">{{ __('Date') }}</th>
								<th class="text-center">{{ __('Time Slot') }}</th>
								<th class="text-center">{{ __('Status') }}</th>
								<th class="text-center">{{ __('Created at') }}</th>
								<th class="text-center">{{ __('Actions') }}</th>
							</tr>
						</thead>
						<tbody>
							@forelse($total_appointments_today as $appointment)
							<tr>
								<td class="text-center">{{ $appointment->id }}</td>
								<td class="text-center">
									<a href="{{ route('patient.view', ['id' => $appointment->user_id]) }}"> {{ $appointment->User->name }} </a>
								</td>
								<td class="text-center">
									<label class="badge badge-primary-soft"><i class="far fa-calendar-check"></i> {{ $appointment->date->format('d M Y') }} </label>
								</td>
								<td class="text-center">
									<label class="badge badge-primary-soft"><i class="far fa-clock"></i> {{ $appointment->time_start }} - {{ $appointment->time_end }}</label>
								</td>
								<td class="text-center">
									@if($appointment->visited == 0)
									<label class="badge badge-warning-soft">
									<i class=" fas fa-user-clock"></i> {{ __('Not Yet Visited') }}
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
								<td class="text-center">{{ $appointment->created_at->format('d M Y H:i') }}</td>
								<td class="text-center">
									@if($appointment->date->isFuture())
									<a class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="{{ url('appointment/delete/'.$appointment->id) }}" data-toggle="tooltip" data-placement="top" title="{{ __('Send Notification To Patient') }}"><i class="far fa-bell"></i></a>
									@endif
									@can('edit appointment')
									<a data-rdv_id="{{ $appointment->id }}" data-rdv_date="{{ $appointment->date->format('d M Y') }}" data-rdv_time_start="{{ $appointment->time_start }}" data-rdv_time_end="{{ $appointment->time_end }}" data-patient_name="{{ $appointment->User->name }}" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#EDITRDVModal"><i class="fas fa-check"></i></a>
									@endcan
									@can('delete appointment')
									<a class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="{{ route('appointment.destroy', ['id' => $appointment->id]) }}"><i class="fas fa-trash"></i></a>    
									@endcan                  
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="7" class="text-center"><img src="{{ asset('img/rest.png') }} "/> <br><br> <b class="text-muted">{{ __('You have no appointment today') }}</b></td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endrole

@endsection
@section('header')
@endsection
@section('footer')
@endsection