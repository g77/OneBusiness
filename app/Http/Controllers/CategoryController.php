<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Category;
use App\Subcategory;
use App\SatelliteBranch;
use App\SatCats;

class CategoryController extends Controller
{
    //
    public function index()
    {

    if(!\Auth::user()->checkAccessById(18, "V"))
    {
      \Session::flash('error', "You don't have permission");
            return redirect("/home");
        }
        return self::list_pccat();
    }

    //---------listing categories
    public function list_pccat()
    {
        $sb = DB::connection('mysql2')->table('pc_branches')
                 ->where('Active',1)
                 ->get();

        $cats = Category::where('active',1)
                 ->where('deleted',0)
                 ->orderBy('description', 'ASC')
                 ->get();
        //dd($cats->toArray());
        return view('category.index', ['categories' => $cats, 'sb'=>$sb]); 

    }

    //-----------list subcat
     public function listSubcategory($cat_id = NULL){
        
            if($cat_id == NULL){
               $subcats = Subcategory::all();
                dd($subcats);
            }else{
               $subcats = Subcategory::where('cat_id',$cat_id)
               ->where('active',1)->get();

               $lastID = Category::orderBy('cat_id','desc')->first();
               foreach($subcats as $sub){
                   echo " sub ". $sub->description;
                   echo "<br>". $lastID->cat_id;
               }
              
              //dd($subcats);
              return view('category.index', ['cat_id' => $cat_id, 'subs'=>$subcats,'#categ']); 
            }
    }


    public function addNewRecord(Request $request){
       if ($request::ajax()) { 
        $post = $request::all(); 
        $ids = new SatCats;
        $ids->cat_id = $post['cat'];
        $ids->subcat_id = $post['sub'];
        $ids->sat_branch = $post['branch'];
        $ids->save();
        return redirect()->back();
        $response = array(
        'status' => 'success',
        'msg' => 'Option created successfully',
        );

      }
      return Response::json( $response );
        //echo $cat." -------- ".$sub." -------- ".$branch;
        
        //return $cat;
        //THIS SHOULD EXECUTE Create()
    }

   public function createCategory(Request $request,$cat_id = NULL){
    
        if ($request->isMethod('post')) {
            $formData = $request->all();
                   
            if ($cat_id == NULL) {
                 $catdata = array(
                'description' => $formData["category_name"],
                'active' => isset($formData['activeCheck']) ? 1 : 0
                );

                  $cats = Category::create($catdata);
                  
                  $subdata = array('cat_id'=>$cats->cat_id,
                    'description' => $formData["subcat_name"],
                    'active' => isset($formData['activeCheck2']) ? 1 : 0
                    );
                  $subs = Subcategory::create($subdata);
                  \Session::flash('flash_message', 'New category and subcategory has been added.');
            }
            else{
                 $cats = Category::find($cat_id);
                // dd($cats);
                  //DB::table('t_provinces')->where('Prov_id', $prov_id)->update($data);
                  \Session::flash('flash_message', 'Category has been updated.');
            }
                  \Session::flash('alert-class', 'alert-success');
                  return redirect('petty_config');
        }
        $data =array();

        if ($cat_id != NULL) {
                $data['category_edit'] = Category::where('cat_id', $cat_id)->first(); 
        }
           return view('category.index',$data);
   }
   public function createSubcategory(){}


   public function deletecategory(Request $request,$cat_id = NULL){
     Category::where('cat_id',$cat_id)->delete();
   }


   
   
}
