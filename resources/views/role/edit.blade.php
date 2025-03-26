@extends('layouts.'.Auth::user()->role.'_layout')

@section('title')
{{ __('Edit role') }}
@endsection

@section('content')


    <div class="row justify-content-center">                  

        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">{{ __('Edit role') }}</h6>
                </div>
                <div class="card-body">
                 <form method="post" action="{{ route('role.store_edit_role') }}">
                    <div class="form-group row">
                      <label for="Name" class="col-sm-3 col-form-label">{{ __('Name') }}<font color="red">*</font></label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="Name" name="name" value="{{ $role->name }}">
                        <input type="hidden" class="form-control" name="role_id" value="{{ $role->id }}">
                        {{ csrf_field() }}
                      </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                      <label for="Email" class="col-sm-3 col-form-label">{{ __('Permissions') }}<font color="red">*</font></label>
                      <div class="col-sm-9">
                        <select  class="selectpicker w-100" data-live-search="true" multiple="multiple" name="permissions[]">
                          @forelse($permissions as $permission)
                            <option value="{{ $permission->name }}" @if($role->hasPermissionTo($permission->id)) selected="selected" @endif>{{ $permission->name }}</option>
                            @empty

                            @endforelse
                           
                        </select>
                        <hr>
                          @forelse($role->permissions->pluck('name') as $permission)
                        <label class="badge badge-success-soft">{{ ucfirst($permission) }}</label> 
                        @empty  
                        <label class="badge badge-warning-soft">No permissions for {{ $role->name }}</label> 
                        @endforelse
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

