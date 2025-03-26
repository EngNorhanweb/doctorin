@extends('layouts.'.Auth::user()->role.'_layout')

@section('title')
{{ __('Payment Settings') }}
@endsection

@section('content')

<div class="row justify-content-center">
   <div class="col-md-10">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-dollar"></i> {{ __('Currency Options') }}</h6>
         </div>
         <div class="card-body">
            <form method="post" action="{{ route('payment_settings.store') }}">
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="currency">{{ __('Default Currency') }}</label>
                     <select name="currency" id="currency" class="form-control" data-live-search="true">
                        @foreach(get_currency_symbol() as $currencyName => $currencyData)
                        <option value="{{ $currencyName }}" @if($currencyData['ISO'] == get_option('currency')) selected @endif>{{ $currencyName }} - {{ $currencyData['ISO'] }} ({{ $currencyData['Symbol'] }})</option>
                        @endforeach
                     </select>
                     {{ csrf_field() }}
                  </div>
                  <div class="form-group col-md-6">
                     <label for="currency_position">{{ __('Currency position') }}</label>
                     <select name="currency_position" id="" class="select-control w-100">
                        <option value="left" @if(get_option('currency_position') == 'left') selected @endif>Left</option>
                        <option value="right" @if(get_option('currency_position') == 'right') selected @endif>Right</option>
                        <option value="left_with_space" @if(get_option('currency_position') == 'left_with_space') selected @endif>Left With Space</option>
                        <option value="right_with_space" @if(get_option('currency_position') == 'right_with_space') selected @endif>Right With Space</option>
                     </select>
                  </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="active_stripe">{{ __('VAT') }} (%)</label>
                     <input type="number" class="form-control" id="Currency" name="vat" value="{{ App\Setting::get_option('vat') }}" required>
                  </div>
               </div>
         </div>
      </div>
   </div>
</div>

<div class="row justify-content-center">
   <div class="col-md-10">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fab fa-stripe"></i> {{ __('Stripe') }}</h6>
         </div>
         <div class="card-body">
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="active_stripe">{{ __('Status') }}</label>
                     <select name="active_stripe" id="" class="select-control w-100">
                        <option value="1">Active</option>
                        <option value="0">Deactive</option>
                     </select>
                  </div>
                  <div class="form-group col-md-6">
                     <label for="stripe_mode">{{ __('Stripe Mode') }}</label>
                     <select name="stripe_mode" id="" class="select-control w-100">
                        <option value="sandbox" @if(get_option('stripe_key')) @endif>Test</option>
                        <option value="live">Live</option>
                     </select>
                  </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="stripe_secret">{{ __('Stripe Secret') }}</label>
                     <input type="text" class="form-control" id="stripe_secret" name="stripe_secret" value="{{ get_option('stripe_secret') }}">
                  </div>
                  <div class="form-group col-md-6">
                     <label for="stripe_key">{{ __('Stripe Key') }}</label>
                     <input type="text" class="form-control" id="stripe_key" name="stripe_key" value="{{ get_option('stripe_key') }}">
                  </div>
               </div>
         </div>
      </div>
   </div>
</div>

<div class="row justify-content-center">
   <div class="col-md-10">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fab fa-paypal"></i> {{ __('PayPal') }}</h6>
         </div>
         <div class="card-body">
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="active_paypal">{{ __('Status') }}</label>
                     <select name="active_paypal" id="" class="select-control w-100">
                        <option value="1">Active</option>
                        <option value="0">Deactive</option>
                     </select>
                  </div>
                  <div class="form-group col-md-6">
                     <label for="paypal_mode">{{ __('PayPal Mode') }}</label>
                     <select name="paypal_mode" id="" class="select-control w-100">
                        <option value="sandbox">Sandbox</option>
                        <option value="live">Live</option>
                     </select>
                  </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="paypal_client_id">{{ __('PayPal Client ID') }}</label>
                     <input type="text" class="form-control" id="paypal_client_id" name="paypal_client_id" value="{{ get_option('paypal_client_id') }}">
                  </div>
                  <div class="form-group col-md-6">
                     <label for="paypal_secret">{{ __('PayPal Secret') }}</label>
                     <input type="text" class="form-control" id="paypal_secret" name="paypal_secret" value="{{ get_option('paypal_secret') }}">
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-9">
                     <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection

@section('header')

@endsection

@section('footer')

@endsection