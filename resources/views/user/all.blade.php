@extends('layouts.'.Auth::user()->role.'_layout')

@section('title')
{{ __('All users') }}
@endsection

@section('content')

          <div class="card shadow mb-4">
            <div class="card-header py-3">
               <div class="row">
                <div class="col-8">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('All Users') }}</h6>
                </div>
                <div class="col-4">
                  <a href="{{ route('user.create') }}" class="btn btn-outline-primary btn-sm float-right "><i class="fa fa-plus"></i> {{ __('New User') }}</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="text-center">
                      <th>ID</th>
                      <th>{{ __('Name') }}</th>
                      <th>{{ __('Email') }}</th>
                      <th>{{ __('Register Date') }}</th>
                      <th>{{ __('Roles') }}</th>
                      <th>{{ __('Actions') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                    <tr class="text-center">
                      <td>{{ $user->id }}</td>
                      <td>{{ $user->name }}</td>
                      <td> {{ $user->email }} </td>
                      <td><label class="badge badge-primary-soft">{{ $user->created_at->format('d M Y H:i') }}</label></td>
                      <td>
                        @forelse($user->getRoleNames() as $role)
                        <label class="badge badge-warning-soft">{{ ucfirst($role) }}</label> 
                        @empty  
                        <label class="badge badge-warning-soft">no role for {{ $user->name }}</label> 
                        @endforelse
                      </td>
                      <td>
                        <a href="{{ route('user.edit',['id' => $user->id]) }}" class="btn btn-outline-warning btn-sm"><i class="fa fa-pen"></i></a>
                        <a href="#" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="{{ route('patient.destroy',['id' => $user->id]) }}"><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                    @endforeach
                   
                  </tbody>
                </table>
               <span class="float-right mt-3">{{ $users->links() }}</span>

              </div>
            </div>
          </div>
@endsection

  