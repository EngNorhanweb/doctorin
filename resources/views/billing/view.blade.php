@extends('layouts.'.Auth::user()->role.'_layout')
@section('title')
{{ __('View billing') }}
@endsection
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"></h1>
	@can('print invoice')
	<button href="" class="d-none d-sm-inline-block btn btn-sm btn-outline-primary print_prescription"><i class="fas fa-print fa-sm"></i> {{ __('Print') }}</button>
	@endcan
</div>
<div class="row justify-content-center" id="stylesheetd">
	<div class="col-10">
		<div class="card shadow mb-4">
			<div class="card-body">
				<!-- ROW : Doctor informations -->
				<div class="row">
					<div class="col font-size-13">
						@if(!empty(get_option('logo')))
						<img src="{{ asset('uploads/'.get_option('logo')) }}"><br><br>
						@endif
						{!! clean(get_option('header_left')) !!}
					</div>
					<div class="col-3 font-size-13">
						<p>
							<b>{{ __('Date') }} :</b> {{ $billing->created_at->format('d M Y') }}<br>
							<b>{{ __('Reference') }} :</b> {{ $billing->reference }}<br>
							<b>{{ __('Patient Name') }} :</b> {{ $billing->User->name }}
						</p>
					</div>
				</div>
				<!-- END ROW : Doctor informations -->
				<!-- ROW : Drugs List -->
				<div class="row justify-content-center">
					<div class="col">
						<h5 class="text-center mt-5"><b>{{ __('Invoice') }}</b></h5>
						<br><br>
						<table class="table">
							<tr style="background: #2e3f50; color: #fff;">
								<td width="10%">#</td>
								<td width="60%">{{ __('Item') }}</td>
								<td width="30%" align="center">{{ __('Amount') }}</td>
							</tr>
							@forelse ($billing_items as $key => $billing_item)
							<tr>
								<td>{{ $key+1 }}</td>
								<td>{{ $billing_item->invoice_title }}</td>
								<td align="center">{{ formatCurrency($billing_item->invoice_amount, get_option('currency_symbol'), get_option('currency_position')) }}</td>
							</tr>
							@empty
							<tr>
								<td colspan="3">{{ __('Empty Invoice') }}</td>
							</tr>
							@endforelse
							@empty(!$billing_item)
							@if(get_option('vat') > 0)
							<tr>
								<td colspan="2"><strong class="float-right">{{ __('Sub-Total') }}</strong></td>
								<td align="center"><strong>{{ formatCurrency($billing_items->sum('invoice_amount'), get_option('currency_symbol'), get_option('currency_position')) }}</strong></td>
							</tr>
							<tr>
								<td colspan="2"><strong class="float-right">{{ __('VAT') }} ({{ get_option('vat') }}%)</strong></td>
								<td align="center"><strong>{{ formatCurrency(($billing_items->sum('invoice_amount') * get_option('vat')/100), get_option('currency_symbol'), get_option('currency_position')) }}</strong></td>
							</tr>
							@endif
							<tr>
								<td colspan="2"><strong class="float-right">{{ __('Total') }}</strong></td>
								<td align="center"><strong>{{ formatCurrency($billing_items->sum('invoice_amount') + ($billing_items->sum('invoice_amount') * get_option('vat')/100), get_option('currency_symbol'), get_option('currency_position')) }}</strong></td>
							</tr>
							@endempty
						</table>
					</div>
				</div>
				<div style="margin-bottom: 250px;"></div>
				<!-- END ROW : Drugs List -->
				<!-- ROW : Footer informations -->
				<div class="row">
					<div class="col">
						<p class="font-size-12">{!! clean(get_option('footer_left')) !!}</p>
					</div>
					<div class="col">
						<p class="float-right font-size-12">{!! clean(get_option('footer_right')) !!}</p>
					</div>
				</div>
				<!-- END ROW : Footer informations -->
			</div>
		</div>
	</div>
