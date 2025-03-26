@extends('layouts.'.Auth::user()->role.'_layout')
@section('title')
{{ __('All Patients') }}
@endsection
@section('content')
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<div class="row ">
			<div class="col-10">
				<h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('All Patients') }}</h6>
			</div>
			<div class="col-2">
				@can('add patient')
				<a href="{{ route('patient.create') }}" class="btn btn-outline-primary btn-sm float-right "><i class="fa fa-plus"></i> {{ __('New Patient') }}</a>
				@endcan
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr class="text-center">
						<th>{{ __('ID') }}</th>
						<th>{{ __('Patient Name') }}</th>
						<th>{{ __('Age') }}</th>
						<th>{{ __('Phone') }}</th>
						<th>{{ __('Blood Group') }}</th>
						<th>{{ __('Registered On') }}</th>
						<th>{{ __('Due Balance') }}</th>
						<th>{{ __('Prescriptions') }}</th>
						<th>{{ __('Actions') }}</th>
					</tr>
				</thead>
				<tbody>
					@forelse($patients as $patient)
					<tr class="text-center">
						<td>{{ $patient->id }} </td>
						<td><a href="{{ url('patient/view/'.$patient->id) }}"> {{ $patient->name }} </a></td>
						<td> {{ @\Carbon\Carbon::parse($patient->Patient->birthday)->age ?? __('N/A') }} </td>
						<td> {{ $patient->Patient->phone ?? __('N/A') }} </td>
						<td> {{ @$patient->Patient->blood ?? __('N/A') }} </td>
						<td><label class="badge badge-primary-soft">{{ $patient->created_at->format('d M Y H:i') }}</label></td>
						<td><label class="badge badge-primary-soft">{{ formatCurrency(Collect($patient->Billings)->where('payment_status','Partially Paid')->sum('due_amount'), get_option('currency_symbol'), get_option('currency_position')) }}</label></td>
						<td>
							@can('view patient')
							<a href="{{ route('prescription.view_for_user', ['id' => $patient->id]) }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-eye"></i> {{ __('View') }}</a>
							@endcan
						</td>
						<td>
							@can('view patient')
							<a href="{{ route('patient.view', ['id' => $patient->id]) }}" class="btn btn-outline-success btn-sm" data-toggle="tooltip" data-placement="top" title="{{ __('View Patient Profile') }}"><i class="fa fa-eye"></i></a>
							@endcan
							@can('edit patient')
							<a href="{{ route('patient.edit', ['id' => $patient->id]) }}" class="btn btn-outline-warning btn-sm" data-toggle="tooltip" data-placement="top" title="{{ __('Edit Patient') }}"><i class="fa fa-pen"></i></a>
							<a href="{{ route('patient.SendPassword', ['id' => $patient->id]) }}" class="btn btn-outline-info btn-sm" data-toggle="tooltip" data-placement="top" title="{{ __('Send New Credentials To Patient') }}"><i class="fa fa-key"></i></a>
							@endcan
							@can('delete patient')
							<a href="#" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="{{ route('patient.destroy' , ['id' => $patient->id ]) }}"><i class="fas fa-trash"></i></a>
							@endcan
						</td>
					</tr>
					@empty
					<tr class="text-center">
						<td colspan="9"><img src="{{ asset('img/rest.png') }} "/> <br><br> <b class="text-muted">{{ __('No patients found') }}, <a href="{{ route('patient.create') }}">Create new one</a></b>
						</td>
					</tr>
					@endforelse
				</tbody>
			</table>
			<span class="float-right mt-3">{{ $patients->links() }}</span>
		</div>
	</div>
</div>
@endsection