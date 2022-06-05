<?php

namespace ClassyPOS\customer;

use Illuminate\Database\Eloquent\Model;

class CustomerLedger extends Model
{
    


    protected $table="customer_ledger";



    protected $primaryKey="LedgerID";

    protected $fillable=['CustomerID','InvoiceID','Debit','Credit','Balance'];
}

