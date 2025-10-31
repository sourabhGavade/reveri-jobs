@extends('layouts.app')

@section('content') 

<!-- Header start --> 

@include('includes.header') 

<!-- Header end --> 

<!-- Inner Page Title start --> 

@include('includes.inner_page_title', ['page_title'=>__('Register')]) 

<!-- Inner Page Title end -->

<div class="listpgWraper">

    <div class="container">

        @include('flash::message')

        

           <div class="useraccountwrap">

                <div class="userccount">
                    <h3 class="text-center mb-5" id="category">Please Select The Category</h3>
                    <div class="userbtns">

                        <ul class="nav nav-tabs">
                            <li class="nav-item col-6"><a class="nav-link candidate " id="candidate_btn" >{{__('Candidate')}}</a></li>
                            <li class="nav-item col-6"><a class="nav-link employer " id="employer_btn" >{{__('Employer')}}</a></li>
                        </ul>

                    </div>

                    <div class="tab-content">

                        <div id="candidate" class="formpanel d-none">

                            <form class="form-horizontal candidate_form" method="POST" action="{{ route('register') }}">

                                {{ csrf_field() }}

                                <input type="hidden" name="candidate_or_employer" value="candidate" />

                                <div class="formrow{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                    <label for="">{{__('First Name')}} <b class="text-danger">*</b></label>
                                    <input type="text" name="first_name" class="form-control" required="required" placeholder="{{__('First Name')}}" value="{{old('first_name')}}">

                                </div>
                                    
                                @if ($errors->has('first_name'))
                                    <div class="help-block mb-3">
                                        <strong style="color:red;font-weight:600;">{{ $errors->first('first_name') }}</strong>
                                    </div>
                                @endif

                                <div class="formrow{{ $errors->has('middle_name') ? ' has-error' : '' }}">
                                    <label for="">{{__('Middle Name')}}</label>
                                    <input type="text" name="middle_name" class="form-control" placeholder="{{__('Middle Name')}}" value="{{old('middle_name')}}">

                                </div>
                                    
                                @if ($errors->has('middle_name'))
                                    <div class="help-block mb-3">
                                        <strong style="color:red;font-weight:600;">{{ $errors->first('middle_name') }}</strong>
                                    </div>
                                @endif

                                <div class="formrow{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                    <label for="">{{__('Last Name')}} <b class="text-danger">*</b></label>
                                    <input type="text" name="last_name" class="form-control" required="required" placeholder="{{__('Last Name')}}" value="{{old('last_name')}}">

                                </div>
                                    
                                @if ($errors->has('last_name'))
                                    <div class="help-block mb-3">
                                        <strong style="color:red;font-weight:600;">{{ $errors->first('last_name') }}</strong>
                                    </div>
                                @endif

                                <div class="formrow{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="">{{__('Email')}} <b class="text-danger">*</b></label>
                                    <input type="email" name="email" class="form-control" required="required" placeholder="{{__('Email')}}" value="{{old('email')}}">
                                </div>
                                
                                @if ($errors->has('email'))
                                    <div class="help-block mb-3">
                                        <strong style="color:red;font-weight:600;">{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif
                                
                                <div class="formrow{{ $errors->has('password') ? ' has-error' : '' }} input-group mb-3">
                                    <label for="" class="w-100">{{__('Password')}} <b class="text-danger">*</b></label>
                                    <input type="password" class="form-control d-block" id="candidatepassword" name="password" value="" required placeholder="{{__('Password')}}" aria-describedby="basic-addon1">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon1" onclick="showPassword('candidate','normal')" style="cursor:pointer;"><i class="fa fa-eye-slash"></i></span>
                                    </div>
                                </div>
                                @if ($errors->has('password'))
                                    <div class="help-block mb-3">
                                        <strong style="color:red;font-weight:600;">{{ $errors->first('password') }}</strong>
                                    </div>
                                @endif

                                <div class="formrow{{ $errors->has('password_confirmation') ? ' has-error' : '' }} input-group mb-3">
                                    <label for="" class="w-100">{{__('Password Confirmation')}} <b class="text-danger">*</b></label>
                                      <input type="password" class="form-control" id="candidatepassword_confirmation" name="password_confirmation" required placeholder="{{__('Password Confirmation')}}" aria-describedby="basic-addon4">
                                      <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon4" onclick="showPassword('candidate','confirm')" style="cursor:pointer;"><i class="fa fa-eye-slash"></i></span>
                                      </div>
                                </div>
                                @if ($errors->has('password_confirmation'))
                                    <div class="help-block mb-3">
                                        <strong style="color:red;font-weight:600;">{{ $errors->first('password_confirmation') }}</strong>
                                    </div>
                                @endif
                                    

                                    <div class="formrow{{ $errors->has('is_subscribed') ? ' has-error' : '' }}">

                                        <?php

                                        $is_checked = '';

                                        if (old('is_subscribed', 1)) {

                                            $is_checked = 'checked="checked"';

                                        }

                                        ?>

                                    

                                    <input type="checkbox" value="1" name="is_subscribed" {{$is_checked}} />{{__('Subscribe to news letter')}}
                                    
                                    @if ($errors->has('is_subscribed')) <span class="help-block"> <strong>{{ $errors->first('is_subscribed') }}</strong> </span> @endif </div>

                                <div class="formrow{{ $errors->has('terms_of_use') ? ' has-error' : '' }}">
                                    <input type="checkbox" required value="1" name="terms_of_use" />
                                    <a href="{{url('cms/terms-of-use')}}">{{__('I accept Terms of Use')}}</a>
                                </div>
                                @if ($errors->has('terms_of_use'))
                                    <div class="help-block mb-3">
                                        <strong style="color:red;font-weight:600;">{{ $errors->first('terms_of_use') }}</strong>
                                    </div>
                                @endif
                                <div class="row justify-content-center">
                                    <div id="recaptcha-container" class="my-3" data-callback="recaptchaCallback"></div>
                                </div>
                             

                                <input type="submit" class="btn" id="candidate_form" disabled value="{{__('Register')}}">

                            </form>

                        </div>

                        <div id="employer" class="formpanel d-none">

                            <form class="form-horizontal employer_form" method="POST" action="{{ route('company.register') }}">

                                {{ csrf_field() }}

                                <input type="hidden" name="candidate_or_employer" value="employer" />

                                <div class="formrow{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="">{{__('Name')}} <b class="text-danger">*</b></label>
                                    <input type="text" name="name" class="form-control" required="required" placeholder="{{__('Name')}}" value="{{old('name')}}">

                                </div>
                                    
                                @if ($errors->has('name'))
                                    <div class="help-block mb-3">
                                        <strong style="color:red;font-weight:600;">{{ $errors->first('name') }}</strong>
                                    </div>
                                @endif

                                <div class="formrow{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="">{{__('Email')}} <b class="text-danger">*</b></label>
                                    <input type="email" name="email" class="form-control" required="required" placeholder="{{__('Email')}}" value="{{old('email')}}">
                                </div>
                                
                                @if ($errors->has('email'))
                                    <div class="help-block mb-3">
                                        <strong style="color:red;font-weight:600;">{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif

                                <div class="formrow{{ $errors->has('password') ? ' has-error' : '' }} input-group mb-3">
                                    <label for="" class="w-100">{{__('Password')}} <b class="text-danger">*</b></label>
                                      <input type="password" class="form-control" id="employerpassword" name="password" value="" required placeholder="{{__('Password')}}" aria-describedby="basic-addon2">
                                      <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2" onclick="showPassword('employer','normal')" style="cursor:pointer;"><i class="fa fa-eye-slash"></i></span>
                                      </div>
                                </div>
                                
                                @if ($errors->has('password'))
                                    <div class="help-block mb-3">
                                        <strong style="color:red;font-weight:600;">{{ $errors->first('password') }}</strong>
                                    </div>
                                @endif
                                
                                <div class="formrow{{ $errors->has('password_confirmation') ? ' has-error' : '' }} input-group mb-3">
                                    <label for="" class="w-100">{{__('Password Confirmation')}} <b class="text-danger">*</b></label>
                                      <input type="password" class="form-control" id="employerpassword_confirmation" name="password_confirmation" value="" required placeholder="{{__('Password Confirmation')}}" aria-describedby="basic-addon3">
                                      <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon3" onclick="showPassword('employer','confirm')" style="cursor:pointer;"><i class="fa fa-eye-slash"></i></span>
                                      </div>
                                </div>
                                
                                @if ($errors->has('password_confirmation'))
                                    <div class="help-block mb-3">
                                        <strong style="color:red;font-weight:600;">{{ $errors->first('password_confirmation') }}</strong>
                                    </div>
                                @endif

                                    <div class="formrow{{ $errors->has('is_subscribed') ? ' has-error' : '' }}">

                                        <?php

                                        $is_checked = '';

                                        if (old('is_subscribed', 1)) {

                                            $is_checked = 'checked="checked"';

                                        }

                                        ?>

                                    

                                    <input type="checkbox" value="1" name="is_subscribed" {{$is_checked}} />{{__('Subscribe to news letter')}}

                                    @if ($errors->has('is_subscribed')) <span class="help-block"> <strong>{{ $errors->first('is_subscribed') }}</strong> </span> @endif </div>

                                <div class="formrow{{ $errors->has('terms_of_use') ? ' has-error' : '' }}">
                                    <input type="checkbox" required value="1" name="terms_of_use" />
                                    <a href="{{url('terms-of-use')}}">{{__('I accept Terms of Use')}}</a>
                                </div>
                                
                                @if ($errors->has('terms_of_use'))
                                    <div class="help-block mb-3">
                                        <strong style="color:red;font-weight:600;">{{ $errors->first('terms_of_use') }}</strong>
                                    </div>
                                @endif
                                
                                <div class="row justify-content-center">
                                    <div id="recaptcha-container1" class="my-3"></div>
                                </div>
                            

                                <input type="submit" id="employer_form" class="btn" value="{{__('Register')}}">

                            </form>

                        </div>

                    </div>

                    <!-- sign up form -->

                    <div class="newuser"><i class="fa fa-user" aria-hidden="true"></i> {{__('Have Account')}}? <a href="{{route('login')}}">{{__('Sign in')}}</a></div>

                    <!-- sign up form end--> 



                </div>

            </div>

        

    </div>

</div>

@push('scripts')
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
    <script>
        function recaptchaCallback(type) {
            if(type == 'emp')
            {
                $('#employer_form').removeAttr('disabled');
            }else{
                $('#candidate_form').removeAttr('disabled');
            }
        };
        
        function resetRecaptcha(type)
        {
            recaptchaVerifier.reset();
            if(type == 'emp')
            {
                $('#employer_form').attr('disabled',true);
            }else{
                $('#candidate_form').attr('disabled',true);
            }
        }
        
        function render(type) {
            if(type == 'emp')
            {
                window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container1', {
                  'size': 'normal',
                  'callback': function(response) {
                    recaptchaCallback(type);
                  },
                  'expired-callback': function() {
                    resetRecaptcha(type);
                  }
                });
            }else{
                window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
                  'size': 'normal',
                  'callback': function(response) {
                    recaptchaCallback(type);
                  },
                  'expired-callback': function() {
                    resetRecaptcha(type);
                  }
                });
            }
            recaptchaVerifier.render();
        }
        const firebaseConfig = {
            apiKey: "AIzaSyDxAkrf3so0wyN4M-aQKNR7b_UdVu7fxEk",
            authDomain: "reveri-jobs.firebaseapp.com",
            projectId: "reveri-jobs",
            storageBucket: "reveri-jobs.appspot.com",
            messagingSenderId: "662173118444",
            appId: "1:662173118444:web:ea6e9f97374e673c7c9ac9",
            measurementId: "G-6T98T17FVJ"
        };
        firebase.initializeApp(firebaseConfig);
        function showPassword(type,confirm)
        {
            if(confirm == 'normal')
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
            }else{
                var x = document.getElementById(type + 'password_confirmation');
                if (x.type === "password") {
                   x.type = "text";
                   if(type == 'candidate')
                   {
                       $('#basic-addon4').html('<i class="fa fa-eye"></i>');
                   }else{
                       $('#basic-addon3').html('<i class="fa fa-eye"></i>');
                   }
                } else {
                   x.type = "password";
                   if(type == 'candidate')
                   {
                       $('#basic-addon4').html('<i class="fa fa-eye-slash"></i>');
                   }else{
                       $('#basic-addon3').html('<i class="fa fa-eye-slash"></i>');
                   }
                }
            }
        }
        
        function handleCandidateBtn() {
            localStorage.setItem('type','candidate');
            $(this).addClass('active')
            $(this).parent().removeClass('col-6')
            $(this).parent().addClass('col-12')
            $('#employer_btn').addClass('d-none')
            $('#category').addClass('d-none')
            $('#candidate').removeClass('d-none');
            render('can');
        }
        function handleEmployerBtn() {
            localStorage.setItem('type','employer');
            $(this).addClass('active')
            $(this).parent().removeClass('col-6')
            $(this).parent().addClass('col-12')
            $('#candidate_btn').addClass('d-none')
            $('#category').addClass('d-none')
            $('#employer').removeClass('d-none')
            render('emp');
        }

        $(document).ready(function () {
            if(localStorage.getItem('type') == 'candidate'){
                handleCandidateBtn();
            } else if(localStorage.getItem('type') == 'employer') {
                handleEmployerBtn();
            }
        });


        $('#candidate_btn').click(function(){
            handleCandidateBtn();
        });


        $('#employer_btn').click(function(){
            handleEmployerBtn()
        });
    </script>
@endpush
@include('includes.footer')

@endsection 