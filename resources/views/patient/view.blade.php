@extends('layouts.'.Auth::user()->role.'_layout')
@section('title')
{{ $patient->name }}
@endsection
@section('content')
<div class="row justify-content-center">
	<div class="col">
		<div class="card shadow mb-4">
			<div class="card-body">
				<div class="row">
					<div class="col-md-3 col-sm-6">
						<div class="card profile">
							<div class="card-body">
								<div class="text-center">
									@empty(!$patient->image)
									<img src="{{ asset('uploads/'.$patient->image) }}" alt="" class="rounded-circle img-thumbnail avatar-xl">
									@else
									<img src="{{ asset('img/patient-icon.png') }}" alt="" class="rounded-circle img-thumbnail avatar-xl">
									@endempty
									<div class="online-circle">
										<i class="fa fa-circle text-success"></i>
									</div>
									<h4 class="mt-2">{{ $patient->name }}</h4>
									
									@can('edit patient')
									<a href="{{ route('patient.SendPassword', ['id' => $patient->id]) }}" class="btn btn-doctorino btn-sm btn-round px-3"> {{ __('Send Credentials') }}</a>
									@endcan
									@if(auth()->user()->can('edit patient') || $patient->id == Auth::user()->id)
									<a href="{{ route('patient.edit', ['id' => $patient->id]) }}" class="btn btn-danger btn-sm btn-round px-3"> <i class="fa fa-pen"></i></a>
									@endif
									<ul class="list-unstyled list-inline mt-3 text-muted">
										<li class="list-inline-item font-size-13 me-3">
											<strong class="text-dark">{{ $appointments->count() }}</strong> {{ __('Appointments') }}
										</li>
										<li class="list-inline-item font-size-13">
											<strong class="text-dark">{{ $invoices->count() }}</strong> {{ __('Invoices') }}
										</li>
									</ul>
								</div>
							</div>
						</div>
						<!-- end card -->
						<div class="table-responsive mt-2">
							<table class="table table-striped mb-0">
								<tbody>
									<tr>
										<th scope="row">{{ __('Contact No') }}:</th>
										<td> {{ $patient->Patient->phone ?? __('N/A') }} </td>
									</tr>
									<tr>
										<th scope="row">{{ __('Email') }}:</th>
										<td> {{ $patient->email ?? __('N/A') }} </td>
									</tr>
									<tr>
										<th scope="row">{{ __('Age') }}:</th>
										<td> {{ \Carbon\Carbon::parse($patient->Patient->birthday)->age }}</td>
									</tr>
									<tr>
										<th scope="row">{{ __('Gender') }}:</th>
										<td> {{ __($patient->Patient->gender) ?? __('N/A') }} </td>
									</tr>
									<tr>
										<th scope="row">{{ __('Address') }}:</th>
										<td> {{ $patient->Patient->adress ?? __('N/A') }} </td>
									</tr>
									<tr>
										<th scope="row">{{ __('Blood Group') }}:</th>
										<td> {{ $patient->Patient->blood ?? __('N/A') }} </td>
									</tr>
									<tr>
										<th scope="row">{{ __('Weight') }}:</th>
										<td> {{ $patient->Patient->weight ?? __('N/A') }} </td>
									</tr>
									<tr>
										<th scope="row">{{ __('Height') }}:</th>
										<td> {{ $patient->Patient->height ?? __('N/A') }} </td>
									</tr>
									<tr>
										<th scope="row">{{ __('Registered On') }}:</th>
										<td> {{ $patient->created_at ?? __('N/A') }} </td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-md-9 col-sm-6">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
								<a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="Profile" aria-selected="true">{{ __('Health History') }}</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="documents-tab" data-toggle="tab" href="#documents" role="tab" aria-controls="documents" aria-selected="false">{{ __('Medical Files') }}</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="appointements-tab" data-toggle="tab" href="#appointements" role="tab" aria-controls="appointements" aria-selected="false">{{ __('Appointments') }}</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="prescriptions-tab" data-toggle="tab" href="#prescriptions" role="tab" aria-controls="prescriptions" aria-selected="false">{{ __('Prescriptions') }}</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="Billing-tab" data-toggle="tab" href="#Billing" role="tab" aria-controls="Billing" aria-selected="false">{{ __('Payment History') }}</a>
							</li>
						</ul>
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
							
								<div class="row my-4">
									<div class="col">
										<div class="card ">
											<div class="card-body">
												<form method="post" action="{{ route('history.store') }}">
														<div class="mb-1">
														<textarea name="note" class="form-control" rows="2" placeholder="{{ __('eg. blood pressure, medical background ...') }}"></textarea>
														<input type="hidden" name="patient_id" value="{{ $patient->id }}">
														{{ csrf_field() }}
													</div>
													<button type="submit" class="btn btn-outline-primary w-lg mt-2 px-4">{{ __('Save') }}</button>
												</form>
											</div>
										</div>
										<!-- end card -->
									</div>
								</div>
								@forelse($historys as $history)
								<div class="alert alert-info">
									<p class="text- font-size-12">
										{!! clean($history->title) !!} {{ $history->created_at }}
										@can('delete health history')
										<span class="float-right"><i class="fa fa-trash"  data-toggle="modal" data-target="#DeleteModal" data-link="{{ route('history.destroy', ['id' => $history->id]) }}"></i></span>
										@endcan
									</p>
									<p>{!!  clean($history->note) !!}</p>
								</div>
								@empty
								<div class="text-center mt-3"><img src="{{ asset('img/not-found.svg') }}" width="200" /> <br><br> <strong class="text-muted">{{ __('No health history was found') }}</strong></div>
								@endforelse
							</div>
							<div class="tab-pane fade" id="appointements" role="tabpanel" aria-labelledby="appointements-tab">
								<div class="row">
									<div class="col">
										@can('create appointment')
										<a type="button" class="btn btn-outline-primary btn-sm my-4 float-right" href="{{ route('appointment.create') }}"><i class="fa fa-plus mr-1"></i> {{ __('New Appointment') }}</a>
										@endif
									</div>
								</div>
								<table class="table mt-3">
									<tr class="text-center">
										<th>Id</th>
										<th>{{ __('Date') }}</th>
										<th>{{ __('Time Slot') }}</th>
										<th>{{ __('Status') }}</th>
										<th>{{ __('Actions') }}</th>
									</tr>
									@forelse($appointments as $appointment)
									<tr class="text-center">
										<td>{{ $appointment->id }} </td>
										<td><label class="badge badge-primary-soft"><i class="far fa-calendar"></i> {{ $appointment->date->format('d M Y') }} </label></td>
										<td><label class="badge badge-primary-soft"><i class="far fa-clock"></i> {{ $appointment->time_start }} - {{ $appointment->time_end }} </label></td>
										<td>
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
										<td>
											@can('edit appointment')
											@if($appointment->date->isFuture() and $appointment->visited == 0)
											<a class="btn btn-outline-info btn-sm"  href="{{ route('appointment.notify.whatsapp', ['id' => $appointment->id]) }}" data-toggle="tooltip" data-placement="top" title="{{ __('Send Notification To Patient') }}"><i class="fab fa-whatsapp"></i></a>
											<a class="btn btn-outline-info btn-sm"  href="{{ route('appointment.notify.email', ['id' => $appointment->id]) }}" data-toggle="tooltip" data-placement="top" title="{{ __('Send Notification To Patient') }}"><i class="far fa-envelope"></i></a>
											@endif
											@endcan
											@can('edit appointment')
											<a data-rdv_id="{{ $appointment->id }}" data-rdv_date="{{ $appointment->date->format('d M Y') }}" data-rdv_time_start="{{ $appointment->time_start }}" data-rdv_time_end="{{ $appointment->time_end }}" data-patient_name="{{ $appointment->User->name }}" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#EDITRDVModal"><i class="fas fa-check"></i></a>
											@endcan
											@can('delete appointment')
											<a href="{{ route('appointment.destroy', ['id' => $appointment->id]) }}" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></a>
											@endcan
										</td>
									</tr>
									@empty
									<tr class="text-center">
										<td colspan="5"><img src="{{ asset('img/not-found.svg') }}" width="200" /> <br><br> <strong class="text-muted">{{ __('No appointment available') }}</strong></td>
									</tr>
									@endforelse
								</table>
							</div>
							<div class="tab-pane fade" id="prescriptions" role="tabpanel" aria-labelledby="prescriptions-tab">
								<div class="row">
									<div class="col">
										@can('create prescription')
										<a class="btn btn-outline-primary btn-sm my-4 float-right" href="{{ route('prescription.create')}}"><i class="fa fa-pen mr-1"></i> {{ __('Write New Prescription') }}</a>
										@endcan
									</div>
								</div>
								<table class="table mt-3">
									<tr class="text-center">
										<th>{{ __('Reference') }}</th>
										<th>{{ __('Content') }}</th>
										<th>{{ __('Created at') }}</th>
										<th>{{ __('Actions') }}</th>
									</tr>
									@forelse($prescriptions as $prescription)
									<tr class="text-center">
										<td>{{ $prescription->reference }} </td>
										<td> 
											<label class="badge badge-primary-soft">
											{{ count($prescription->Drug) }} Drugs
											</label>
											<label class="badge badge-primary-soft">
											{{ count($prescription->Test) }} Tests
											</label> 
										</td>
										<td><label class="badge badge-primary-soft">{{ $prescription->created_at }}</label></td>
										<td>
											@can('view prescription')
											<a href="{{ route('prescription.view', ['id' => $prescription->id]) }}" class="btn btn-outline-success btn-sm"><i class="fa fa-eye"></i></a>
											@endcan
											@can('edit prescription')
											<a href="{{ route('prescription.edit', ['id' => $prescription->id]) }}" class="btn btn-outline-warning btn-sm"><i class="fas fa-pen"></i></a>
											@endcan
											@can('delete prescription')
											<a href="#" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="{{ route('prescription.destroy', ['id' => $prescription->id]) }}"><i class="fas fa-trash"></i></a>
											@endcan
										</td>
									</tr>
									@empty
									<tr class="text-center">
										<td colspan="4"> <img src="{{ asset('img/not-found.svg') }}" width="200" /> <br><br> <strong class="text-muted"> {{ __('No prescription available') }}</strong></td>
									</tr>
									@endforelse
								</table>
							</div>
							<div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
								<div class="row">
									<div class="col">
										@can('edit patient')
										<button type="button" class="btn btn-outline-primary btn-sm my-4 float-right" data-toggle="modal" data-target="#NewDocumentModel"><i class="fa fa-plus mr-1"></i> {{ __('Add New') }}</button>
										@endcan
									</div>
								</div>
								<div class="row mt-3">
									@forelse($documents as $document)
									<div class="col-md-4">
										<div class="card">
											@if($document->document_type == "pdf")
											<img src="{{ asset('img/pdf.jpg') }}" class="card-img-top" >
											@elseif($document->document_type == "docx")
											<img src="{{ asset('img/docx.png') }}" class="card-img-top" >
											@elseif($document->document_type == "MSG")
											<img src="{{ asset('img/msg.png') }}" class="card-img-top" >
											@elseif($document->document_type == "doc")
											<img src="{{ asset('img/docx.png') }}" class="card-img-top" >
											@elseif($document->document_type == "msg")
											<img src="{{ asset('img/msg.png') }}" class="card-img-top" >
											@elseif($document->document_type == "xlsx")
											<img src="{{ asset('img/xlsx.png') }}" class="card-img-top" >
											@elseif($document->document_type == "xls")
											<img src="{{ asset('img/xlsx.png') }}" class="card-img-top" >
											@elseif($document->document_type == "ppt")
											<img src="{{ asset('img/pptx.png') }}" class="card-img-top" >
											@elseif($document->document_type == "pptx")
											<img src="{{ asset('img/pptx.png') }}" class="card-img-top" >
											@else
											<a class="example-image-link" href="{{ url('/uploads/'.$document->file) }}" data-lightbox="example-1">
											<img src="{{ url('/uploads/'.$document->file) }}" class="card-img-top" width="209" height="209"></a>
											@endif
											<div class="card-body">
												<h5 class="style1">{{ $document->title }}</h5>
												<p class="font-size-12">{{ $document->note }}</p>
												<p class="font-size-11"><label class="badge badge-primary-soft">{{ $document->created_at }}</label></p>
												<a href="{{ url('/uploads/'.$document->file) }}" class="btn btn-primary btn-sm" download><i class="fa fa-cloud-download-alt"></i> {{ __('Download') }}</a>
												<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="{{ url('document/delete/'.$document->id) }}"><i class="fa fa-trash"></i></a>
											</div>
										</div>
									</div>
									@empty
									<div class="col text-center">
										<div class="text-center mt-3"><img src="{{ asset('img/not-found.svg') }}" width="200" /> <br><br> <strong class="text-muted"> {{ __('No document available') }} </strong></div>
									</div>
									@endforelse
								</div>
							</div>
							<div class="tab-pane fade" id="Billing" role="tabpanel" aria-labelledby="Billing-tab">
								<div class="row mt-4">
									<div class="col-lg-4 mb-4">
										<div class="card bg-primary text-white shadow">
											<div class="card-body">
												{{ __('Total With Tax') }}
												<div class="text-white small">{{ formatCurrency(Collect($invoices)->sum('total_with_tax'), get_option('currency_symbol'), get_option('currency_position')) }}</div>
											</div>
										</div>
									</div>
									<div class="col-lg-4 mb-4">
										<div class="card bg-success text-white shadow">
											<div class="card-body">
												{{ __('Already Paid') }}
												<div class="text-white small">{{ formatCurrency(Collect($invoices)->sum('deposited_amount'), get_option('currency_symbol'), get_option('currency_position')) }}</div>
											</div>
										</div>
									</div>
									<div class="col-lg-4 mb-4">
										<div class="card bg-danger text-white shadow">
											<div class="card-body">
												{{ __('Due Balance') }}
												<div class="text-white small">{{ formatCurrency(Collect($invoices)->where('payment_status','Partially Paid')->sum('due_amount'), get_option('currency_symbol'), get_option('currency_position')) }}</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col">
										@can('create invoice')
										<a type="button" class="btn btn-outline-primary btn-sm my-4 float-right" href="{{ route('billing.create') }}"><i class="fa fa-plus mr-1"></i> {{ __('Create Invoice') }}</a>
										@endcan
									</div>
								</div>
								<table class="table mt-3">
									<tr class="text-center">
										<th>{{ __('Invoice') }}</th>
										<th>{{ __('Date') }}</th>
										<th>{{ __('Amount') }}</th>
										<th>{{ __('Status') }}</th>
										<th>{{ __('Transaction Number') }}</th>
										<th>{{ __('Actions') }}</th>
									</tr>
									@forelse($invoices as $invoice)
									<tr class="text-center">
										<td><a href="{{ route('billing.view', ['id' => $invoice->id]) }}">{{ $invoice->reference }}</a></td>
										<td><label class="badge badge-primary-soft">{{ $invoice->created_at->format('d M Y') }}</label></td>
										<td> {{ formatCurrency($invoice->total_with_tax, get_option('currency_symbol'), get_option('currency_position')) }}
											@if($invoice->payment_status == 'Unpaid' OR $invoice->payment_status == 'Partially Paid')
											<label class="badge badge-danger-soft">{{ formatCurrency($invoice->due_amount, get_option('currency_symbol'), get_option('currency_position')) }} </label>
											@endif
										</td>
										<td>
											@if($invoice->payment_status == 'Unpaid')
											<label class="badge badge-danger-soft">
											<i class="fas fa-hourglass-start"></i>
											{{ __('Unpaid') }}
											</label>
											@elseif($invoice->payment_status == 'Paid')
											<label class="badge badge-success-soft">
											<i class="fas fa-check"></i> {{ __('Paid') }}
											</label>
											@else
											<label class="badge badge-warning-soft">
											<i class="fas fa-user-times"></i>
											{{ __('Partially Paid') }}
											</label>
											@endif
										</td>
										<td><label class="badge badge-danger-soft">{{ @$invoice->Transaction->transaction_id ?? 'N/A' }}</label></td>
										<td>
											@can('view invoice')
											<a href="{{ route('billing.view', ['id' => $invoice->id]) }}" class="btn btn-outline-success btn-sm"><i class="fa fa-eye"></i></a>
											@endcan
											@can('edit invoice')
											<a href="{{ route('billing.edit', ['id' => $invoice->id]) }}" class="btn btn-outline-warning btn-sm"><i class="fas fa-pen"></i></a>
											@endcan
											@can('delete invoice')
											<a href="{{ route('billing.destroy', ['id' => $invoice->id]) }}" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></a>
											@endcan
											@if(Auth::user()->role == 'patient' && $invoice->payment_status != 'Paid')
											<a href="{{ route('billing.pay', ['ref' => $invoice->reference]) }}" class="btn btn-outline-danger btn-sm">{{ __('Pay Now') }}</a>
											@endif
										</td>
									</tr>
									@empty
									<tr class="text-center">
										<td colspan="6"><img src="{{ asset('img/not-found.svg') }}" width="200" /> <br><br> <strong class="text-muted">{{ __('No Invoices Available') }}</strong></td>
									</tr>
									@endforelse
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--Document Modal -->
<div id="NewDocumentModel" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">{{ __('Add File / Note') }}</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
				</button>
			</div>
			<form method="post" action="{{ route('document.store') }}" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="row">
						<div class="col">
							<input type="text" class="form-control" name="title" placeholder="{{ __('Title') }}" required>
							<input type="hidden" name="patient_id" value="{{ $patient->id }}">
							{{ csrf_field() }}
						</div>
						<div class="col">
							<input type="file" class="form-control-file" name="file" id="exampleFormControlFile1" required>
						</div>
					</div>
					<div class="row mt-2">
						<div class="col">
							<textarea class="form-control" name="note" placeholder="{{ __('Note') }}"></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">{{ __('Close') }}</button>
					<button class="btn btn-outline-primary" type="submit">{{ __('Save') }}</button>
			</form>
			</div>
		</div>
	</div>

@endsection
@section('header')
<link rel="stylesheet" href="{{ asset('dashboard/css/lightbox.css') }}" />
@endsection
@section('footer')
<script type="text/javascript" src="{{ asset('dashboard/js/lightbox.js') }}"></script>
@endsection