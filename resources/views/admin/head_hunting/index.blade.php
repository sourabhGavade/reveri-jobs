@extends('admin.layouts.admin_layout')
@section('content')
<style type="text/css">
    .table td, .table th {
        font-size: 12px;
        line-height: 2.42857 !important;		
    }
</style>
<div class="page-content-wrapper"> 
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content"> 
        <!-- BEGIN PAGE HEADER--> 
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li> <a href="{{ route('admin.home') }}">Home</a> <i class="fa fa-circle"></i> </li>
                <li> <span>C.M.S</span> </li>
            </ul>
        </div>
        <!-- END PAGE BAR --> 
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">Manage C.M.S <small>C.M.S</small> </h3>
        <!-- END PAGE TITLE--> 
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12"> 
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">C.M.S</span> </div>
                        <div class="actions"> <a href="{{ route('create.cms') }}" class="btn btn-xs btn-succes"><i class="glyphicon glyphicon-plus"></i> Add New C.M.S Page</a> </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <form method="post" role="form" id="cms-search-form">
                                <table class="table table-striped table-bordered table-hover"  id="cms_datatable_ajax">
                                    <thead>
                                        <!-- <tr role="row" class="filter">
                                            <td><input type="text" class="form-control" name="id" id="id" autocomplete="off"></td>
                                            <td><input type="text" class="form-control" name="page_slug" id="page_slug" autocomplete="off"></td>
                                            <td></td>
                                        </tr> -->
                                        <tr role="row" class="heading">
                                            <th>Id</th>
                                            <th>Register</th>
                                            <th>Company Name</th>
                                            <th>Contact Person</th>
                                            <!-- <th>Email Id</th>
                                            <th>Contact Number</th> -->
                                            <th>Designation</th>
                                            <th>Qualification</th>
                                            <th>Experience</th>
                                            <!-- <th>Job Profile</th>
                                            <th>Industry</th>
                                            <th>Functional Area</th> -->
                                            <th>Target Industry</th>
                                            <th>Target Designation</th>
                                            
                                        </tr>
                                        @foreach($data as $v)
                                        <tr>
                                            <td>{{$v->id}}</td>
                                            <td>{{$v->register}}</td>
                                            <td>{{$v->company_name}}</td>
                                            <td>{{$v->contact_person}}</td>
                                            <!-- <td>{{$v->email_id}}</td>
                                            <td>{{$v->contact_number}}</td> -->
                                            <td>{{$v->designation}}</td>
                                            <td>{{$v->qualification}}</td>
                                            <td>{{$v->experience}}</td>
                                            <!-- <td>{{$v->job_profile}}</td>
                                            <td>{{$v->industry}}</td>
                                            <td>{{$v->functional_area}}</td> -->
                                            <td>{{$v->target_industry}}</td>
                                            <td>{{$v->target_designation}}</td>
                                            
                                        </tr>
                                        @endforeach
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY --> 
</div>
@endsection
@push('scripts') 

@endpush