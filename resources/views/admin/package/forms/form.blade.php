{!! APFrmErrHelp::showOnlyErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'package_title') !!}"> {!! Form::label('package_title', 'Package Title', ['class' => 'bold']) !!}
        {!! Form::text('package_title', null, array('class'=>'form-control', 'id'=>'package_title', 'placeholder'=>'Package Title')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'package_title') !!} </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'package_price') !!}"> {!! Form::label('package_price', 'Package Price(In USD)', ['class' => 'bold']) !!}
        {!! Form::text('package_price', null, array('class'=>'form-control', 'id'=>'package_price', 'placeholder'=>'Package Price')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'package_price') !!} </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'package_num_days') !!}"> {!! Form::label('package_num_days', 'Package num days', ['class' => 'bold']) !!}
        {!! Form::text('package_num_days', null, array('class'=>'form-control', 'id'=>'package_num_days', 'placeholder'=>'Package num days')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'package_num_days') !!} </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'package_num_listings') !!}" id="package_num_listing"> {!! Form::label('package_num_listings', 'Package num listings*', ['class' => 'bold']) !!}
        {!! Form::text('package_num_listings', null, array('class'=>'form-control', 'id'=>'package_num_listings', 'placeholder'=>'Package num listings')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'package_num_listings') !!}
        *On how many jobs a job seeker can apply<br />
        **How many jobs an employer can post </div>

     <div  id="for_cv_employer">
      <div class="form-group {!! APFrmErrHelp::hasError($errors, 'num_job_position') !!}"> {!! Form::label('num_job_position', 'Num Job Position', ['class' => 'bold']) !!}
        {!! Form::text('num_job_position', null, array('class'=>'form-control', 'id'=>'num_job_position', 'placeholder'=>'Num Job Position')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'num_job_position') !!}
      </div>

      <div class="form-group {!! APFrmErrHelp::hasError($errors, 'num_functional_area') !!}"> {!! Form::label('num_functional_area', 'Num Functional Area', ['class' => 'bold']) !!}
        {!! Form::text('num_functional_area', null, array('class'=>'form-control', 'id'=>'num_functional_area', 'placeholder'=>'Num Functional Area')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'num_functional_area') !!}
      </div>

      <div class="form-group {!! APFrmErrHelp::hasError($errors, 'num_industry') !!}"> {!! Form::label('num_industry', 'Num Industry', ['class' => 'bold']) !!}
        {!! Form::text('num_industry', null, array('class'=>'form-control', 'id'=>'num_industry', 'placeholder'=>'Num Industry')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'num_industry') !!}
      </div>

      <div class="form-group {!! APFrmErrHelp::hasError($errors, 'num_data_access') !!}"> {!! Form::label('num_data_access', 'Num Data Access', ['class' => 'bold']) !!}
        {!! Form::text('num_data_access', null, array('class'=>'form-control', 'id'=>'num_data_access', 'placeholder'=>'Num Data Access')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'num_data_access') !!}
      </div>
   </div>


    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'package_for') !!}">
        {!! Form::label('package_for', 'Package for?', ['class' => 'bold']) !!}
        <div class="radio-list" >
            <?php
            $package_for_1 = 'checked="checked"';
            $package_for_2 = '';
            $package_for_3 = '';
            if (old('package_for', ((isset($package)) ? $package->package_for : 'job_seeker')) == 'employer') {
                $package_for_1 = '';
                $package_for_2 = 'checked="checked"';
                $package_for_3 = '';
            }
            if (old('package_for', ((isset($package)) ? $package->package_for : 'cv_search')) == 'cv_search') {
                $package_for_1 = '';
                $package_for_2 = '';
                $package_for_3 = 'checked="checked"';
            }
            ?>
            <label class="radio-inline">
                <input id="job_seeker" name="package_for" type="radio" value="job_seeker" {{$package_for_1}}>
                Job Posting </label>
            <label class="radio-inline">
                <input id="employer" name="package_for" type="radio" value="employer" {{$package_for_2}}>
                View CV's </label>
            <label class="radio-inline">
                <input id="cv_search" name="package_for" type="radio" value="cv_search" {{$package_for_3}}>
                Job Posting & View CV's</label>
        </div>
        {!! APFrmErrHelp::showErrors($errors, 'package_for') !!}
    </div>


    <div class="form-actions"> {!! Form::button('Update <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!} </div>
</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
<script >
        // $('#for_cv_employer').hide();
        
        $(document).ready(function () {                            
            // event.preventDefault();
            if ($("#employer").is(":checked")) {
                // alert();
                $('#package_num_listing').hide();
                $('#for_cv_employer').show();
            }
            else if ($("#cv_search").is(":checked")) {
                $('#package_num_listing').show();
                $('#for_cv_employer').show();
            }
            else {
                $('#for_cv_employer').hide();
                $('#package_num_listing').show();
            }
            $("#employer").click(function(){
                $('#package_num_listing').hide();
                $('#for_cv_employer').show();
            });
            $("#cv_search").click(function(){
                $('#package_num_listing').show();
                $('#for_cv_employer').show();
            });
            $("#job_seeker").click(function(){
                $('#package_num_listing').show();
                $('#for_cv_employer').hide();
            });
        });


         




</script>


