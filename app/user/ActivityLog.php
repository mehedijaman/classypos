<?php

namespace ClassyPOS\user;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    
 	protected $table="activity_log";
    protected $primaryKey="ActivityID";
    protected $fillable=['ShopID','UserID','ActivityName'];
}
