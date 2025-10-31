@extends('layouts.app')
@section('content') 
<!-- Header start --> 
@include('includes.header') 
<!-- Header end --> 
<!-- Inner Page Title start --> 
@include('includes.inner_page_title', ['page_title'=>__('Head Hunting')])
<!-- Inner Page Title end -->
<div class="listpgWraper">
    <div class="container">
        <div class="row">
            @include('includes.company_dashboard_menu')

            <div class="col-md-9 col-sm-8"> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="userccount">
                            <div class="formpanel mt0"> @include('flash::message') 
                                <!-- Personal Information -->
                                <form method="post" action="{{ route('head.hunting.store')}}" name="contactform" id="headhuntingform">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-6 mb-2{{ $errors->has('register') ? ' has-error' : '' }}">                  
                                            {!! Form::text('register', null, array('class'=>'form-control', 'id'=>'register', 'placeholder'=>__('Register'), 'style'=>'font-size: 16px;','autofocus'=>'autofocus')) !!}                
                                            @if ($errors->has('register')) <span class="help-block"> <strong>{{ $errors->first('register') }}</strong> </span> @endif
                                        </div>
                                        <div class="col-md-6 mb-2{{ $errors->has('company_name') ? ' has-error' : '' }}">                  
                                            {!! Form::text('company_name', null, array('class'=>'form-control', 'id'=>'company_name', 'placeholder'=>__('Company Name'),  'style'=>'font-size: 16px;')) !!}                
                                            @if ($errors->has('company_name')) <span class="help-block"> <strong>{{ $errors->first('company_name') }}</strong> </span> @endif
                                        </div>
                                        <div class="col-md-6 mb-2{{ $errors->has('person') ? ' has-error' : '' }}">                  
                                            {!! Form::text('person', null, array('class'=>'form-control', 'id'=>'person',  'style'=>'font-size: 16px;','placeholder'=>__('Contact Person'))) !!}                
                                            @if ($errors->has('person')) <span class="help-block"> <strong>{{ $errors->first('person') }}</strong> </span> @endif
                                        </div>
                                        <div class="col-md-6 mb-2{{ $errors->has('email') ? ' has-error' : '' }}">                  
                                            {!! Form::text('email', null, array('class'=>'form-control', 'id'=>'email', 'placeholder'=>__('Email Id'),  'style'=>'font-size: 16px;')) !!}                
                                            @if ($errors->has('email')) <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span> @endif
                                        </div>
                                        <div class="col-md-6 mb-2{{ $errors->has('contact') ? ' has-error' : '' }}">                  
                                            {!! Form::text('contact', null, array('class'=>'form-control', 'id'=>'contact',  'style'=>'font-size: 16px;','placeholder'=>__('Contact Number') )) !!}                
                                            @if ($errors->has('contact')) <span class="help-block"> <strong>{{ $errors->first('contact') }}</strong> </span> @endif
                                        </div>
                                        <div class="col-md-6 mb-2{{ $errors->has('designation') ? ' has-error' : '' }}">                  
                                            {!! Form::text('designation', null, array('class'=>'form-control', 'id'=>'designation',  'style'=>'font-size: 16px;','placeholder'=>__('Designation'))) !!}                
                                            @if ($errors->has('designation')) <span class="help-block"> <strong>{{ $errors->first('designation') }}</strong> </span> @endif
                                        </div>
                                        <div class="col-md-6 mb-2{{ $errors->has('qualification') ? ' has-error' : '' }}">                  
                                            {!! Form::text('qualification', null, array('class'=>'form-control', 'id'=>'qualification',  'style'=>'font-size: 16px;','placeholder'=>__('Qualification') )) !!}                
                                            @if ($errors->has('qualification')) <span class="help-block"> <strong>{{ $errors->first('qualification') }}</strong> </span> @endif
                                        </div>
                                        <div class="col-md-6 mb-2{{ $errors->has('experience') ? ' has-error' : '' }}">                  
                                            {!! Form::text('experience', null, array('class'=>'form-control', 'id'=>'experience', 'style'=>'font-size: 16px;','placeholder'=>__('Experience'))) !!}                
                                            @if ($errors->has('experience')) <span class="help-block"> <strong>{{ $errors->first('experience') }}</strong> </span> @endif
                                        </div>
                                        <div class="col-md-6 mb-2{{ $errors->has('job_profile') ? ' has-error' : '' }}">                  
                                            {{-- {!! Form::text('job_profile', null, array('id'=>'job_profile', 'placeholder'=>__('Job Profile'), )) !!}                 --}}
                                            {!! Form::select('job_experience_id', [''=>__('Select Job Postion')]+$careerLevels, null, array('class'=>'form-control', 'id'=>'job_experience_id','style'=>'margin-bottom: 15px;color: #8c8c8c;')) !!}
                                            @if ($errors->has('job_profile')) <span class="help-block"> <strong>{{ $errors->first('job_profile') }}</strong> </span> @endif
                                        </div>
                                        <div class="col-md-6 mb-2{{ $errors->has('industry') ? ' has-error' : '' }}">                  
                                            {!! Form::select('industry', [''=>__('Select Industry')]+$industries, null, array('class'=>'form-control', 'id'=>'industry_id','style'=>'margin-bottom: 15px;color: #8c8c8c;')) !!}
                                            @if ($errors->has('industry')) <span class="help-block"> <strong>{{ $errors->first('industry') }}</strong> </span> @endif
                                        </div><br/>
                                        <div class="col-md-6 mb-2{{ $errors->has('functional_area') ? ' has-error' : '' }}">                  
                                            {!! Form::select('functional_area', [''=>__('Select Functional Area')]+$functionalAreas, null, array('class'=>'form-control', 'id'=>'job_experience_id','style'=>'margin-bottom: 15px;color: #8c8c8c;')) !!}             
                                            @if ($errors->has('functional_area')) <span class="help-block"> <strong>{{ $errors->first('functional_area') }}</strong> </span> @endif
                                        </div>
                                        <div class="col-md-6 mb-2{{ $errors->has('target_indusrty') ? ' has-error' : '' }}">                  
                                            {!! Form::text('target_indusrty', null, array('class'=>'form-control', 'id'=>'target_indusrty', 'style'=>'font-size: 16px;','placeholder'=>__('Name of Industry to Target') )) !!}                
                                            @if ($errors->has('target_indusrty')) <span class="help-block"> <strong>{{ $errors->first('target_indusrty') }}</strong> </span> @endif
                                        </div>
                                        <div class="col-md-6 mb-2{{ $errors->has('target_designation') ? ' has-error' : '' }}">                  
                                            {!! Form::text('target_designation', null, array('class'=>'form-control', 'id'=>'target_designation', 'style'=>'font-size: 16px;', 'placeholder'=>__('Target Designation'))) !!}                
                                            @if ($errors->has('target_designation')) <span class="help-block"> <strong>{{ $errors->first('target_designation') }}</strong> </span> @endif
                                        </div>
                                        <div class="col-md-6 mb-2{{ $errors->has('target_salary') ? ' has-error' : '' }}">                  
                                            {!! Form::text('target_salary', null, array('class'=>'form-control', 'id'=>'target_salary', 'style'=>'font-size: 16px;', 'placeholder'=>__('Target Salary') )) !!}                
                                            @if ($errors->has('target_salary')) <span class="help-block"> <strong>{{ $errors->first('target_salary') }}</strong> </span> @endif
                                        </div>
                                        <div class="col-md-12 text-center formrow">
                                            <button class="button btn btn-success" type="submit" id="submit">{{__('Submit Now')}}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes.footer')
@endsection
@push('styles')
<style type="text/css">
    .userccount p{ text-align:left !important;}
</style>
@endpush







