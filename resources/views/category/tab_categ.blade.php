<div class="panel-body" style="margin: 30px 0px;">
   <div class="table-responsive">
    <table id="list_cat" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
          <tr>
             <th>ID</th>
             <th>Category</th>
             <th>Action</th>
            
          </tr>
         </thead> 
        <tbody>
          	
          @foreach($categories as $categ)
           <tr class="text-center">
                <td>{{ $categ->cat_id}}</td>
                <td>{{ $categ->description}}</td>
                <td>
               
			    <a href="{{URL('add_category/'.$categ->cat_id)}}" class="btn btn-primary btn-md blue-tooltip {{ \Auth::user()->checkAccessById(32, 'E') ? '' : 'disabled' }} edit"  data-title="Edit" data-toggle="tooltip" data-placement="top" title="Edit Category"><span class="glyphicon glyphicon-pencil"></span><span style="display: none;">{{ $categ->cat_id}}</span></a>
                
                <a class="btn btn-danger btn-md sweet-4 red-tooltip {{ \Auth::user()->checkAccessById(18, 'D') ? '' : 'disabled' }}"" data-title="Delete Category" href="javascript:;" rel="{{ URL::to('delete_category/'.$categ->cat_id )}}" data-toggle="tooltip" data-placement="top"  cat-name="{{$categ->description}}" id="{{ $categ->cat_id }}" title="Delete City" ><span class="glyphicon glyphicon-trash"></span></a>

				        </td>
            </tr>
          @endforeach 
             
          
       </tbody>

    </table>
  </div>
 <div class="text-left">
    <a href="/OneBusiness/home" class="btn btn-default">
       <i class="fa fa-reply"></i> Back
    </a>
   
 </div>
</div>

<!-- Modal add new categ -->
    <div class="modal fade addNewCateg" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Add Category</h5>
                </div>
                <form class="form-horizontal" action="{{ url('/add_category') }}" id="form1" METHOD="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="catName">Category</label>
                            <div class="col-md-8">
                                <input id="categ" name="category_name" type="text" class="form-control input-md" value="{{isset($category->description) ? $category->description : "" }}"maxlength=50 required>
                                <input type="checkbox" id="activeCheck" name="activeCheck">&nbsp<label>Active</label>&nbsp
                        
                            </div>
                           @if(!isset($category->description))
                            <label class="col-md-3 control-label" for="subName">Subcategory</label>
                            <div class="col-md-8">
                                <input id="sub" name="subcat_name" type="text" class="form-control input-md" maxlength=50 required>
                                <input type="checkbox" id="activeCheck2" name="activeCheck2">&nbsp<label>Active</label>&nbsp
                            </div>
                           @endif
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="glyphicon glyphicon-arrow-left"></i>&nbspBack</button>
                            </div>
                            <div class="col-sm-6">
                                {!! csrf_field() !!}
                                <button type="submit" class="btn btn-primary pull-right" id="create">{{isset($category->cat_id) ? "Save " : "Create " }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end modal for creting category -->


<!-- Modal add new subcateg -->
    <div class="modal fade addNewSub" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Add New Subcategory</h5>
                </div>
                <form class="form-horizontal" action="{{ url('/add_category') }}" id="form1" METHOD="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="catName">Category</label>
                            <div class="col-md-8">
                            <select class="form-control required" id="prov_id" name="Prov_ID">
                             <option value="">Choose Province</option>                  
                                <option>2</option>
                                <option>3</option>
                                                                    
                             </select>
                            </div>
                           
                            <label class="col-md-3 control-label" for="subName">Subcategory</label>
                            <div class="col-md-8">
                                <input id="sub" name="sub_name" type="text" class="form-control input-md" maxlength=50 required>
                                <input type="checkbox" id="activeCheck2" name="activeCheck2">&nbsp<label>Active</label>&nbsp
                            </div>
                          
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="glyphicon glyphicon-arrow-left"></i>&nbspBack</button>
                            </div>
                            <div class="col-sm-6">
                                {!! csrf_field() !!}
                                <button type="submit" class="btn btn-primary pull-right" id="create">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end modal for creting subcategory -->

    <script>
    //toggle edit
            $(document).on('click', '.edit', function (e) {
                e.preventDefault();

                var id  = $(this).closest('td').find('span').text();
                var productLineName  = $(this).closest('tr').find('td:nth-child(2)').text();
                var activeCheck  = $(this).closest('tr').find('td:nth-child(3) input').is(":checked");
                $('#editProdcutLine').find('.productLineId').val(id);
                $('#editProdcutLine .editProductLineName').val(productLineName);
                if(activeCheck == true) {
                    $('#editProdcutLine .editActiveCheck').attr("checked", true);
                }else{
                    $('#editProdcutLine .editActiveCheck').attr("checked", false);
                }
                $('#editProdcutLine form').attr('action', 'productlines/'+id);
                $('#editProdcutLine').modal("show");

            });


             $(document).on("click", ".sweet-4", function(){
            var delete_url = $(this).attr("rel");
             var cat_name = $(this).attr("cat-name");
            var id = $(this).attr("id");
            swal({
                  title: "<div class='delete-title'>Confirm Delete</div>",
                text:  "<div class='delete-text'>You are about to delete category <strong>"+id+" - "+cat_name +"</strong><br/> Are you sure?</div>",
                html:  true,
                customClass: 'swal-wide',
                showCancelButton: true,
                confirmButtonClass: 'btn-danger',
                confirmButtonText: 'Delete',
                cancelButtonText: "Cancel",
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
        });
    </script>