@extends('layouts.'.Auth::user()->role.'_layout')

@section('title')
{{ __('Create role') }}
@endsection

@section('content')


    <div class="row justify-content-center">                  

        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">{{ __('Create role') }}</h6>
                </div>
                <div class="card-body">
                 <form method="post" action="{{ route('role.store') }}">
                    <div class="form-group row">
                      <label for="Name" class="col-sm-3 col-form-label">{{ __('Name') }}<font color="red">*</font></label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="Name" name="name" >
                        <input type="hidden" class="form-control" name="role_id">
                        {{ csrf_field() }}
                      </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                      <label for="Email" class="col-sm-3 col-form-label">{{ __('Permissions') }}<font color="red">*</font></label>
                      <div class="col-sm-9">
                        <select multiple="multiple" name="permissions[]"  class="selectpicker w-100" data-live-search="true">
                          @forelse($permissions as $permission)
                            <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                            @empty

                            @endforelse
                           
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

