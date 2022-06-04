<?php

namespace ClassyPOS\sales;

use Illuminate\Database\Eloquent\Model;

class CashDrawer extends Model
{
    protected $table="cash_drawer";
    protected $primaryKey="CashDrawerID";
    protected $fillable=['ShopID','UserID','OpeningBalance','ClosingBalance','isClosed'];

}
