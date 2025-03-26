@extends('layouts.'.Auth::user()->role.'_layout')

@section('title')
{{ __('Create Expense') }}
@endsection

@section('content')
<div class="row justify-content-center">
   <div class="col-md-8">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Add New Expense') }}</h6>
         </div>
         <div class="card-body">
            
            <form method="post" action="{{ route('expense.store') }}">
               <div class="form-group">
                  <label for="title">{{ __('Title') }}</label>
                  <input type="text" class="form-control" name="title" id="title" aria-describedby="title">
                  {{ csrf_field() }}
               </div>
               <div class="form-group">
                  <label for="type">{{ __('Type') }}</label>
                  <input type="text" class="form-control" name="type" id="type">
               </div>
               <div class="form-group">
                  <label for="amount">{{ __('Amount') }}</label>
                  <input type="number" class="form-control" name="amount" id="amount">
               </div>
               <div class="form-group">
                  <label for="date">{{ __('Date') }}</label>
                  <input type="date" class="form-control" name="date" id="date">
               </div>
               <div class="form-group">
                  <label for="note">{{ __('Note') }}</label>
                  <input type="text" class="form-control" name="note" id="note">
               </div>
               <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection