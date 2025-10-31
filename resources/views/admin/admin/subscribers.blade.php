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
                <li> <span>Subscribers List</span> </li>
            </ul>
        </div>
        <!-- END PAGE BAR --> 
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Manage Subscribers </h3>
        <!-- END PAGE TITLE--> 
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12"> 
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">Subscriber(s)</span> </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <table class="table table-striped table-bordered table-hover"  id="admin_user_datatable_ajax">
                                <thead>
                                    <tr role="row" class="heading"> 
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Date Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
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
<script type = "text/JavaScript" src = "https://MomentJS.com/downloads/moment.js"></script>
<script>
    $(function () {
        $('#admin_user_datatable_ajax').DataTable({
            "order": [[0, "asc"]],
            processing: true,
            serverSide: true,
            stateSave: true,
            /*
             searching: false,
             paging: true,
             info: true,
             */
            ajax: '{!! route('fetch.data.admin.subscribers') !!}',
            columns: [
                /*{data: 'id_checkbox', name: 'id_checkbox', orderable: false, searchable: false},*/
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                { 'name': 'created_at.timestamp', 'data': { '_': 'created_at.display', 'sort': 'created_at' } }
            ]
        });
    });
</script> 
@endpush