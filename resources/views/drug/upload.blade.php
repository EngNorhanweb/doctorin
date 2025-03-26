@extends('layouts.'.Auth::user()->role.'_layout')

@section('title')
{{ __('Add Drug') }}
@endsection

@section('content')
<div class="row justify-content-center">
   <div class="col-md-8">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Bulk Upload') }}</h6>
         </div>
         <div class="card-body">
            
            <form method="post" action="{{ route('drug.bulk_upload_store') }}" enctype="multipart/form-data">
               <div class="form-group">
                  <label for="file">Select CSV/Excel file</label>
                  <input type="file" class="form-control" name="file" id="file" aria-describedby="file">
                  {{ csrf_field() }}
                  <small><a href="{{ asset('uploads/drugs.xlsx') }}">Download Sample</a></small>
               </div>
               <button type="submit" class="btn btn-primary mt-3">{{ __('Start Uploading') }}</button>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection