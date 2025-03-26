@extends('layouts.'.Auth::user()->role.'_layout')
@section('title')
{{ __('All Drugs') }}
@endsection
@section('content')
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<div class="row">
			<div class="col-8">
				<h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('All Drugs') }}</h6>
			</div>
			<div class="col-4">
				@can('create drug')
				<a href="{{ route('drug.bulk_upload') }}" class="btn btn-outline-primary btn-sm float-right"><i class="fa fa-cloud-upload-alt"></i> {{ __('Bulk Upload') }}</a>
				<a href="{{ route('drug.create') }}" class="btn btn-outline-primary btn-sm float-right mr-2"><i class="fa fa-plus"></i> {{ __('Add Drug') }}</a>
				@endcan
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr class="text-center">
						<th>ID</th>
						<th>{{ __('Trade Name') }}</th>
						<th>{{ __('Generic Name') }}</th>
						<th>{{ __('Total Use') }}</th>
						<th>{{ __('Actions') }}</th>
					</tr>
				</thead>
				<tbody>
					@forelse($drugs as $drug)
					<tr class="text-center">
						<td>{{ $drug->id }}</td>
						<td>{{ ucfirst($drug->trade_name) }}</td>
						<td>{{ ucfirst($drug->generic_name) }}</td>
						<td><label class="badge badge-primary-soft">{{ __('In Prescription') }} : {{ $drug->Prescription->count() }} {{ __('time use') }}</label></td>
						<td>
							@can('edit drug')
							<a href="{{ route('drug.edit',['id' => $drug->id]) }}" class="btn btn-outline-warning btn-sm"><i class="fa fa-pen"></i></a>
							@endcan
							@can('delete drug')
							<a class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="{{ route('drug.destroy',['id' => $drug->id]) }}"><i class="fas fa-trash"></i></a>
							@endcan
						</td>
					</tr>
					@empty
					<tr class="text-center">
						<td colspan="5">{{ __('You don\'t have any drug') }}, <a href="{{ route('drug.create') }}">{{ __('create one') }}</a></td>
					</tr>
					@endforelse
				</tbody>
			</table>
			<span class="float-right mt-3">{{ $drugs->links() }}</span>
		</div>
	</div>
</div>
@endsection