<?php

namespace ClassyPOS\user;

use Illuminate\Database\Eloquent\Model;

class UserNew extends Model
{
    protected $table="user";
    protected $primaryKey="UserID";
    protected $fillable=['ShopID','Phone','FirstName','LastName','Address','City','Province','ZipCode','Country','UserSince','DateOfBirth','UserImg'];
}
