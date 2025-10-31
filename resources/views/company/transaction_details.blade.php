@extends('layouts.app')

@section('content') 

<!-- Header start --> 

@include('includes.header') 

<!-- Header end --> 

<!-- Inner Page Title start --> 

@include('includes.inner_page_title', ['page_title'=>__('Transaction Details')]) 

<!-- Inner Page Title end -->

<div class="listpgWraper">

    <div class="container">

        <div class="row">

            @include('includes.company_dashboard_menu')



            <div class="col-md-9 col-sm-8"> 

                <div class="myads">

                    <h3>{{__('Transaction Details')}}</h3>

                    <ul class="searchList">

                        <!-- job start --> 

                        @if(isset($data) && count($data))

                        @foreach($data as $val)

                        <li>

                            <div class="row">

                                <div class="col-md-9 col-sm-9">

                                   

                                    <div class="jobinfo">

                                        <h3>{{$val->package_title}}</a></h3>

                                        <div class="location">Payment Status: {{$val->payment_status}}</div>

                                    </div>

                                    <div class="clearfix"></div>

                                </div>

                                <div class="col-md-3 col-sm-3">

                                    <div class="listbtn">Amount: {{$val->amount}}</div>

                                </div>

                            </div>

                            <p></p>

                        </li>

                        <!-- job end --> 

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