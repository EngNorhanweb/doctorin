@extends('layouts.'.Auth::user()->role.'_layout')
@section('title')
{{ __('Create Invoice') }}
@endsection
@section('content')
<form method="post" action="{{ route('billing.store') }}">
	<div class="row justify-content-center">
		<div class="col-md-4">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">{{ __('Informations') }}</h6>
				</div>
				<div class="card-body">
					<div class="form-group">
						<label for="drug">{{ __('Select Patient') }}</label>
						<select class="form-control select2 select2-hidden-accessible" id="drug" tabindex="-1" name="patient_id" aria-hidden="true">
							<option></option>
							@foreach($patients as $patient)
							<option value="{{ $patient->id }}">{{ $patient->name }}</option>
							@endforeach
						</select>
						{{ csrf_field() }}
					</div>
					<div class="form-group">
						<label for="PaymentMode">{{ __('Payment Mode') }}</label>
						<select class="form-control" name="payment_mode" id="PaymentMode">
							<option value="Waiting">{{ __('Waiting Payment') }}</option>
							<option value="Cash">{{ __('Cash') }}</option>
							<option value="Cheque">{{ __('Cheque') }}</option>
						</select>
					</div>
					<div class="form-group">
						<label for="DepositedAmount">{{ __('Paid Amount') }}</label>
						<input class="form-control" type="number" name="deposited_amount" id="DepositedAmount">
					</div>
					<div class="form-group">
						<label for="DueAmount">{{ __('Due Amount') }}</label>
						<input class="form-control" type="number" name="due_amount" id="DueAmount" readonly>
					</div>
					<div class="form-group">
						<input type="submit" value="{{ __('Create Invoice') }}" class="btn btn-warning btn-block" align="center">
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">{{ __('Invoice Details') }}</h6>
				</div>
				<div class="card-body">
					<fieldset class="billing_labels">
						<div class="repeatable"></div>
						<div class="form-group">
							<a type="button" class="btn btn-primary btn-sm add text-white" align="center"><i class='fa fa-plus'></i> {{ __('Add Item') }}</a>
						</div>
					</fieldset>
					<span class="float-right">Total excl. tax : <b id="total_without_tax_income">0 </b> {{ get_option('currency_symbol') }}</span><br>
					<span class="float-right">VAT :  {{ get_option('vat') }} %</span><br>
					<span class="float-right">Total incl. tax : <b id="total_income">0 </b> {{ get_option('currency_symbol') }}</span>
				</div>
			</div>
		</div>
	</div>
</form>
@endsection
@section('footer')
<script type="text/template" id="billing_labels">
	<div class="field-group row">
	 <div class="col">
	    <div class="form-group-custom">
	       <input type="text" id="strength" name="invoice_title[]"  class="form-control" placeholder="{{ __('Invoice Title') }}" required>
	    </div>
	 </div>
	 <div class="col">
	    <div class="input-group mb-3">
	     <input type="number" class="form-control" placeholder="{{ __('Amount') }}" aria-label="Amount" aria-describedby="basic-addon1" name="invoice_amount[]" required>
	
	       <div class="input-group-append">
	          <span class="input-group-text" id="basic-addon1">{{ get_option('currency_symbol') }}</span>
	       </div>
	    </div>
	 </div>
	 <div class="col-md-3">
	    <a type="button" class="btn btn-danger btn-sm text-white span-2 delete"><i class="fa fa-times-circle"></i> {{ __('Remove') }}</a>
	 </div>
	</div>
</script>
<script type="text/javascript">
	setInterval(function(){
	
	$('.billing_labels').each(function(){
	  var totalPoints = 0;
	  var DepositedAmount = parseFloat($('#DepositedAmount').val());
	  var DueAmount = 0;
	  var vat = {{ get_option('vat') }};
	
	  $(this).find('input[aria-label="Amount"]').each(function(){
	      if($(this).val() !== ''){
	         totalPoints += parseFloat($(this).val()); //<==== a catch  in here !! read below
	      }
	  });
	
	      $('#total_without_tax_income').text(totalPoints);
	      $('#total_income').text(totalPoints+(totalPoints*vat/100));
	
	      if($('#DepositedAmount').val() !== ''){
	         $('#DueAmount').val((totalPoints+(totalPoints*vat/100))-DepositedAmount);
	      }else{
	         $('#DueAmount').val((totalPoints+(totalPoints*vat/100)));
	      }
	
	});
	
	}, 1000);
	
</script>
@endsection