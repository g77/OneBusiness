<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    //
     public $timestamps = false;
    protected $table = "pc_subcat";
    protected $primaryKey = 'subcat_id';
    protected $connection = 'mysql2';
    protected $fillable = ['cat_id','description', 'active'];


    public function categories()
    {
        return $this->belongsTo(\App\PCategory::class, "cat_id", "cat_id");
    }
}
