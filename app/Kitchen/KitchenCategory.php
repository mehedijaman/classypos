<?php

namespace ClassyPOS\Kitchen;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KitchenCategory extends Model
{
	//use SoftDeletes;
	protected $table="kitchen_category_mapping";
	protected $primaryKey="ID";    
    protected $fillable=['KitchenID','CategoryID'];
    //protected $dates = ['deleted_at'];
   
}