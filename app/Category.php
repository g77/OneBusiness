<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public $timestamps = false;
    protected $table = "pc_cat";
    protected $primaryKey = 'cat_id';
    protected $connection = 'mysql2';
    protected $fillable = ['description', 'active'];

}
