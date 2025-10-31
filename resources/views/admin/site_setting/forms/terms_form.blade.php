{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'terms') !!}">
        {!! Form::label('terms', $siteSetting->terms, ['class' => 'bold']) !!}                    
        {!! Form::textarea($siteSetting->terms, null, array('class'=>'form-control', 'id'=>'terms', 'placeholder'=>'Terms')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'terms') !!}                                       
    </div>
</div>
