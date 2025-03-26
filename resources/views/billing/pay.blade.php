@extends('layouts.'.Auth::user()->role.'_layout')

@section('title', __('Pay Invoice'))

@section('content')
<div class="row justify-content-center">
   <div class="col-md-8">
      <div class="card">

         <div class="card-header py-3">
            <div class="row">
               <div class="col">
                  <h6 class="m-0 font-weight-bold text-primary w-75">{{ __('Select payment option') }}</h6>
               </div>              
            </div>
         </div>
         <div class="card-body">
            <div class="row">
               @if(get_option('active_paypal') == 1)
               <div class="col-6">
                  <form  method="POST" id="payment-form" role="form" action="{{ route('paypal.create') }}">
                     @csrf
                     <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                     <button class="btn btn-white btn-sm w-100 border"><img src="{{ asset('img/gateway/paypal.png') }}" alt="Paypal" height="80"></button>
                  </form>
               </div>
               @endif
               @if(get_option('active_stripe') == 1)
               <div class="col-6">
                  <form action="{{ route('subscription.create') }}" method="POST">
                     <button class="btn btn-white btn-sm w-100 border"><img src="{{ asset('img/gateway/stripe.png') }}" alt="Stripe" height="80"></button>
                     @csrf
                     @php
                        $prix = $invoice->price+($invoice->price*get_option('taxe_rate')/100);
                     @endphp
                     <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                     <script
                        src="https://checkout.stripe.com/checkout.js" class="stripe-button" 
                        data-key="{{ get_option('stripe_key') }}"
                        data-amount="{{ $invoice->due_amount * 100 }}"
                        data-name="{{ get_option('system_name') }} {{ __('invoice') }}" 
                        data-description="{{ get_option('system_name') }}"
                        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                        data-locale="auto"
                        data-zip-code="false"></script>
       
                  </form>
               </div>
               @endif
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-4">
      <div class="card">
         <div class="card-header py-3">
            <div class="row">
               <div class="col">
                  <h6 class="m-0 font-weight-bold text-primary">{{ __('Invoice Summary') }}</h6>
               </div>              
            </div>
         </div>
         <div class="card-body p-3">
            <div class="stats mt-2">
               @forelse($billing_items as $items)
               <div class="d-flex justify-content-between p-price"><span>{{ $items->invoice_title }} </span><span>{{ formatCurrency($items->invoice_amount, get_option('currency_symbol'), get_option('currency_position')) }}</span></div>
               @empty

               @endforelse
            </div>
            <hr>
            <div class="d-flex justify-content-between font-weight-bold mt-3"><span>{{ __('Taxes') }} ({{ get_option('vat') }}%)</span><span>{{ formatCurrency(($items->invoice_amount * get_option('vat') / 100 ), get_option('currency_symbol'), get_option('currency_position')) }}</span></div>

            <div class="d-flex justify-content-between total font-weight-bold mt-2"><span>{{ __('Sub-Total') }}</span><span>{{ formatCurrency($invoice->total_without_tax, get_option('currency_symbol'), get_option('currency_position')) }}</span></div>
            <hr>
            <div class="d-flex justify-content-between total font-weight-bold mt-2"><span>{{ __('Total') }}</span><span>{{ formatCurrency($invoice->total_with_tax, get_option('currency_symbol'), get_option('currency_position')) }}</span></div>
         </div>
      </div>
   </div>
</div>

@endsection
@section('header')
<style type="text/css">
   .stripe-button-el{
      display: none !important;
   }
</style>
@endsection
@section('footer')
@endsection