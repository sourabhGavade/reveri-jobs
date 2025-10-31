@extends('layouts.app')

@push('metadetails')
<meta name="title" content="Reveri Jobs - Food Industry Job!!">
<meta name="description" content="Explore leading jobs in the food sector at Reveri Jobs. Ideal for professionals seeking flexibility.">
<meta name="author" content="John Doe">
@endpush
@section('content') 

<!-- Header start --> 
@include('includes.header') 
<!-- Header end --> 
<!-- Inner Page Title start --> 
@include('includes.inner_page_title', ['page_title'=>__('Dashboard')]) 
<!-- Inner Page Title end -->
<div class="listpgWraper">
    <div class="container">@include('flash::message')
        <div class="row"> @include('includes.user_dashboard_menu')
            <div class="col-lg-9">
				@if(Auth::user()->mobile_num==null)
				<div class="container">
					<p class="my-2" style="color: #e83f6f;"><b>Please update your profile first.</b></p>
				</div>
				
				@endif
				<?php 
				    $getCv = DB::table('profile_cvs')->where('user_id',Auth::user()->id)->get();
				    if($getCv->count() == 0)
				    {
				?>
				<div class="container">
				    <p class="my-2" style="color: #e83f6f;"><b>Please upload CV for making your profile visible to companies.</p>
				</div>
				<?php } ?>
		<div class="profileban">
			<div class="abtuser">
				<div class="row">
					<div class="col-lg-2 col-md-2">
						<div class="uavatar">{{auth()->user()->printUserImage()}}</div>
					</div>
					<div class="col-lg-10 col-md-10">
						<div class="row">
							<div class="col-lg-7">
								<h4>{{auth()->user()->name}}</h4> 
								<h6><i class="fa fa-map-marker" aria-hidden="true"></i> {{Auth::user()->getLocation()}}</h6>
							</div>
							<div class="col-lg-5"><div class="editbtbn"><a href="{{ route('my.profile') }}"><i class="fas fa-pencil-alt" aria-hidden="true"></i> Edit Profile</a>
						</div></div>
						</div>

						<ul class="row userdata">
							<li class="col-lg-6 col-md-6"><i class="fa fa-phone" aria-hidden="true"></i> {{auth()->user()->mobile_num}}</li>							
							<li class="col-lg-6 col-md-6"><i class="fa fa-envelope" aria-hidden="true"></i> {{auth()->user()->email}}</li>
						</ul>

					</div>
				</div>
			</div>
		</div>
				
				
				
				
				
				
				
				
				
				
				
				
				{{-- @include('includes.user_dashboard_stats') --}}
                {{-- @if((bool)config('jobseeker.is_jobseeker_package_active'))
                @php        
                $packages = App\Package::where('package_for', 'like', 'job_seeker')->get();
                $package = Auth::user()->getPackage();
                if(null !== $package){
                $packages = App\Package::where('package_for', 'like', 'job_seeker')->where('id', '<>', $package->id)->where('package_price', '>=', $package->package_price)->get();
                }
                @endphp

                @if(null !== $package)
                @include('includes.user_package_msg')
                @include('includes.user_packages_upgrade')
                @else

                @if(null !== $packages)
                @include('includes.user_packages_new')
                @endif
                @endif
                @endif  --}}
			
			
			 <div class="row">
                        <div class="col-lg-7">
                            <div class="profbox">
                                <h3><i class="fa fa-black-tie" aria-hidden="true"></i> Recommended Jobs</h3>
                                <ul class="recomndjobs">
                                    @if(null!==($matchingJobs)) @foreach($matchingJobs as $match)
                                    <li>
                                        <h4><a href="{{route('job.detail', [$match->slug])}}">{{$match->title}}</a></h4>
										
                                        <p>{{($match->getCompany()!=null)?$match->getCompany()->name:''}}</p>
                                    </li>
                                    @endforeach @endif
                                </ul>
                            </div>
                        </div>

                   <div class="col-lg-5">
							<div class="profbox followbox">
								<h3><i class="fa fa-users"></i> My Followings</h3>

								<ul class="followinglist">
									@if(isset($followers) && null!==($followers)) @foreach($followers as $follow) @php $company = DB::table('companies')->where('slug',$follow->company_slug)->where('is_active',1)->first(); @endphp
									<li>
										<span>{{$company->name}}</span>
										<p>{{$company->location}}</p>
										<a href="{{route('company.detail',$company->slug)}}">{{__('View Details')}}</a>
									</li>
									@endforeach @endif

								</ul>

								<div class="allbtn"><a href="{{route('my.followings')}}"><i class="fas fa-users"></i> View All</a>
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
@push('scripts')
@include('includes.immediate_available_btn')
@endpush