@extends('layouts.'.Auth::user()->role.'_layout')
@section('title')
{{ __('View Prescription') }}
@endsection
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800"></h1>
   @can('print prescription')
   <button href="" class="d-none d-sm-inline-block btn btn-sm btn-outline-primary print_prescription"><i class="fas fa-print"></i> {{ __('Print') }}</button>
   @endcan
</div>
<div class="row justify-content-center">
   <div class="col-10">
      <div class="card shadow mb-4">
         <div class="card-body">
            <!-- ROW : Doctor informations -->
            <div class="row"> 
               <div class="col font-size-13">
                  <p>
                     {!! clean(get_option('title')) !!} <br>
                     {!! clean(get_option('Address')) !!} <br>
                     {!! clean(get_option('phone')) !!} <br>
                  </p>
                  {!! clean(get_option('header_left')) !!}
               </div>
               <div class="col text-center">
                  @if(!empty(get_option('logo')))
                  <img src="{{ asset('uploads/'.get_option('logo')) }}" width="60%"><br><br>
                  @endif
               </div>
               <div class="col font-size-13">
                  <p>
                     <b>{{ __('Date') }} :</b> {{ $prescription->created_at->toFormattedDateString() }}<br>
                     <b>{{ __('Reference') }} :</b> {{ $prescription->reference }}<br>
                     <b>{{ __('Patient Name') }} :</b> {{ $prescription->User->name }}<br>
                     @isset($prescription->User->gender)
                     <b>{{ __('Gender') }} :</b> {{ $prescription->User->gender }}
                     @endisset
                  </p>
               </div>
            </div>
            <!-- END ROW : Doctor informations -->
            <!-- ROW : Patient informations -->
            <div class="row">
               <div class="col">
                  <h5 class="text-center mt-3"><b>{{ __('Prescription') }}</b></h5>
                  <hr>
               </div>
            </div>
            <!-- END ROW : Patient informations -->
            @if(count($prescription_drugs) > 0)
            <!-- ROW : Drugs List -->
            <div class="row justify-content-center">
               <div class="col">
                  @foreach ($prescription_drugs as $drug)
                  <li>
                     <b>{{ $drug->Drug->trade_name }} {{ $drug->strength }}</b> 
                     <ol>{{ $drug->dose }} - {{ $drug->duration }}</ol>
                     <ol>{{ $drug->drug_advice }}</ol>
                  </li>
                  @if($loop->last)
                  <div style="margin-bottom: 50px;"></div>
                  <hr>
                  @endif
                  @endforeach
               </div>
            </div>
            @endif
            @if(count($prescription_tests) > 0)
            <!-- ROW : Tests List -->
            <div class="row justify-content-center">
               <div class="col">
                  <strong><u>{{ __('Test to do') }} </u></strong><br><br>
                  @foreach ($prescription_tests as $test)
                  <li>{{ $test->Test->test_name }} @empty(!$test->description) - {{ $test->description }} @endempty</li>
                  @if($loop->last)
                  <div style="margin-bottom: 50px;"></div>
                  <hr>
                  @endif
                  @endforeach
                  <hr>
               </div>
            </div>
            <!-- END ROW : Tests List -->
            @endif
            <div style="margin-bottom: 150px;"></div>
            <!-- ROW : Patient informations -->
            <div class="row">
               <div class="col-8"></div>
               <div class="col-4">
                  <hr style="border: 1px solid black;">
                  <h6 class="text-center mt-3"><b>{{ __('Signature, Stamp') }}</b></h6>
               </div>
            </div>
            <div style="margin-bottom: 150px;"></div>
            <!-- END ROW : Patient informations -->
            @if(!empty(get_option('footer_left')) && !empty(get_option('footer_right')))
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
            @elseif(empty(get_option('footer_left')))
            <!-- ROW : Footer informations -->
            <div class="row">
               <div class="col">
                  <p class="font-size-14 text-center">{!! clean(get_option('footer_right')) !!}</p>
               </div>
            </div>
            <!-- END ROW : Footer informations -->
            @elseif(empty(get_option('footer_right')))
            <!-- ROW : Footer informations -->
            <div class="row">
               <div class="col">
                  <p class="font-size-14 text-center">{!! clean(get_option('footer_left')) !!}</p>
               </div>
            </div>
            <!-- END ROW : Footer informations -->
            @else
            @endif
         </div>
      </div>
   </div>
