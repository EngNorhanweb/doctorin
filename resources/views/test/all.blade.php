@extends('layouts.'.Auth::user()->role.'_layout')
@section('title')
{{ __('All Tests') }}
@endsection
@section('content')
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<div class="row">
			<div class="col-8">
				<h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('All Tests') }}</h6>
			</div>
			<div class="col-4">
				@can('create diagnostic test')
				<a href="{{ route('test.create') }}" class="btn btn-outline-primary btn-sm float-right"><i class="fa fa-plus"></i> {{ __('Add Test') }}</a>
				@endcan
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th class="text-center">ID</th>
						<th class="text-center">{{ __('Test Name') }}</th>
						<th class="text-center">{{ __('Description') }}</th>
						<th class="text-center">{{ __('Total Use') }}</th>
						<th class="text-center">{{ __('Actions') }}</th>
					</tr>
				</thead>
				<tbody>
					@forelse($tests as $test)
					<tr>
						<td class="text-center">{{ $test->id }}</td>
						<td class="text-center">{{ $test->test_name }}</td>
						<td class="text-center"> {{ $test->comment ?? __('N/A') }} </td>
						<td class="text-center"><label class="badge badge-primary-soft"><i class="fa fa-clock"></i> {{ __('In Prescription') }} : {{ $test->Prescription->count() }} {{ __('time use') }}</label></td>
						<td class="text-center">
							@can('edit diagnostic test')
							<a href="{{ route('test.edit', ['id' => $test->id]) }}" class="btn btn-outline-warning btn-sm"><i class="fa fa-pen"></i></a>
							@endcan
							@can('delete diagnostic test')
							<a class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="{{ route('test.delete', ['id' => $test->id]) }}"><i class="fa fa-trash"></i></a>
							@endcan
						</td>
					</tr>
					@empty
					<tr>
						<td colspan="5" class="text-center">{{ __('You don\'t have any Diagnosis Tests') }}, <a href="{{ route('test.create') }}">{{ __('create one') }}</a></td>
					</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection