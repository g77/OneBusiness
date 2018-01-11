<div class="panel-body" style="margin: 30px 0px;">
      <div class="table-responsive">
            <table id="list_sub" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                  <tr>
                     <th>Category</th>
                     <th>ID</th>
                     <th>Subategory</th>
                     <th>Action</th>
                    
                  </tr>
                 </thead> 
                <tbody>
                    
                 @foreach($categories as $categ)
                     @php
                      $sc = DB::connection('mysql2')->table('pc_subcat')
                              ->where('cat_id',"=",$categ->cat_id)
                              ->orderBy('description','ASC')
                              ->get();
                        $span=count($sc);
                     @endphp

                     <tr class="text-center">
                        <td rowspan="{{$span+1}}">{{ $categ->description}}</td>
                     </tr> 
                       
                      @foreach($sc as $subs)
                      <tr class="table-striped" >
                          <td>{{$subs->subcat_id }}</td>
                          <td>{{$subs->description}}</td>

                          <td>
                              <a href="#" class="btn btn-primary btn-md blue-tooltip {{ \Auth::user()->checkAccessById(32, 'E') ? '' : 'disabled' }}"  data-title="Edit" data-toggle="tooltip" data-placement="top" title="Edit Category"><span class="glyphicon glyphicon-pencil"></span></a>

                              <a class="btn btn-danger btn-md sweet-4 red-tooltip {{ \Auth::user()->checkAccessById(32, 'D') ? '' : 'disabled' }}" data-title="Delete" href="javascript:;" rel="#" data-toggle="tooltip" data-placement="top"   title="Delete City" ><span class="glyphicon glyphicon-trash"></span></a>

                          </td>
                        </tr>
                      @endforeach 
                     
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
