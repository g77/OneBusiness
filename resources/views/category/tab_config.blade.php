<div class="panel-body" style="margin: 30px 0px;">
   <div class="table-responsive">
    <table id="list_conf" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
          <tr>
             <th>Category</th>
             <th>Subcategory</th>
            @foreach($sb as $sbranch)
            <th>{{$sbranch->short_name}}( {{$sbranch->sat_branch}} )</th>
            @endforeach

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
              <td rowspan="{{$span+1}}">{{ $categ->cat_id}} , {{ $categ->description}} , {{$span}}</td>
           </tr> 
             
            @foreach($sc as $subs)
              <tr>
              <td>{{$subs->description}} , {{$subs->subcat_id }}</td>

                @foreach($sb as $sbranch)      
                  @php
                    $checkbox = DB::connection('mysql2')->table('pc_sat_cats')
                        ->where('cat_id',$categ->cat_id)
                        ->where('subcat_id',$subs->subcat_id)
                        ->where('sat_branch',$sbranch->sat_branch)
                        ->get(); 
                  @endphp            
                    <td><input type="checkbox" class="checkbox" id="toexecute" {{ count($checkbox) ? 'checked' : ''}} value="{{$sbranch->sat_branch}}" onchange="pass_vars({{$categ->cat_id}},{{$subs->subcat_id}},{{$sbranch->sat_branch}},this);">
                    
                    </td>
                @endforeach 

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

  <script>
      function pass_vars(c,s,b,cbx){
        var ischecked = $('#toexecute').prop("checked");
        var datapassed = {cat:c,sub:s,branch:b};
        if(cbx.checked){
       console.log("var is "+c + " , "+ s + " - " +b + " -> To execute insert");
       var request =  $.ajax({          
                              type: "POST",
                              url:'add_sat_cats',
                              data:datapassed,
                              dataType:"html"
                              
                            });
            request.done(function( msg ) {
                  var response = JSON.parse(msg);
                  alert(response.msg);
              });

            request.fail(function( jqXHR, textStatus ) {
                  alert( "Request failed: " + textStatus );
              }); 

      }
        else{
        alert("var is "+c + " , "+ s + " - " +b + " -> To execute delete");
         $.ajax({
          
          type: "POST",
          url:'delete_record',
          data:{cat:c,sub:s,branch:b},
          success: function(){
            alert("deleted!");
          }
        });
        }
       
      }
  </script>
