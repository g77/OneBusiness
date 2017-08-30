@extends('layouts.app')

@section('content')
<div class="container-fluid">
<div class="row">   
    <div id="togle-sidebar-sec" class="active">
        <!-- Sidebar -->
        <div id="sidebar-togle-sidebar-sec">
            <ul id="sidebar_menu" class="sidebar-nav">
                <li class="sidebar-brand"><a id="menu-toggle" href="#">Menu<span id="main_icon" class="glyphicon glyphicon-align-justify"></span></a></li>
            </ul>
            <div class="sidebar-nav" id="sidebar">     
                <div id="treeview_json"></div>
            </div>
        </div>
          
        <!-- Page content -->
        <div id="page-content-togle-sidebar-sec">
            @if(Session::has('alert-class'))
                <div class="alert alert-success col-md-8 col-md-offset-2 alertfade"><span class="fa fa-close"></span><em> {!! session('flash_message') !!}</em></div>
            @elseif(Session::has('flash_message'))
                <div class="alert alert-danger col-md-8 col-md-offset-2 alertfade"><span class="fa fa-close"></span><em> {!! session('flash_message') !!}</em></div>
            @endif
            <div class="col-md-12">
                <h3 class="text-center">Manage Users</h3>
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">List of users</div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="list_group" class="col-sm-12 table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>User ID .</th>
                                            <th>Name</th>
                                            <th>Template ID</th>
                                            <th>Area Type</th>
                                            <th>Remittance Group</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user_detail as $key=>$det)
                                        <?php 
                                        $ids = explode(",", $det->group_ID);
                                        $grpname = array();
                                        foreach ($ids as $value) {
                                            if(!empty($grp_IDs[$value])){
                                                array_push($grpname, $grp_IDs[$value]);
                                            }
                                        }
                                        if(isset($det->Area_type) && $det->Area_type == "PR"){ $ar_type = "Province";}
                                        else if(isset($det->Area_type) && $det->Area_type == "CT"){ $ar_type = "City";}
                                        else if(isset($det->Area_type) && $det->Area_type == "BR"){ $ar_type = "Branch";}
                                        else{ $ar_type = "";}
                                        ?>
                                            <tr>
                                                <td>{{ $det->UserID }}</td>
                                                <td>{{ $det->Username }}</td>
                                                <td>{{ ($det->template_ID) ? $det->template_ID : '' }}</td>
                                                <td>{{ $ar_type }}</td>
                                                <td>{{ implode(", ", $grpname) }}</td>
                                                <td><a class="btn btn-primary btn-md blue-tooltip" data-title="Edit" href="{{ URL::to('add_user/' . $det->UserID) }}" data-toggle="tooltip" data-placement="top" title="Edit Group"><span class="glyphicon glyphicon-pencil"></span></a>
                                                <a class="btn btn-danger btn-md sweet-4 red-tooltip" data-title="Delete" href="#" data-toggle="tooltip" data-placement="top" title="Delete Group"><span class="glyphicon glyphicon-trash"></span></a></td>
                                            </tr>  
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
$(document).ready(function() {
    $('#list_group').DataTable();
   /* $(document).on("click", ".sweet-4", function(){
        var delete_url = $(this).attr("rel");
        swal({
            title: "Are you sure?",
            text:  "You will not be able to recover this Group Data!",
            type:  "warning",
            showCancelButton: true,
            confirmButtonClass: 'btn-danger',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm){
            if (isConfirm){
                window.location.replace(delete_url);
            } else {
                return false;
            }
        });
    });*/
    $('[data-toggle="tooltip"]').tooltip();
  
});
</script>
@endsection


