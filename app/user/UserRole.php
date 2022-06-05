<?php

namespace ClassyPOS\user;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table="user_role";
    protected $primaryKey="UserRoleCategoryID";
    protected $fillable=['RoleCategoryID','UserID'];
}
