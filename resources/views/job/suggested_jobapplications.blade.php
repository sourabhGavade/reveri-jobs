@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end --> 
<!-- Inner Page Title start -->
@include('includes.inner_page_title', ['page_title'=>__('Job Applications')])
<!-- Inner Page Title end -->
<style>
      input.suggested_request {
        width: 20px;
        height: 20px;
      }
    </style>
<div class="listpgWraper">
    <div class="container">
        <div class="row">
            @include('includes.company_dashboard_menu')

            <div class="col-md-9 col-sm-8"> 
                <div class="myads">
                @include('flash::message')  
                    <div class="row m-2">
                        <div class="col-md-4 col-sm-4">
                            <h3>{{__('Job Applications')}}</h3>
                        </div>
                        <div class="col-md-4 col-sm-4"></div>
                        <div class="col-md-4 col-sm-4">
                            <button type="button" id="SendRequest" class="btn btn-success pull-right" >Send Request <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <ul class="searchList">
                        <!-- job start --> 
                        @if(isset($job_applications) && count($job_applications))
                        @foreach($job_applications as $job_application)
                        @php
                        $user = $job_application->getUser();
                        $job = $job_application->getJob();
                        $company = $job->getCompany();             
                        $profileCv = $job_application->getProfileCv();
                        @endphp
                        @if(null !== $job_application && null !== $user && null !== $job && null !== $company && null !== $profileCv)
                        
                        <li>       
                            <div class="row">
                            <div class="col-md-1 col-sm-1">
                            <input type="checkbox" class="suggested_request" name="suggested_request" value="{{$user->id}}" >
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="jobimg">{{$user->printUserImage(100, 100)}}</div>
                                    <div class="jobinfo">
                                        <h3><a href="{{route('applicant.profile', $job_application->id)}}">{{$user->getName()}}</a></h3>
                                        <div class="location"> {{$user->getLocation()}}</div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="minsalary">{{$job_application->expected_salary}} {{$job_application->salary_currency}} <span>/ {{$job->getSalaryPeriod('salary_period')}}</span></div>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <div class="listbtn"><a href="{{route('applicant.profile', $job_application->id)}}">{{__('View Profile')}}</a></div>
                                </div>
                            </div>
                            <p>{{\Illuminate\Support\Str::limit($user->getProfileSummary('summary'),150,'...')}}</p>
                        </li>
                        <!-- job end --> 
                        @endif
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes.footer')
@endsection
@push('scripts') 
<script type="text/javascript">
     $('#SendRequest').click(function(){
        var val = [];
        $(':checkbox:checked').each(function(i){
          val[i] = $(this).val();
        });
        SendRequest(val);
      });
      function SendRequest(val)
    {
        $.ajax({
            type: 'POST',
            url: "{{ route('save.suggested.candidates') }}",
            data:{users_ids:val,job_id:'{{$job_id}}', _token: '{{ csrf_token() }}'},
            success: function (data)
            {
            response = JSON.parse(data);
            var res = response.success;
            if (res == 'success')
            {
                location.reload();
            } 
            },
    });
    }
</script>
@endpush