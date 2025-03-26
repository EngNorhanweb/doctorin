@extends('layouts.'.Auth::user()->role.'_layout')

@section('title')
{{ __('Doctorino Settings') }}
@endsection

@section('content')

<div class="row justify-content-center">
   <div class="col-md-8">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Doctorino Settings') }}</h6>
         </div>
         <div class="card-body">
            <form method="post" action="{{ route('doctorino_settings.store') }}" enctype="multipart/form-data">
               <div class="form-group row">
                  <label for="system_name" class="col-sm-3 col-form-label">{{ __('System Name') }} </label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="system_name" name="system_name" value="{{ get_option('system_name') }}" required>
                     {{ csrf_field() }}
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Title" class="col-sm-3 col-form-label">{{ __('Docteur Name') }}</label>
                  <div class="col-sm-9">
                     <input type="title" class="form-control" id="Title" name="title" value="{{ get_option('title') }}" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="logo" class="col-sm-3 col-form-label">{{ __('Logo') }}</label>
                  <div class="col-sm-9">
                     <label for="file-upload" class="custom-file-upload w-100">
                     <i class="fa fa-cloud-upload"></i> Select Logo to Upload
                     </label>
                     <input type="file" class="form-control" id="file-upload" name="logo">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Address" class="col-sm-3 col-form-label">{{ __('Address') }}</label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="Address" name="address" value="{{ get_option('address') }}" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Phone" class="col-sm-3 col-form-label">{{ __('Phone') }} </label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="Phone" name="phone" value="{{ get_option('phone') }}" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="hospital_email" class="col-sm-3 col-form-label">{{ __('Hospital Email') }}</label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="hospital_email" name="hospital_email" value="{{ get_option('hospital_email') }}" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="Language" class="col-sm-3 col-form-label">{{ __('Language') }}</label>
                  <div class="col-sm-9">
                     <select class="form-control" name="language" id="Language" required>
                        <option value="{{ get_option('language') }}">{{ $language[get_option('language')] }}</option>
                        <option value="en">English</option>
                        <option value="es">Spanish</option>
                        <option value="fr">French</option>
                        <option value="de">Dutch</option>
                        <option value="it">Italian</option>
                        <option value="pt">Portuguese</option>
                        <option value="in">Hindi</option>
                        <option value="bn">Bengali</option>
                        <option value="id">Indonesian</option>
                        <option value="tr">Turkish</option>
                        <option value="ru">Russian</option>
                        <option value="ar">Arabic</option>
                     </select>
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