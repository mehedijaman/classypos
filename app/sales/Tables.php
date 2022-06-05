<?php

namespace ClassyPOS\sales;

use Illuminate\Database\Eloquent\Model;

class Tables extends Model
{
    
    protected $table="tables";
    protected $primaryKey="ID";
    protected $fillable=['Name','Location','Capacity','IsBooked'];

}
