@extends('layouts.'.Auth::user()->role.'_layout')

@section('title')
{{ __('All Invoices') }}
@endsection
@section('content')

<div class="card shadow mb-4">
	<div class="card-header py-3">
		<div class="row">
			<div class="col-6">
				<h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('All Invoices') }}</h6>
			</div>
			<div class="col-6">
				@can('create invoice')
				<a href="{{ route('billing.create') }}" class="btn btn-outline-primary btn-sm float-right"><i class="fa fa-plus"></i> {{ __('Create Invoice') }}</a>
				@endcan
				<a href="{{ route('billing.unpaid') }}" class="btn btn-danger btn-sm float-right mr-2"><i class="fas fa-hourglass-start"></i> {{ __('Unpaid') }}</a>
				<a href="{{ route('billing.partially_paid') }}" class="btn btn-warning btn-sm float-right mr-2"><i class="fas fa-hourglass-start"></i> {{ __('Partially Paid') }}</a>
				<a href="{{ route('billing.paid') }}" class="btn btn-success btn-sm float-right mr-2"><i class="fas fa-check"></i> {{ __('Paid') }}</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr class="text-center">
						<th>{{ __('Reference') }}</th>
						<th>{{ __('Patient') }}</th>
						<th>{{ __('Date') }}</th>
						<th>{{ __('Amount') }} - <span class="text-danger">{{ __('Due Balance') }}</span></th>
						<th>{{ __('Status') }}</th>
						<th>{{ __('Payment Method') }}</th>
						<th>{{ __('Transaction Number') }}</th>
						<th>{{ __('Actions') }}</th>
					</tr>
				</thead>
				<tbody>
					@forelse($invoices as $invoice)
					<tr class="text-center">
						<td>{{ $invoice->reference }}</td>
						<td><a href="{{ url('patient/view/'.$invoice->user_id) }}"> {{ $invoice->User->name }} </a></td>
						<td>{{ $invoice->created_at->format('d M Y') }}</td>
						<td> {{ formatCurrency($invoice->total_with_tax, get_option('currency_symbol'), get_option('currency_position')) }}
							@if($invoice->payment_status == 'Unpaid' OR $invoice->payment_status == 'Partially Paid')
							<label class="badge badge-danger-soft">{{ formatCurrency($invoice->due_amount, get_option('currency_symbol'), get_option('currency_position')) }} </label>
							@endif
						</td>
						<td>
							@if($invoice->payment_status == 'Unpaid')
							<label class="badge badge-danger-soft">
							<i class="fas fa-hourglass-start"></i> {{ __('Unpaid') }}
							</label>
							@elseif($invoice->payment_status == 'Paid')
							<label class="badge badge-success-soft">
							<i class="fas fa-check"></i> {{ __('Paid') }}
							</label>
							@elseif($invoice->payment_status == 'Partially Paid')
							<label class="badge badge-warning-soft">
							<i class="fas fa-hourglass-start"></i> {{ __('Partially Paid') }}
							</label>
							@else
							@endif
						</td>
						<td><label class="badge badge-primary-soft">
								@if($invoice->payment_mode == 'Cash' || $invoice->payment_mode == 'Cash') 
								<i class="fa fa-handshake"></i> 
								@elseif($invoice->payment_mode == 'Stripe')
								<i class="fab fa-stripe"></i> 
								@elseif($invoice->payment_mode == 'PayPal')
								<i class="fab fa-paypal"></i> 
								@else
								<i class="fa fa-handshake"></i> 
								@endif
								{{ $invoice->payment_mode }}
							</label>
						</td>

						<td><label class="badge badge-danger-soft">{{ @$invoice->Transaction->transaction_id ?? __('N/A') }}</label></td>
						<td>
							@can('view invoice')
							<a href="{{ route('billing.view', ['id' => $invoice->id]) }}" class="btn btn-outline-success btn-sm"><i class="fa fa-eye"></i></a>
							@endcan
							@can('edit invoice')
							<a href="{{ route('billing.edit', ['id' => $invoice->id]) }}" class="btn btn-outline-warning btn-sm"><i class="fas fa-pen"></i></a>
							@endcan
							@can('delete invoice')
							<a data-toggle="modal" data-target="#DeleteModal" data-link="{{ route('billing.destroy', ['id' => $invoice->id]) }}" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></a>
							@endcan
							@if(Auth::user()->role == 'patient' && $invoice->payment_status != 'Paid')
							<a href="{{ route('billing.pay', ['ref' => $invoice->reference]) }}" class="btn btn-outline-danger btn-sm">Pay Now</a>
							@endif
						</td>
					</tr>
					@empty
					<tr class="text-center">
						<td colspan="8">{{ __('No invoices found') }}</td>
					</tr>
					@endforelse
				</tbody>
			</table>
			<span class="float-right mt-3">{{ $invoices->links() }}</span>
		</div>
	</div>
</div>
@endsection