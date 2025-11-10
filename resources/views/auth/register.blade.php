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

        @php
            $usertype = request()->query('usertype', '');
        @endphp
        
           <div class="useraccountwrap">

                <div class="userccount">

                @if($usertype == 'candidate')
                        <h3 class="text-center mb-5">Candidate Registration</h3>
                @elseif($usertype == 'employer')    
                        <h3 class="text-center mb-5">Employer Registration</h3>
                @endif                    

                    <div class="tab-content">

                        <div id="candidate" class="formpanel {{ $usertype == 'candidate' ? '' : 'd-none' }}">

                            <form class="form-horizontal candidate_form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">

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

                                <div class="formrow{{ $errors->has('cv_file') ? ' has-error' : '' }}">
                                    <label for="">{{__('Upload CV')}} <b class="text-danger">*</b></label>
                                    <input type="file" name="cv_file" class="form-control" required="required" accept=".pdf,.doc,.docx">
                                    <small class="form-text text-muted">{{__('Allowed formats: PDF, DOC, DOCX (Max: 5MB)')}}</small>
                                </div>
                                    
                                @if ($errors->has('cv_file'))
                                    <div class="help-block mb-3">
                                        <strong style="color:red;font-weight:600;">{{ $errors->first('cv_file') }}</strong>
                                    </div>
                                @endif

                                <div class="formrow{{ $errors->has('is_subscribed') ? ' has-error' : '' }} d-flex align-items-center mb-3">
                                    <?php
                                    $is_checked = '';
                                    if (old('is_subscribed', 1)) {
                                        $is_checked = 'checked="checked"';
                                    }
                                    ?>
                                    <input type="checkbox" value="1" name="is_subscribed" {{$is_checked}} id="candidate_subscribe" style="width: auto; margin-right: 8px;" />
                                    <label for="candidate_subscribe" class="mb-0">{{__('Subscribe to our newsletter')}}</label>
                                    
                                    @if ($errors->has('is_subscribed')) <span class="help-block"> <strong>{{ $errors->first('is_subscribed') }}</strong> </span> @endif
                                </div>

                                <div class="formrow{{ $errors->has('terms_of_use') ? ' has-error' : '' }} d-flex align-items-center mb-3">
                                    <input type="checkbox" required value="1" name="terms_of_use" id="candidate_terms" style="width: auto; margin-right: 8px;" />
                                    <label for="candidate_terms" class="mb-0"><a href="{{url('cms/terms-of-use')}}">{{__('I accept Terms of Use')}}</a></label>
                                </div>
                                @if ($errors->has('terms_of_use'))
                                    <div class="help-block mb-3">
                                        <strong style="color:red;font-weight:600;">{{ $errors->first('terms_of_use') }}</strong>
                                    </div>
                                @endif
                                
                                <div class="row justify-content-center">
                                    <div id="recaptcha-container" class="my-3"></div>
                                </div>
                             

                                <input type="submit" class="btn" id="candidate_form" disabled value="{{__('Register')}}">

                            </form>

                        </div>

                        <div id="employer" class="formpanel {{ $usertype == 'employer' ? '' : 'd-none' }}">

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

                                <div class="formrow{{ $errors->has('is_subscribed') ? ' has-error' : '' }} d-flex align-items-center mb-3">
                                    <?php
                                    $is_checked = '';
                                    if (old('is_subscribed', 1)) {
                                        $is_checked = 'checked="checked"';
                                    }
                                    ?>
                                    <input type="checkbox" value="1" name="is_subscribed" {{$is_checked}} id="employer_subscribe" style="width: auto; margin-right: 8px;" />
                                    <label for="employer_subscribe" class="mb-0">{{__('Subscribe to our newsletter')}}</label>

                                    @if ($errors->has('is_subscribed')) <span class="help-block"> <strong>{{ $errors->first('is_subscribed') }}</strong> </span> @endif
                                </div>

                                <div class="formrow{{ $errors->has('terms_of_use') ? ' has-error' : '' }} d-flex align-items-center mb-3">
                                    <input type="checkbox" required value="1" name="terms_of_use" id="employer_terms" style="width: auto; margin-right: 8px;" />
                                    <label for="employer_terms" class="mb-0"><a href="{{url('terms-of-use')}}">{{__('I accept Terms of Use')}}</a></label>
                                </div>
                                
                                @if ($errors->has('terms_of_use'))
                                    <div class="help-block mb-3">
                                        <strong style="color:red;font-weight:600;">{{ $errors->first('terms_of_use') }}</strong>
                                    </div>
                                @endif
                                
                                <div class="row justify-content-center">
                                    <div id="recaptcha-container1" class="my-3"></div>
                                </div>
                            

                                <input type="submit" id="employer_form" class="btn" disabled value="{{__('Register')}}">

                            </form>

                        </div>

                    </div>

                    <!-- sign up form -->

                    <div class="newuser"><i class="fa fa-user" aria-hidden="true"></i> {{__('Have Account')}}? <a href="{{ route('login') }}{{ $usertype ? '?usertype=' . $usertype : '' }}">{{__('Sign in')}}</a></div>

                    <!-- sign up form end--> 


                </div>

            </div>

        

    </div>

