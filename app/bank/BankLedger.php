<?php

namespace ClassyPOS\bank;

use Illuminate\Database\Eloquent\Model;
use DB;

class BankLedger extends Model
{ 

    protected $table="bank_ledger";
    protected $primaryKey="LedgerID";
    protected $fillable=['BankID','ChequeNumber','RefChequeNumber','RefBank','Deposit','Withdraw','Balance','TxBy','Notes'];

    public function listLedger($BankID)
    {
    	$List = DB::select("SELECT 
    		bank_ledger.LedgerID,
    		bank_ledger.ChequeNumber,
    		bank_ledger.RefChequeNumber,
    		bank_ledger.RefBank,
    		bank_ledger.Deposit,
    		bank_ledger.Withdraw,
    		bank_ledger.Balance,
    		bank_ledger.TxBy,
    		bank_ledger.Notes,
    		bank_ledger.created_at,
    		bank_ledger.updated_at

    		FROM bank_ledger
    		WHERE bank_ledger.BankID = $BankID"
    	);

    	return $List;
    }
}