</div>
<!-- Hidden invoice -->
<div id="print_area" style="display: none;">
	<div class="row">
		<div class="col-9">
			@if(!empty(get_option('logo')))
			<img src="{{ asset('uploads/'.get_option('logo')) }}"><br><br>
			@endif
			{!! clean(get_option('header_left')) !!}
		</div>
		<div class="col-3">
			<p class="float-right"><b>{{ __('Date') }} :</b> {{ $billing->created_at->format('d M Y') }}<br>
				<b>{{ __('Reference') }} :</b> {{ $billing->reference }}<br>
				<b>{{ __('Patient Name') }} :</b> {{ $billing->User->name }}
			</p>
		</div>
	</div>
	<!-- END ROW : Doctor informations -->
	<!-- ROW : Drugs List -->
	<div class="row justify-content-center">
		<div class="col">
			<h5 class="text-center mt-5"><b>{{ __('Invoice') }}</b></h5>
			<br><br>
			<table class="table">
				<tr >
					<td width="10%"><b>#</b></td>
					<td width="60%"><b>{{ __('Item') }}</b></td>
					<td width="30%" align="center"><b style="font-weight:bold;">{{ __('Amount') }}</b></td>
				</tr>
				@forelse ($billing_items as $key => $billing_item)
				<tr>
					<td>{{ $key+1 }}</td>
					<td>{{ $billing_item->invoice_title }}</td>
					<td align="center">{{ $billing_item->invoice_amount }} {{ get_option('currency') }}</td>
				</tr>
				@empty
				<tr>
					<td colspan="3">{{ __('Empty Invoice') }}</td>
				</tr>
				@endforelse
				@empty(!$billing_item)
				@if(get_option('vat') > 0)
				<tr>
					<td colspan="2"><strong class="float-right">{{ __('Sub-Total') }}</strong></td>
					<td align="center"><strong>{{ formatCurrency($billing_items->sum('invoice_amount'), get_option('currency_symbol'), get_option('currency_position')) }}</strong></td>
				</tr>
				<tr>
					<td colspan="2"><strong class="float-right">{{ __('VAT') }} ({{ get_option('vat') }}%)</strong></td>
					<td align="center"><strong>{{ formatCurrency(($billing_items->sum('invoice_amount') * get_option('vat')/100), get_option('currency_symbol'), get_option('currency_position')) }}</strong></td>
				</tr>
				@endif
				<tr>
					<td colspan="2"><strong class="float-right">{{ __('Total') }}</strong></td>
					<td align="center"><strong>{{ formatCurrency($billing_items->sum('invoice_amount') + ($billing_items->sum('invoice_amount') * get_option('vat')/100), get_option('currency_symbol'), get_option('currency_position')) }}</strong></td>
				</tr>
				@endempty
			</table>
			<hr>
		</div>
	</div>
	<!-- END ROW : Drugs List -->
	<!-- ROW : Footer informations -->
	<footer class="footer-nassim" style="position: absolute; bottom: 0;">
		<hr>
		<div class="row">
			<div class="col-6">
				<p class="font-size-12">{!! clean(get_option('footer_left')) !!}</p>
			</div>
			<div class="col-6">
				<p class="float-right font-size-12">{!! clean(get_option('footer_right')) !!}</p>
			</div>
		</div>
		<!-- END ROW : Footer informations -->
	</footer>
</div>
@endsection
@section('header')
<link href="{{ asset('css/print.css') }}" rel="stylesheet"  media="all">
<style type="text/css">
	p, u, li {
	color: #444444 !important; 
	}
</style>
@endsection
@section('footer')
<script type="text/javascript">
	function PrintPreview(divName) {
	   
	  var printContents = document.getElementById(divName).innerHTML;
	  var originalContents = document.body.innerHTML;
	
	  document.body.innerHTML = printContents;
	
	  window.print();
	
	  document.body.innerHTML = originalContents;
	}
	
	
	$(function(){
	  $(document).on("click", '.print_prescription',function () {
	     PrintPreview('print_area');
	     /* 
	     $('#print_area').printThis({
	      importCSS: true,
	             importStyle: true,//thrown in for extra measure 
	      loadCSS: "{{ asset('dashboard/css/sb-admin-2.min.css') }}",
	      pageTitle: "xxx", 
	      copyTagClasses: true, 
	       base: true, 
	       printContainer: true, 
	       removeInline: false,  
	     });
	     */
	
	   });
	});
</script>
@endsection