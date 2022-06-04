<?php

namespace ClassyPOS\Kitchen;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kitchen extends Model
{
	//use SoftDeletes;
	protected $table="kitchen";
	protected $primaryKey="ID";    
    protected $fillable=['ShopID','Name','IsOpen'];
    //protected $dates = ['deleted_at'];
   
}