@extends('admin.layouts.admin_layout')
@section('content')
<style type="text/css">
    .table td, .table th {
        font-size: 12px;
        line-height: 2.42857 !important;
    }
    .table tbody tr td:nth-child(1) {
        text-align: center;
    }
    /* Success message styling */
    .alert-success {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        animation: slideIn 0.3s ease-out;
    }
    @keyframes slideIn {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
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
                <li> <span>Companies</span> </li>
            </ul>
        </div>
        <!-- END PAGE BAR --> 
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">Manage Companies <small>Companies</small> </h3>
        <!-- END PAGE TITLE--> 
        <!-- END PAGE HEADER-->
        
        <!-- Success Message Container -->
        <div id="success-message-container"></div>
        
        <div class="row">
            <div class="col-md-12"> 
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">Companies</span> </div>
                        <div class="actions">
                            <a href="{{ route('create.company') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Add New Company</a>
                            <button type="button" id="delete-selected" class="btn btn-xs btn-danger">
                                <i class="fa fa-trash"></i> <span id="delete-btn-text">Delete Selected</span>
                            </button>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <form method="post" role="form" id="datatable-search-form">
                                <table class="table table-striped table-bordered table-hover"  id="companyDatatableAjax">
                                    <thead>
                                        <tr role="row" class="filter">
                                            <td></td>
                                            <td></td>
                                            <td><input type="text" class="form-control" name="name" id="name" autocomplete="off" placeholder="Company Name"></td>
                                            <td><input type="text" class="form-control" name="email" id="email" autocomplete="off" placeholder="Company Email"></td>
                                            <td><select name="is_active" id="is_active" class="form-control">
                                                    <option value="-1">Is Active?</option>
                                                    <option value="1" selected="selected">Active</option>
                                                    <option value="0">In Active</option>
                                                </select></td>
                                            <td><select name="is_featured" id="is_featured" class="form-control">
                                                    <option value="-1">Is Featured?</option>
                                                    <option value="1">Featured</option>
                                                    <option value="0">Not Featured</option>
                                                </select></td>
                                            <td></td>
                                        </tr>
                                        <tr role="row" class="heading">
                                            <th><input type="checkbox" id="select-all-2" ></th>
                                            <th>Joined Date</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Is Active?</th>
                                            <th>Is Featured?</th>
                                            <th>Actions</th>
                                        </tr>
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
<script>
    $(function () {
        var oTable = $('#companyDatatableAjax').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            searching: false,
            ajax: {
                url: '{!! route('fetch.data.companies') !!}',
                data: function (d) {
                    d.name = $('#name').val();
                    d.email = $('#email').val();
                    d.is_active = $('#is_active').val();
                    d.is_featured = $('#is_featured').val();
                }
            }, 
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    orderable: false,
                    searchable: false,
                    width: '40px',
                    render: function(data, type, row, meta) {
                        return '<input type="checkbox" class="company-checkbox" value="' + data + '">';
                    }
                },
                {data: 'created_at', name: 'created_at', searchable: false, width: '100px'},
                {data: 'name', name: 'name', width: '200px'},
                {data: 'email', name: 'email', width: '200px'},
                {data: 'is_active', name: 'is_active', width: '80px'},
                {data: 'is_featured', name: 'is_featured', width: '80px'},
                {data: 'action', name: 'action', orderable: false, searchable: false, width: '100px'}
            ]
        });
        
        // Select all checkboxes
        $('#select-all, #select-all-2').on('click', function(){
            var checked = $(this).prop('checked');
            $('.company-checkbox').prop('checked', checked);
            updateDeleteButtonText();
        });

        // Update button text when individual checkboxes are clicked
        $(document).on('change', '.company-checkbox', function(){
            updateDeleteButtonText();
        });

        // Function to update delete button text
        function updateDeleteButtonText() {
            var checkedCount = $('.company-checkbox:checked').length;
            if (checkedCount > 0) {
                $('#delete-btn-text').text('Delete Selected (' + checkedCount + ')');
                $('#delete-selected').removeClass('btn-danger').addClass('btn-warning');
            } else {
                $('#delete-btn-text').text('Delete Selected');
                $('#delete-selected').removeClass('btn-warning').addClass('btn-danger');
            }
        }

        // Show success message
        function showSuccessMessage(message) {
            var alertHtml = '<div class="alert alert-success alert-dismissible fade in">' +
                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
                '<h4><i class="icon fa fa-check"></i> Success!</h4>' +
                message +
                '</div>';
            
            $('#success-message-container').html(alertHtml);
            
            // Auto-hide after 5 seconds
            setTimeout(function() {
                $('#success-message-container .alert').fadeOut(function() {
                    $(this).remove();
                });
            }, 5000);
        }

        // Delete selected companies
        $('#delete-selected').on('click', function(){
            var ids = [];
            $('.company-checkbox:checked').each(function(){
                ids.push($(this).val());
            });
            
            if(ids.length === 0){
                alert('Please select at least one company to delete.');
                return;
            }
            
            if(confirm('Are you sure you want to delete ' + ids.length + ' selected company(ies)?')){
                var $btn = $(this);
                var originalText = $('#delete-btn-text').text();
                
                // Change button text to "Deleting selected companies..."
                $('#delete-btn-text').html('<i class="fa fa-spinner fa-spin"></i> Deleting selected companies...');
                $btn.prop('disabled', true);
                
                $.ajax({
                    url: "{{ route('delete.companies.bulk') }}",
                    type: 'DELETE',
                    data: {
                        ids: ids,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response){
                        // Reset button
                        $('#delete-btn-text').text('Delete Selected');
                        $btn.prop('disabled', false);
                        $btn.removeClass('btn-warning').addClass('btn-danger');
                        
                        // Uncheck select all
                        $('#select-all, #select-all-2').prop('checked', false);
                        
                        // Show success message
                        showSuccessMessage(ids.length + ' company(ies) have been successfully deleted!');
                        
                        // Reload table
                        oTable.ajax.reload();
                    },
                    error: function(){
                        $('#delete-btn-text').text(originalText);
                        $btn.prop('disabled', false);
                        alert('Bulk delete failed! Please try again.');
                    }
                });
            }
        });
        
        $('#datatable-search-form').on('submit', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#name').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#email').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#is_active').on('change', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#is_featured').on('change', function (e) {
            oTable.draw();
            e.preventDefault();
        });
    });
    
    function deleteCompany(id) {
        var msg = 'Are you sure?';
        if (confirm(msg)) {
            $.post("{{ route('delete.company') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        if (response == 'ok')
                        {
                            var table = $('#companyDatatableAjax').DataTable();
                            table.row('companyDtRow' + id).remove().draw(false);
                        } else
                        {
                            alert('Request Failed!');
                        }
                    });
        }
    }
    
    function makeActive(id) {
        $.post("{{ route('make.active.company') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response == 'ok')
                    {
                        var table = $('#companyDatatableAjax').DataTable();
                        table.row('companyDtRow' + id).remove().draw(false);
                    } else
                    {
                        alert('Request Failed!');
                    }
                });
    }
    
    function makeNotActive(id) {
        $.post("{{ route('make.not.active.company') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response == 'ok')
                    {
                        var table = $('#companyDatatableAjax').DataTable();
                        table.row('companyDtRow' + id).remove().draw(false);
                    } else
                    {
                        alert('Request Failed!');
                    }
                });
    }
    
    function makeFeatured(id) {
        $.post("{{ route('make.featured.company') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response == 'ok')
                    {
                        var table = $('#companyDatatableAjax').DataTable();
                        table.row('companyDtRow' + id).remove().draw(false);
                    } else
                    {
                        alert('Request Failed!');
                    }
                });
    }
    
    function makeNotFeatured(id) {
        $.post("{{ route('make.not.featured.company') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response == 'ok')
                    {
                        var table = $('#companyDatatableAjax').DataTable();
                        table.row('companyDtRow' + id).remove().draw(false);
                    } else
                    {
                        alert('Request Failed!');
                    }
                });
    }
</script> 
@endpush
