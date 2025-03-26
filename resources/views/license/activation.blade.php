@extends('layouts.'.Auth::user()->role.'_layout')
@section('title' , __('Activate Doctorino'))
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            @if(!get_option('purchase_code'))
            <div class="card">
                <div class="card-header bg-gradient-primary text-white p-5">
                    <p class="mb-0 text-warning text-capitalize">Your version is not activated, consider purchasing a license before {{ Carbon\Carbon::parse(get_option('last_check'))->addDays(7) }}</p>
                    <h1 class="">{{ __('You want a 20% discount?') }}</h1>
                    <p class="mb-0 text-capitalize text-font-12">Use <b class="text-warning">WELCOME20</b> promotional code & Enjoy <b>Doctorino</b> features and updates without limits ! and a lifetime</p>
                    <a href="https://getdoctorino.com?utm_source=in-app&utm_medium=upgrade-box&utm_campaign=doctorino" class="btn btn-danger mt-3"><i class="fa fa-key mx-1"></i> Purchase New License</a>
                </div>
                <div class="card-body p-5">
                    <form method="post" action="{{ route('activation') }}" class="mt-4">
                        @csrf
                        <div class="row">
                           <div class="col-lg-12">
                              <div>
                                 <div class="mb-4">
                                    <label class="form-label" for="custom_css">{{ __('Purchase Code') }}</label>
                                    <input name="purchase_code" type="text" class="form-control" placeholder="Your Purchase Code">
                                 </div>
                              </div>
                           </div>
                        </div>
                        
                        <button type="submit" class="btn btn-doctorino w-lg" name="form" value="activation">{{ __('Activate') }}</button>
                      
                     </form>
                </div>
            </div>
            <!-- end card -->
            @else
            <div class="card">


                <div class="card-header bg-gradient-primary text-white p-3">
                    <p class="mb-0 text-capitalize">License Manager</p>
                </div>
                <div class="card-body p-3"> 
                    @if(last_check()['status'] != 0)
                    <div class="alert alert-danger">{!! last_check()['message'] !!}</div>
                    @endif
                    @if(get_option('available_version') != get_option('current_version'))
                    <div class="alert alert-info">{{ __('A new version is available') }} : <a href="https://codecanyon.net/item/doctorino-doctor-chamber-management-system/28707541" target="_blank">Download Doctorino {{ get_option('available_version') }}</a></div>
                    @endif
                    @if(Carbon\Carbon::parse(get_option('supported_until'))->isFuture())
                    <div class="alert alert-success">{{ get_option('license_message') }}</div>
                    <a href="https://getdoctorino.com/submit-ticket/?utm_source=in-app&utm_medium=upgrade-box&utm_campaign=doctorino" class="btn btn-outline-primary mt-3"><i class="fas fa-hands-helping mx-1"></i> Contact Support</a>
                    <a href="https://getdoctorino.com?utm_source=in-app&utm_medium=upgrade-box&utm_campaign=doctorino" class="btn btn-outline-danger mt-3"><i class="fas fa-arrow-alt-circle-up mx-1"></i> Extend Support Now !</a>
                    @else
                    <div class="alert alert-success">{{ get_option('license_message') }}</div>
                    <a href="https://getdoctorino.com/submit-ticket/?utm_source=in-app&utm_medium=upgrade-box&utm_campaign=doctorino" class="btn btn-outline-primary mt-3"><i class="fas fa-hands-helping mx-1"></i> Contact Support</a>
                    <a href="https://codecanyon.net/item/doctorino-doctor-chamber-management-system/28707541" class="btn btn-outline-danger mt-3"><i class="fas fa-arrow-alt-circle-up mx-1"></i> Renew Support Now !</a>
                    @endif
                </div>
            </div>
            <!-- end card -->
            @endif
        </div>
        <!-- end col -->


    </div>
@endsection
@section('header')
@endsection
@section('footer')
@endsection
