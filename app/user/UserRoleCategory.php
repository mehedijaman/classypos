<?php

namespace ClassyPOS\user;

use Illuminate\Database\Eloquent\Model;

class UserRoleCategory extends Model
{
    protected $table="user_role_category";
    protected $primaryKey="RoleCategoryID";
    protected $fillable=['RoleCategoryName'];
}
