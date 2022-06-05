<?php

namespace ClassyPOS\user;

use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    protected $table="user_account";
    protected $primaryKey="UserID";
    protected $fillable=['UserName','ShopID','Password','Email','DisabledAccount','DateOfLastLogin','FailedAttempCount'];
}

