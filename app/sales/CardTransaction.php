<?php

namespace ClassyPOS\sales;

use Illuminate\Database\Eloquent\Model;

class CardTransaction extends Model
{
    
    protected $table="customer_payment_transaction";
    protected $primaryKey="ID";
    protected $fillable=['InvoiceID','CustomerID','ShopID','MethodID','TransactionAmount','CardNmuber','CardHolderName'];

}
