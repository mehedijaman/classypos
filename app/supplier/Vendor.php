<?php

namespace ClassyPOS\supplier;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table="vendor";
    protected $primaryKey = 'VendorID';
    protected $fillable=['VendorName','ContactName','Address','City','Province','ZipCode','Country','Phone1','Phone2','Fax','Email','Website','VendorImg'];
}
