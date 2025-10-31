@extends('layouts.app')

@section('content') 

<!-- Header start --> 

@include('includes.header') 

<!-- Header end --> 

<!-- Inner Page Title start --> 

@include('includes.inner_page_title', ['page_title'=>__('Dashboard')]) 

<!-- Inner Page Title end -->

<div class="listpgWraper">
  <div class="container">@include('flash::message')
    <div class="row"> @include('includes.company_dashboard_menu')
      <div class="col-md-9 col-sm-8"> 
        @include('includes.company_dashboard_stats')
        <div class="userbtns">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item col-sm-4">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Job Posting</a>
            </li>
            <li class="nav-item col-sm-4">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">View CV’s</a>
            </li>
            <li class="nav-item col-sm-4">
              <a class="nav-link" id="both-tab" data-toggle="tab" href="#both" role="tab" aria-controls="both" aria-selected="false">Jobs Posting & View CV’s</a>
            </li>
          </ul>
        </div>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <?php
              if((bool)config('company.is_company_package_active')){        
                $packages = App\Package::where('package_for', 'like', 'job_seeker')->get();
                $package_id = Auth::guard('company')->user()->package_id;
                $package=App\Package::where('id',$package_id)->first();
                // dd($package);
            ?>
            <?php if(null !== $package){ ?>
              @include('includes.company_package_msg')
              @include('includes.company_packages_upgrade') 
            <?php }elseif(null !== $packages){ ?>
              @include('includes.company_packages_new')
            <?php }} ?>
          </div>
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <?php if((bool)config('company.is_company_package_active')){        
              $packages = App\Package::where('package_for', 'like', 'employer')->get();
              $package_id = Auth::guard('company')->user()->cvs_package_id;
              $package=App\Package::where('id',$package_id)->first();
            ?>
            <?php if(null !== $package){ ?>
              @include('includes.company_package_msg')
              @include('includes.company_packages_upgrade')
            <?php }elseif(null !== $packages){ ?>
              @include('includes.company_packages_new')
            <?php }} ?>
          </div>
          <div class="tab-pane fade" id="both" role="tabpanel" aria-labelledby="both-tab">
            <?php if((bool)config('company.is_company_package_active')){        
              $packages = App\Package::where('package_for', 'like', 'cv_search')->get();
              $package_id = Auth::guard('company')->user()->cvs_package_id;
              $package=App\Package::where('id',$package_id)->where('package_for', 'like', 'cv_search')->first();
              if($package==null){
                $package_id = Auth::guard('company')->user()->package_id;
                $package=App\Package::where('id',$package_id)->where('package_for', 'like', 'cv_search')->first();
              }
              
            ?>
            <?php if(null !== $package){ ?>
              @include('includes.company_package_msg')
              @include('includes.company_packages_upgrade')
            <?php }elseif(null !== $packages){ ?>
              @include('includes.company_packages_new')
            <?php }} ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@include('includes.footer')

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>

   var form_url  =  "{{ route('razorpayindex') }}";
  $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
    placeholder: "Select a state"
});

$(document).on("submit", "#data_access_selections", function(e){
    e.preventDefault();
   

    var formdata =  $(this).serialize();
    //var career_level_select  = $('.career_level_select').val();


    var form= $("#data_access_selections");

    $.ajax({
    type: form.attr('method'),
    url: form_url,
    data: formdata,
    success: function (data) {
      // console.log(data.errorArray);
      if (data.url) {
        window.location.href = data.url;
      }
      if(data.errorArray.job_position){
        $(".career_level_error").html(data.errorArray.job_position[0]);
        $(".career_level_error").delay(3000).fadeOut('slow');
      }   
      if(data.errorArray.industry){
        $(".industry_error").html(data.errorArray.industry[0]);
        $(".industry_error").delay(3000).fadeOut('slow');
      }
      if(data.errorArray.functional_area){
        $(".functional_area_error").html(data.errorArray.functional_area[0]);
        $(".functional_area_error").delay(3000).fadeOut('slow');
      }   
    }
});



    return  false;
});







function myFunction() {



console.log(career_level_select);

//var career_level_id = document.getElementsByName("career_level_id[]").value;
//var industry_id = document.getElementsByName("industry_id[]").value;
//var functional_area_id = document.getElementsByName("functional_area_id[]").value;
// Returns successful data submission message when the entered information is stored in database.
//alert(document.getElementsByName("career_level_id[]").value);
// AJAX code to submit form.
}
  </script>
@include('includes.immediate_available_btn')

@endpush

