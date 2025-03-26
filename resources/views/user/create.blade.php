@extends('layouts.'.Auth::user()->role.'_layout')

@section('title')
{{ __('New User') }}
@endsection

@section('content')

    <div class="row justify-content-center">
                  
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">{{ __('New User') }}</h6>
                </div>
                <div class="card-body">
                 <form method="post" action="{{ route('user.store') }}">
                    <div class="form-group row">
                      <label for="Name" class="col-sm-3 col-form-label">{{ __('Full Name') }}<font color="red">*</font></label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="Name" name="name">
                        {{ csrf_field() }}
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Email" class="col-sm-3 col-form-label">{{ __('Email Adress') }}<font color="red">*</font></label>
                      <div class="col-sm-9">
                        <input type="email" class="form-control" id="Email" name="email">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="Password" class="col-sm-3 col-form-label">{{ __('Password') }}<font color="red">*</font></label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" id="Password" name="password">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="Password" class="col-sm-3 col-form-label">{{ __('Password Confirmation') }}<font color="red">*</font></label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" id="Password" name="password_confirmation">
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="Phone" class="col-sm-3 col-form-label">{{ __('Phone') }}</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="Phone" name="phone">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Gender" class="col-sm-3 col-form-label">{{ __('Gender') }}</label>
                      <div class="col-sm-9">
                        <select class="form-control" name="gender" id="Gender">
                          <option value="Male">{{ __('Male') }}</option>
                          <option value="Female">{{ __('Female') }}</option>
                        </select>
                      </div>
                    </div>

             
                  
                    <div class="form-group row">
                      <label for="role" class="col-sm-3 col-form-label">{{ __('Role') }}</label>
                      <div class="col-sm-9">
                        <select class="form-control" name="role" id="role">
                                            <option value="Unknown">{{ __('Select Role') }}</option>
                                            @forelse($roles as $role)
                                              <option value="{{ $role }}">{{ ucfirst($role) }}</option>
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

@section('header')

@endsection

@section('footer')

@endsection
