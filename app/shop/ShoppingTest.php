<?php

namespace ClassyPOS\shop;

use Illuminate\Database\Eloquent\Model;

class ShoppingTest extends Model
{
    
    protected $table="ShoppingTest";
    protected $primaryKey="ID";
    protected $fillable=['IsRestaurant','IsAdvance'];

}