@if($packages->count())
<style>

	.select2-container {
		display:block!important;
	}	
	</style>
<div class="paypackages"> 

    <!---four-paln-->

    <div class="four-plan">

        <h3>{{__('Upgrade Package')}}</h3>

        <div class="row"> @foreach($packages as $package)

            <div class="col-md-4 col-sm-6 col-xs-12">

                <ul class="boxes">

                    <li class="plan-name">{{$package->package_title}}</li>

                    <li>

                        <div class="main-plan">

                            <div class="plan-price1-1">INR</div>

                            <div class="plan-price1-2">{{$package->package_price}}</div>

                            <div class="clearfix"></div>

                        </div>

                    </li>

                    @if($package->package_for=='job_seeker')
                    <li class="plan-pages">{{__('Job Postings')}} : {{$package->package_num_listings}}</li>
					@else
					<li class="plan-pages">{{__('CV Access')}} : {{$package->num_data_access}}</li>
					@endif

                    <li class="plan-pages">{{__('Package Duration')}} : {{$package->package_num_days}} {{__('Days')}}</li>

                    <li class="order paypal"><a href="javascript:void(0)" data-toggle="modal" data-target="#buypack{{$package->id}}" class="reqbtn">{{__('Buy Now')}}</a></li>

                </ul>
				
				
				<div class="modal fade" id="buypack{{$package->id}}" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
					<div class="modal-body">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<i class="fa fa-times"></i>
							</button>
							
							{!! Form::model(null, array('method' => 'post','class' => 'form ', 'id' => 'data_access_selections' ,'files'=>true)) !!}
							<div class="invitereval">
								<h3>Please Choose Your Payment Method to Pay</h3>	
			
								<div class="totalpay">{{__('Total Amount to pay')}}: <strong>{{$package->package_price}}</strong></div>
								<input type="hidden" value={{$package->id}} name="package_id">
								@if($package->package_for!='job_seeker')
								<div class="col-md-12">
									
									<div class="formrow mb-2 {!! APFrmErrHelp::hasError($errors, 'career_level_id') !!}">
										<label style="margin-bottom: 5px;font-weight: 600;">Job Position</label>
										{!! Form::select('job_position[]',$careerLevels, null, array('class'=>'form-control ajax_message career_level_select js-example-basic-multiple', 'id'=>'career_level_id','multiple'=>'multiple')) !!}
										{!! APFrmErrHelp::showErrors($errors, 'career_level_id[]') !!} 
										<div class="career_level_error"  style="color:red;"></div>
									</div>
								</div>								
								<div class="col-md-12">
									
									<div class="formrow mb-2  {!! APFrmErrHelp::hasError($errors, 'industry_id') !!}">
										<label style="margin-bottom: 5px;font-weight: 600;">Industry</label>
										{!! Form::select('industry[]',$industries, null, array('class'=>'form-control  ajax_message js-example-basic-multiple', 'id'=>'industry_id','multiple'=>'multiple')) !!}
										{!! APFrmErrHelp::showErrors($errors, 'industry_id[]') !!} </div>
										<div class="industry_error" style="color:red;"></div>
								</div>
								<div class="col-md-12">
									<div class="formrow mb-2  {!! APFrmErrHelp::hasError($errors, 'functional_area_id') !!}">
									<label style="margin-bottom: 5px;font-weight: 600;">Functional Area</label>
										{!! Form::select('functional_area[]',$functionalAreas, null, array('class'=>'form-control ajax_message js-example-basic-multiple', 'id'=>'functional_area_id','multiple'=>'multiple')) !!}
										{!! APFrmErrHelp::showErrors($errors, 'functional_area_id[]') !!} </div>
										<div class="functional_area_error"  style="color:red;"></div>
								</div>
								@endif
								<div class="col-md-12">
									<div class="btn btn-success"><button type="submit"  class="btn">{{__('Proceed')}}  <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button></div>
								</div>
							</div>
							{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
				

            </div>

            @endforeach </div>

    </div>

    <!---end four-paln--> 

</div>

@endif
 