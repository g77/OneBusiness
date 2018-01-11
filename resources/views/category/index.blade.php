@extends('layouts.app')
@section('header-scripts')
    <style>
       .modal {
            z-index: 10001 !important;
           
        }

    </style>
@endsection
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
                <div class="col-md-12 col-xs-12">
                    <h3 class="text-center">Petty Cash Configuration</h3>
                    <div class="row">  
                        <div class="panel panel-default">
                            <div class="panel-heading">Settings
                                    @if(\Auth::user()->checkAccessById(18, "A"))
                                    <a href="#" class="pull-right" id="addlink" data-backdrop="static" data-toggle="modal" data-keyboard="false"></a>
                                    @endif
                            </div>
                            <div class="panel-body"  id="tabview">
                               <ul class="nav nav-tabs" role="tablist" id="myTab">
					                <li role="presentation" class="active">
                                        <a id="conf" href="#config"  role="tab" data-toggle="tab">Configuration</a></li>
					                <li role="presentation"><a id="cat" href="#categ" role="tab" data-toggle="tab">Category</a></li>
					                <li role="presentation"><a id="sub" href="#subcat" role="tab" data-toggle="tab">Subcategory</a></li>
					            </ul>

                                
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="config">
                                        @if(\Auth::user()->checkAccessById(2, "V"))
                                            @include('category.tab_config',$categories)
                                        @else
                                            <div class="alert alert-danger no-close">
                                                You don't have permission
                                            </div>
                                        @endif
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="categ">
                                        @if(\Auth::user()->checkAccessById(2, "V"))
                                             @include('category.tab_categ')
                                        @else
                                            <div class="alert alert-danger no-close">
                                                You don't have permission
                                            </div>
                                        @endif
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="subcat">
                                        @if(\Auth::user()->checkAccessById(2, "V"))
                                           @include('category.tab_subcat')
                                        @else
                                            <div class="alert alert-danger no-close">
                                                You don't have permission
                                            </div>
                                        @endif
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

  var a = document.getElementById('addlink');
    $('#conf').on('click',function(){
        $('.panel-heading a').hide();
    })

    $('#cat').on('click',function(){
    //@if(\Auth::user()->checkAccessById(18, "A"))@endif
      
        var element = 'Add Category';
        $('.panel-heading .pull-right').text(element);
        a.setAttribute("data-target",".addNewCateg");
        $('.panel-heading a').show();
        
    })

    $('#sub').on('click',function(){
        //$('.panel-heading a').remove();
        var element = 'Add Subcategory';
        $('.panel-heading .pull-right').text(element);
        a.setAttribute("data-target",".addNewSub");
        $('.panel-heading a').show();
          
    })

</script>
@endsection