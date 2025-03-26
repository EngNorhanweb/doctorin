@extends('layouts.'.Auth::user()->role.'_layout')

@section('title')
{{ __('Dashboard') }}
@endsection
@section('content')

<div class="row">
   <div class="col-xl-3">
       <div class="card profile">
           <div class="card-body">
               <div class="text-center">
                  @empty(!Auth::user()->image)
                  <img src="{{ asset('uploads/'.Auth::user()->image) }}" alt="" class="rounded-circle img-thumbnail avatar-xl">
                  @else
                     <img src="{{ asset('img/patient-icon.png') }}" alt="" class="rounded-circle img-thumbnail avatar-xl">
                  @endempty
                   <div class="online-circle">
                       <i class="fa fa-circle text-success"></i>
                   </div>
                   <h4 class="mt-2">{{ Auth::user()->name }}</h4>
                   <a href="{{ route('patient.view', ['id' => Auth::user()->id]) }}" class="btn btn-doctorino btn-round px-3 btn-sm">{{ __('View Profile') }}</a>
                   <a href="{{ route('user.edit', ['id' => Auth::user()->id]) }}" class="btn btn-danger btn-round px-3 btn-sm"><i class="fa fa-pen"></i></a>
                   <ul class="list-unstyled list-inline mt-3 text-muted">
                       <li class="list-inline-item font-size-13 me-3">
                           <b class="text-dark">{{ Auth::user()->Appointment->count() }}</b> {{ __('Appointments') }}
                       </li>
                       <li class="list-inline-item font-size-13">
                           <b class="text-dark">{{ Auth::user()->Billings->count() }}</b> {{ __('Invoices') }}
                       </li>
                   </ul>
               </div>
           </div>
       </div>
       <!-- end card -->
   </div>
   <!-- end col -->

   <div class="col-xl-9">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<div class="row">
				<div class="col">
					<h6 class="m-0 font-weight-bold text-primary w-75 p-2"><i class="fas fa-calendar-alt mr-1"></i> {{ __('Latest Appointment') }}</h6>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table" id="dataTable" width="100%">
					<thead>
						<tr class="text-center">
							<th>ID</th>
							<th>{{ __('Date') }}</th>
							<th>{{ __('Time Slot') }}</th>
							<th>{{ __('Status') }}</th>
							<th>{{ __('Created at') }}</th>
						</tr>
					</thead>
					<tbody>
						@forelse($appointments as $appointment)
						<tr class="text-center">
							<td>{{ $appointment->id }}</td>
							<td>
								<label class="badge badge-primary-soft"><i class="far fa-calendar-check"></i> {{ $appointment->date->format('d M Y') }} </label>
							</td>
							<td>
								<label class="badge badge-primary-soft"><i class="far fa-clock"></i> {{ $appointment->time_start }} - {{ $appointment->time_end }}</label>
							</td>
							<td>
								@if($appointment->visited == 0)
								<label class="badge badge-warning-soft">
								<i class=" fas fa-user-clock"></i> {{ __('Not Yet Visited') }}
								</label>
								@elseif($appointment->visited == 1)
								<label class="badge badge-success-soft">
								<i class=" fas fa-user-check"></i> {{ __('Visited') }}
								</label>
								@else
								<label class="badge badge-danger-soft">
								<i class="fas fa-user-times"></i> {{ __('Cancelled') }}
								</label>
								@endif
							</td>
							<td>{{ $appointment->created_at->format('d M Y H:i') }}</td>
						</tr>
						@empty
						<tr class="text-center">
							<td colspan="7"><img src="{{ asset('img/rest.png') }} "/> <br><br> <b class="text-muted">{{ __('You have no appointment') }}</b></td>
						</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<div class="row">
				<div class="col">
					<h6 class="m-0 font-weight-bold text-primary w-75 p-2"><i class="fas fa-bell mr-1"></i> {{ __('Notifications') }}</h6>
				</div>
			</div>
		</div>
		<div class="card-body">
			@forelse($notifications as $notification)
			<div class="alert alert-{{ $notification->type }}">{{ $notification->content }}</div>
			@empty
			<div class="alert alert-info">{{ __('') }}</div>
			@endforelse
		</div>
	</div>
   </div>
   
</div>
@endsection
@section('header')
@endsection
@section('footer')
@endsection