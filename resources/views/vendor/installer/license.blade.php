@extends('vendor.installer.layouts.master')

@section('template_title')
Licence Manager
@endsection

@section('title')
    <i class="fa fa-lock fa-fw" aria-hidden="true"></i>
    Licence Manager 
@endsection

@section('container')

    <p class="text-center">
        <ol>
            <li>Please go to <a href="https://codecanyon.net/downloads">Codecanyon.net/downloads</a></li>
            <li>Click the Download button in Doctorino row</li>
            <li>Select License Certificate &amp; Purchase code</li>
            <li>Copy Item Purchase Code</li>
         </ol>
    </p>
    <form method="post" action="{{ route('LaravelInstaller::saveLicence') }}" class="tabs-wrap">
        @csrf
        <div class="form-group {{ $errors->has('purchase_code') ? ' has-error ' : '' }}">
            <label for="purchase_code">
                Purchase Code
            </label>
            <input type="text" name="purchase_code" id="purchase_code" value="{{ session('purchase_code') }}" placeholder="Purchase Code" />
            @if ($errors->has('purchase_code'))
                <span class="error-block">
                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ $errors->first('purchase_code') }}
                </span>
            @endif
        </div>
        <div class="buttons">
            <button class="button" type="submit">
               Check & {{ trans('installer_messages.environment.wizard.form.buttons.install') }}
                <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
            </button>
        </div>
    </form>
    

@endsection
