<div class="instoretxt">
    <div class="credit">{{__('Your Package is')}}: <strong>{{$package->package_title}} - {{ $siteSetting->default_currency_code }}{{$package->package_price}}</strong></div>
    @if($package->package_for=='job_seeker')
        <div class="credit">{{__('Package Duration')}} : <strong>{{Carbon\Carbon::parse(Auth::guard('company')->user()->package_start_date)->format('Y-m-d')}}</strong> - <strong>{{Carbon\Carbon::parse(Auth::guard('company')->user()->package_end_date)->format('Y-m-d')}}</strong></div>
        <div class="credit">{{__('Availed Job quota')}} : <strong>{{Auth::guard('company')->user()->availed_jobs_quota}}</strong> / <strong>{{Auth::guard('company')->user()->jobs_quota}}</strong></div>  
    @else 
        @if($package->package_for=='employer')
        <div class="credit">{{__('Package Duration')}} : <strong>{{Carbon\Carbon::parse(Auth::guard('company')->user()->cvs_package_start_date)->format('Y-m-d')}}</strong> - <strong>{{Carbon\Carbon::parse(Auth::guard('company')->user()->cvs_package_end_date)->format('Y-m-d')}}</strong></div>
        <div class="credit">{{__("Availed CV's quota")}} : <strong>{{Auth::guard('company')->user()->availed_cvs_quota}}</strong> / <strong>{{Auth::guard('company')->user()->cvs_quota}}</strong></div>
            
        @else
        <div class="credit">{{__('Package Duration')}} : <strong>{{Carbon\Carbon::parse(Auth::guard('company')->user()->package_start_date)->format('Y-m-d')}}</strong> - <strong>{{Carbon\Carbon::parse(Auth::guard('company')->user()->package_end_date)->format('Y-m-d')}}</strong></div>
        <div class="credit">{{__('Availed Job quota')}} : <strong>{{Auth::guard('company')->user()->availed_jobs_quota}}</strong> / <strong>{{Auth::guard('company')->user()->jobs_quota}}</strong></div>  
        <div class="credit">{{__("Availed CV's quota")}} : <strong>{{Auth::guard('company')->user()->availed_cvs_quota}}</strong> / <strong>{{Auth::guard('company')->user()->cvs_quota}}</strong></div> 
        @endif
    @endif
</div>
