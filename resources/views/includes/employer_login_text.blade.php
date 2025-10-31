@if(!Auth::user() && !Auth::guard('company')->user())
<div class="emploginbox">
	<div class="container">		
		<div class="titleTop">
			<div class="subtitle">{{__('Are You Looking For Candidates!')}}</div>
           <h3 class="mt-4">{{__('Post a Job Today')}}  </h3>
			<!-- <h4>{{__('and hire the right Candidates')}}</h4> -->
        </div>
		<p>Our specialization sets us apart from other competitors who have no knowledge and experience of the requirement of the food Industry</p>
		<div class="viewallbtn"><a href="{{route('register')}}">{{__('Post a Job')}}</a></div>
	</div>
</div>
@endif