</div>
<!-- Hidden prescription -->
<div id="print_area" style="display: none;">
   <!-- ROW : Doctor informations -->
   <div class="row">
      <div class="col">
         <p>
            {!! clean(get_option('title')) !!} <br>
            {!! clean(get_option('Address')) !!} <br>
            {!! clean(get_option('phone')) !!} <br>
         </p>
         {!! clean(get_option('header_left')) !!}
      </div>
      <div class="col-6 text-center">
         @if(!empty(get_option('logo')))
         <img src="{{ asset('uploads/'.get_option('logo')) }}" width="60%"><br><br>
         @endif
      </div>
      <div class="col">
         <p>
            <b>{{ __('Date') }} :</b> {{ $prescription->created_at->format('d M Y') }}<br>
            <b>{{ __('Reference') }} :</b> {{ $prescription->reference }}<br>
            <b>{{ __('Patient Name') }} :</b> {{ $prescription->User->name }}
            @isset($prescription->User->gender)
               <b>{{ __('Gender') }} :</b> {{ $prescription->User->gender }}
            @endisset
         </p>
      </div>
   </div>
   <!-- END ROW : Doctor informations -->
   <!-- ROW : Patient informations -->
   <div class="row">
      <div class="col">
         <h5 class="text-center mt-3"><b>{{ __('Prescription') }}</b></h5>
         <hr>
      </div>
   </div>
   <!-- END ROW : Patient informations -->
   @if(count($prescription_drugs) > 0)
   <!-- ROW : Drugs List -->
   <div class="row justify-content-center">
      <div class="col-11">
         @foreach ($prescription_drugs as $drug)
         <li>
            <b>{{ $drug->Drug->trade_name }} {{ $drug->strength }}</b> 
            <ol>{{ $drug->dose }} - {{ $drug->duration }}</ol>
            <ol>{{ $drug->drug_advice }}</ol>
         </li>
         @if($loop->last)
         <div style="margin-bottom: 50px;"></div>
         <hr>
         @endif
         @endforeach
      </div>
   </div>
   @endif
   @if(count($prescription_tests) > 0)
   <!-- ROW : Tests List -->
   <div class="row justify-content-center">
      <div class="col-11">
         <strong><u>{{ __('Test to do') }} </u></strong><br><br>
         @foreach ($prescription_tests as $test)
         <li>{{ $test->Test->test_name }} @empty(!$test->description) - {{ $test->description }} @endempty</li>
         @if($loop->last)
         <div style="margin-bottom: 50px;"></div>
         <hr>
         @endif
         @endforeach
         <hr>
      </div>
   </div>
   <!-- END ROW : Tests List -->
   @endif
   <div style="margin-bottom: 700px;"></div>
   <!-- ROW : Patient informations -->
   <div class="row">
      <div class="col-8"></div>
      <div class="col-4">
         <hr style="border: 1px solid black;">
         <h6 class="text-center mt-3"><b>{{ __('Signature, Stamp') }}</b></h6>
      </div>
   </div>
   <!-- ROW : Footer informations -->
   <footer class="footerdx">
      <hr >
      <!-- ROW : Footer informations -->
      <div class="row">
         <div class="col">
            <p class="font-size-14 text-center">{!! clean(get_option('footer_left')) !!}</p>
         </div>
      </div>
   </footer>
   <!-- END ROW : Footer informations -->
</div>
@endsection
@section('header')
<style type="text/css">
.footerdx {
   width: 100%;
   position: fixed;
   bottom: 0;
}

   p, u, li {
   color: #444444 !important; 
   }
</style>
@endsection
@section('footer')
<script type="text/javascript">
   function printDiv(divName) {
      
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
   
     document.body.innerHTML = printContents;
   
     window.print();
   
     document.body.innerHTML = originalContents;
   }
   
   
   $(function(){
     $(document).on("click", '.print_prescription',function () {
        printDiv('print_area');
      });
   });
</script>
@endsection