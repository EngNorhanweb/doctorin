@extends('layouts.'.Auth::user()->role.'_layout')

@section('title')
{{ __('All Expenses') }}
@endsection

@section('content')

<div class="card shadow mb-4">
   <div class="card-header py-3">
      <div class="row">
         <div class="col-7">
            <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('All Expenses') }}</h6>
         </div>
         <div class="col-5">
            @can('create expense')
            <a href="{{ route('expense.create') }}" class="btn btn-outline-primary btn-sm float-right mr-2"><i class="fa fa-plus"></i> {{ __('Create Expense') }}</a>
            @endcan
         </div>
      </div>
   </div>
   <div class="card-body">
      <div class="table-responsive">
         <table class="table" id="dataTable" width="100%" cellspacing="0">
            <thead>
               <tr class="text-center">
                  <th>{{ __('ID') }}</th>
                  <th>{{ __('Title') }}</th>
                  <th>{{ __('Description') }}</th>
                  <th>{{ __('Amount') }}</th>
                  <th>{{ __('Type') }}</th>
                  <th>{{ __('Date') }}</th>
                  <th>{{ __('Actions') }}</th>
               </tr>
            </thead>
            <tbody>
               @forelse($expenses as $expense)
               <tr class="text-center">
                  <td>{{ $expense->id }}</td>
                  <td>{{ $expense->title }}</td>
                  <td>{{ $expense->note ?? __('N/A') }}</td>
                  <td>{{ formatCurrency($expense->amount, get_option('currency_symbol'), get_option('currency_position')) }}</td>
                  <td><label class="badge badge-success-soft">{{ $expense->type }}</label></td>
                  <td><label class="badge badge-primary-soft"><i class="far fa-calendar"></i> {{ $expense->date }} </label></td>
                  <td class="text-center">
                     @can('edit expense')
                     <a href="{{ route('expense.edit', ['id' => $expense->id]) }}" class="btn btn-outline-warning btn-sm"><i class="fa fa-pen"></i></a>
                     @endcan
                     @can('edit expense')
                     <a class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="{{ route('expense.delete', ['id' => $expense->id]) }}"><i class="fas fa-trash"></i></a>
                     @endcan
                  </td>
               </tr>
               @empty
               <tr class="text-center">
						<td colspan="7">{{ __('You don\'t have any expense') }}, <a href="{{ route('expense.create') }}">{{ __('create one') }}</a></td>
					</tr>
               @endforelse
            </tbody>
         </table>
         <span class="float-right mt-3">{{ $expenses->links() }}</span>

      </div>
   </div>
</div>
@endsection

@section('footer')

@endsection