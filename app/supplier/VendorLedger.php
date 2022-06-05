<?php

namespace ClassyPOS\supplier;

use Illuminate\Database\Eloquent\Model;

class VendorLedger extends Model
{
    
    protected $table="vendor_ledger";
    protected $primaryKey="LedgerID";
    protected $fillable=['VendorID','InvoiceID','Debit','Credit','Balance'];
}