</div>

@push('scripts')
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
    <script>
        var usertypeParam = "{{ $usertype }}";
        var recaptchaRendered = false;
        var currentFormType = '';
        
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
        
        function recaptchaCallback() {
            // Enable the appropriate submit button based on current form type
            if(currentFormType == 'emp')
            {
                $('#employer_form').removeAttr('disabled');
            }else{
                $('#candidate_form').removeAttr('disabled');
            }
        };
        
        function resetRecaptcha()
        {
            if(window.recaptchaVerifier) {
                window.recaptchaVerifier.clear();
            }
            $('#employer_form').attr('disabled',true);
            $('#candidate_form').attr('disabled',true);
            recaptchaRendered = false;
        }
        
        function render(type) {
            // Prevent rendering multiple times
            if(recaptchaRendered) {
                return;
            }
            
            currentFormType = type;
            
            if(type == 'emp')
            {
                window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container1', {
                  'size': 'normal',
                  'callback': function(response) {
                    recaptchaCallback();
                  },
                  'expired-callback': function() {
                    resetRecaptcha();
                  }
                });
            }else{
                window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
                  'size': 'normal',
                  'callback': function(response) {
                    recaptchaCallback();
                  },
                  'expired-callback': function() {
                    resetRecaptcha();
                  }
                });
            }
            
            try {
                recaptchaVerifier.render().then(function(widgetId) {
                    window.recaptchaWidgetId = widgetId;
                    recaptchaRendered = true;
                });
            } catch(error) {
                console.error('Error rendering reCAPTCHA:', error);
            }
        }
        
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
            $('#candidate_btn').addClass('active');
            $('#candidate_btn').parent().removeClass('col-6');
            $('#candidate_btn').parent().addClass('col-12');
            $('#employer_btn').addClass('d-none');
            $('#category').addClass('d-none');
            $('#candidate').removeClass('d-none');
            
            // Small delay to ensure container is visible before rendering
            setTimeout(function() {
                if(!recaptchaRendered) {
                    render('can');
                }
            }, 100);
        }
        
        function handleEmployerBtn() {
            localStorage.setItem('type','employer');
            $('#employer_btn').addClass('active');
            $('#employer_btn').parent().removeClass('col-6');
            $('#employer_btn').parent().addClass('col-12');
            $('#candidate_btn').addClass('d-none');
            $('#category').addClass('d-none');
            $('#employer').removeClass('d-none');
            
            // Small delay to ensure container is visible before rendering
            setTimeout(function() {
                if(!recaptchaRendered) {
                    render('emp');
                }
            }, 100);
        }

        $(document).ready(function () {
            // Check URL parameter first, then fallback to localStorage
            if(usertypeParam == 'candidate'){
                handleCandidateBtn();
            } else if(usertypeParam == 'employer') {
                handleEmployerBtn();
            } else if(localStorage.getItem('type') == 'candidate'){
                handleCandidateBtn();
            } else if(localStorage.getItem('type') == 'employer') {
                handleEmployerBtn();
            }
        });

        $('#candidate_btn').click(function(){
            handleCandidateBtn();
        });

        $('#employer_btn').click(function(){
            handleEmployerBtn();
        });
    </script>
@endpush
@include('includes.footer')

@endsection
