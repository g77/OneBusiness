<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SatCats extends Model
{
    //     public $timestamps = false;
    protected $table = "pc_sat_cats";
    protected $connection = 'mysql2';
    protected $fillable = ['cat_id','subcat', 'sat_branch'];

}
