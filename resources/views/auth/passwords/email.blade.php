<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>Doctorino - Login</title>
      
      <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
      
      <!-- Custom styles for this template-->
      <link href="{{ asset('dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet">

   </head>
   <body class="bg-gradient-primary">
      <div class="container">
         <!-- Outer Row -->
         <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-12 col-md-9">
               <div class="card o-hidden border-0 shadow-lg my-5">
                  <div class="card-body p-0">
                     <!-- Nested Row within Card Body -->
                     <div class="row">
                        <!--<div class="col-lg-6 d-none d-lg-block bg-login-image"></div>-->
                        <div class="col-lg-12">
                           <div class="p-5">
                              <div class="text-center">
                                 <img src="{{ asset('img/logo-grey.png') }}" class="img-fluid" >
                                 <hr>
                                 <h4 class="h5 text-gray-700 mb-4">{{ __('sentence.Reset password') }}</h4>
                                 @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                              </div>
                             
                              <form method="POST" action="{{ route('password.email') }}" class="user">
                                @csrf
                                 <div class="form-group">
                                    <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus  aria-describedby="emailHelp" placeholder="{{ __('sentence.Email') }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                                 
                                 <button class="btn btn-warning btn-user btn-block" type="submit"> {{ __('sentence.Send Password Reset Link') }}</button> 
                              </form>                            
                           </div>
                          
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script src="{{ asset('js/app.js') }}" defer></script>
   </body>
</html>
