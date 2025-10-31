@extends('layouts.app')

@push('metadetails')
<title>Understand Our Terms & Conditions Clearly | Reveri Jobs</title>
<meta name="title" content="Understand Our Terms & Conditions Clearly | Reveri Jobs">
<meta name="description" content="Navigate our terms & Conditions easily for a better understanding of our services and your rights.">
@endpush

@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end --> 
<!-- Inner Page Title start -->
@include('includes.inner_page_title', ['page_title'=>__('Terms & Conditions')])
<!-- Inner Page Title end -->
<div class="terms-wraper"> 
    <!-- About -->
    <div class="container">
        <div class="row py-4">
            <div class="col-md-12">
                {!! $siteSetting->terms !!}
            </div>
        </div>
    </div>
</div>
@include('includes.footer')
@endsection
