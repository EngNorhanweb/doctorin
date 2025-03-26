@extends('layouts.'.Auth::user()->role.'_layout')

@section('title')
{{ __('Doctorino Settings') }}
@endsection

@section('content')

<div class="row justify-content-center">
   <div class="col-md-8">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Appointment Settings') }}</h6>
         </div>
         <div class="card-body">
            <form method="post" action="{{ route('appointment_settings.store') }}" enctype="multipart/form-data">
            

               <div class="form-group row">
                  <label for="appointment_interval" class="col-sm-3 col-form-label">{{ __('Appointment Interval') }}</label>
                  <div class="col-sm-9">
                     <select class="form-control" name="appointment_interval" id="appointment_interval" required>
                        <option value="{{ get_option('appointment_interval') }}">{{ get_option('appointment_interval') }} {{ __('minutes') }}</option>
                        <option value="10">10 {{ __('minutes') }}</option>
                        <option value="15">15 {{ __('minutes') }}</option>
                        <option value="20">20 {{ __('minutes') }}</option>
                        <option value="25">25 {{ __('minutes') }}</option>
                        <option value="30">30 {{ __('minutes') }}</option>
                        <option value="35">35 {{ __('minutes') }}</option>
                        <option value="40">40 {{ __('minutes') }}</option>
                        <option value="45">45 {{ __('minutes') }}</option>
                        <option value="50">50 {{ __('minutes') }}</option>
                        <option value="55">55 {{ __('minutes') }}</option>
                        <option value="60">60 {{ __('minutes') }}</option>
                     </select>
                     {{ csrf_field() }}
                     <small id="emailHelp" class="form-text text-muted">{{ __('Modifying the interval will distort the dates of the appointments') }}</small>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Saturday" class="col-sm-4 col-md-3 col-form-label">{{ __('Saturday') }}</label>
                  <div class="col-sm-4 col-md-4" >
                     <input type="time" class="form-control" id="Saturday" name="saturday_from" value="{{ get_option('saturday_from') }}">
                  </div>
                  <div class="col-sm-4 col-md-4">
                     <input type="time" class="form-control" id="Saturday" name="saturday_to" value="{{ get_option('saturday_to') }}">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Sunday" class="col-sm-4 col-md-3 col-form-label">{{ __('Sunday') }}</label>
                  <div class="col-sm-4 col-md-4" >
                     <input type="time" class="form-control" id="Sunday" name="sunday_from" value="{{ get_option('sunday_from') }}">
                  </div>
                  <div class="col-sm-4 col-md-4">
                     <input type="time" class="form-control" id="Sunday" name="sunday_to" value="{{ get_option('sunday_to') }}">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Monday" class="col-sm-4 col-md-3 col-form-label">{{ __('Monday') }}</label>
                  <div class="col-sm-4 col-md-4" >
                     <input type="time" class="form-control" id="Monday" name="monday_from" value="{{ get_option('monday_from') }}">
                  </div>
                  <div class="col-sm-4 col-md-4">
                     <input type="time" class="form-control" id="Monday" name="monday_to" value="{{ get_option('monday_to') }}">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Tuesday" class="col-sm-4 col-md-3 col-form-label">{{ __('Tuesday') }}</label>
                  <div class="col-sm-4 col-md-4" >
                     <input type="time" class="form-control" id="Tuesday" name="tuesday_from" value="{{ get_option('tuesday_from') }}">
                  </div>
                  <div class="col-sm-4 col-md-4">
                     <input type="time" class="form-control" id="Tuesday" name="tuesday_to" value="{{ get_option('tuesday_to') }}">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Wednseday" class="col-sm-4 col-md-3 col-form-label">{{ __('Wednseday') }}</label>
                  <div class="col-sm-4 col-md-4" >
                     <input type="time" class="form-control" id="Wednseday" name="wednesday_from" value="{{ get_option('wednesday_from') }}">
                  </div>
                  <div class="col-sm-4 col-md-4">
                     <input type="time" class="form-control" id="Wednseday" name="wednesday_to" value="{{ get_option('wednesday_to') }}">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Thurday" class="col-sm-4 col-md-3 col-form-label">{{ __('Thurday') }}</label>
                  <div class="col-sm-4 col-md-4" >
                     <input type="time" class="form-control" id="Thurday" name="thursday_from" value="{{ get_option('thursday_from') }}">
                  </div>
                  <div class="col-sm-4 col-md-4">
                     <input type="time" class="form-control" id="Thurday" name="thursday_to" value="{{ get_option('thursday_to') }}">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Friday" class="col-sm-4 col-md-3 col-form-label">{{ __('Friday') }}</label>
                  <div class="col-sm-4 col-md-4" >
                     <input type="time" class="form-control" id="Friday" name="friday_from" value="{{ get_option('friday_from') }}">
                  </div>
                  <div class="col-sm-4 col-md-4">
                     <input type="time" class="form-control" id="Friday" name="friday_to" value="{{ get_option('friday_to') }}">
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
<style type="text/css">
   input[type="file"] {
   display: none;
   }
   .custom-file-upload {
   border: 1px solid #ccc;
   display: inline-block;
   padding: 6px 12px;
   cursor: pointer;
   }
</style>
@endsection

@section('footer')

@endsection