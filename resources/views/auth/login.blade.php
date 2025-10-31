@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end --> 
<!-- Inner Page Title start -->
@include('includes.inner_page_title', ['page_title'=>__('Login')])
<!-- Inner Page Title end -->
<div class="listpgWraper">
    <div class="container">
        @include('flash::message')
            
            <div class="useraccountwrap">
                <div class="userccount">
                    <h3 class="text-center mb-5" id="category">Please Select The Category</h3>
                    <div class="userbtns">
                        <ul class="nav nav-tabs">
                            
                            <li class="nav-item col-6"><a class="nav-link candidate active" id="candidate_btn" >{{__('Candidate')}}</a></li>
                            <li class="nav-item col-6"><a class="nav-link employer " id="employer_btn" >{{__('Employer')}}</a></li>
                        </ul>
                    </div>
					
					
                    <div class="tab-content">
                        <div id="candidate" class="formpanel active">
                            <div class="socialLogin">
                                <h5>{{__('Login with Social')}}</h5>
                                <a href="{{ url('login/jobseeker/facebook')}}" class="fb"><i class="fa fa-facebook" aria-hidden="true"></i></a><a href="{{ url('login/jobseeker/twitter')}}" class="tw"><i class="fa fa-twitter" aria-hidden="true"></i></a> 
                            </div>
                            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="candidate_or_employer" value="candidate" />
                                <div class="formpanel">
                                    <div class="formrow{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="{{__('Email Address')}}">
                                        @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="formrow{{ $errors->has('password') ? ' has-error' : '' }} input-group mb-3">
                                      <input type="password" class="form-control" id="candidatepassword" name="password" value="" required placeholder="{{__('Password')}}" aria-describedby="basic-addon1">
                                      <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon1" onclick="showPassword('candidate')" style="cursor:pointer;"><i class="fa fa-eye-slash"></i></span>
                                      </div>
                                      @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                    </div>            
                                    <input type="submit" class="btn" value="{{__('Login')}}">
                                </div>
                                <!-- login form  end--> 
                            </form>
                            <!-- sign up form -->
                            <div class="newuser"><i class="fa fa-user" aria-hidden="true"></i> {{__('Forgot Your Password')}}? <a href="{{ route('password.request') }}">{{__('Click here')}}</a></div>
                            <!-- sign up form end-->
                        </div>
                        <div id="employer" class="formpanel d-none">
                            <div class="socialLogin">
                                        <h5>{{__('Login with Social')}}</h5>
                                        <a href="{{ url('login/employer/facebook')}}" class="fb"><i class="fa fa-facebook" aria-hidden="true"></i></a> <a href="{{ url('login/employer/twitter')}}" class="tw"><i class="fa fa-twitter" aria-hidden="true"></i></a> </div>
                            <form class="form-horizontal" method="POST" action="{{ route('company.login') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="candidate_or_employer" value="employer" />
                                <div class="formpanel">
                                    <div class="formrow{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="{{__('Email Address')}}">
                                        @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="formrow{{ $errors->has('password') ? ' has-error' : '' }} input-group mb-3">
                                      <input type="password" class="form-control" id="employerpassword" name="password" value="" required placeholder="{{__('Password')}}" aria-describedby="basic-addon2">
                                      <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2" onclick="showPassword('employer')" style="cursor:pointer;"><i class="fa fa-eye-slash"></i></span>
                                      </div>
                                      @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                    <input type="submit" class="btn" value="{{__('Login')}}">
                                </div>
                                <!-- login form  end--> 
                            </form>
                            <!-- sign up form -->
                            <div class="newuser"><i class="fa fa-user" aria-hidden="true"></i> {{__('Forgot Your Password')}}? <a href="{{ route('company.password.request') }}">{{__('Click here')}}</a></div>
                            <!-- sign up form end-->
                        </div>                            
                        <div class="newuser"><i class="fa fa-user" aria-hidden="true"></i> {{__('New User')}}? <a href="{{route('register')}}">{{__('Register Here')}}</a></div>

                    </div>
                    <!-- login form -->

                     

                </div>
            </div>
        
    </div>
</div>
@push('scripts')
    <script>
        function showPassword(type)
        {
            var x = document.getElementById(type + 'password');
            if (x.type === "password") {
               x.type = "text";
               if(type == 'candidate')
               {
                   $('#basic-addon1').html('<i class="fa fa-eye"></i>');
               }else{
                   $('#basic-addon2').html('<i class="fa fa-eye"></i>');
               }
            } else {
               x.type = "password";
               if(type == 'candidate')
               {
                   $('#basic-addon1').html('<i class="fa fa-eye-slash"></i>');
               }else{
                   $('#basic-addon2').html('<i class="fa fa-eye-slash"></i>');
               }
            }    
        }
        
        $('#candidate_btn').click(function(){
            $(this).addClass('active')
            $(this).parent().removeClass('col-6')
            $(this).parent().addClass('col-6')
            // $('#employer_btn').addClass('d-none')
            $('#category').addClass('d-none')
            $('#employer').addClass('d-none')
            $('#candidate').removeClass('d-none')
            $('#employer_btn').removeClass('active')
        });
        $('#employer_btn').click(function(){
            $(this).addClass('active')
            $(this).parent().removeClass('col-6')
            $(this).parent().addClass('col-6')
            // $('#candidate_btn').addClass('d-none')
            $('#category').addClass('d-none')
            $('#candidate').addClass('d-none')
            $('#employer').removeClass('d-none')
            $('#candidate_btn').removeClass('active')
        });
    </script>
@endpush
@include('includes.footer')
@endsection
