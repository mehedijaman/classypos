<?php
namespace ClassyPOS\Http\Controllers;

use ClassyPOS\Exceptions\Handler;
use DB;
use Illuminate\Http\Request;
use ClassyPOS\bank\Bank;
use ClassyPOS\bank\BankBalance;
use ClassyPOS\bank\BankLedger;


/**
* Bank Related all operations controller
*/
class BankController extends Controller
{	
	public function index()
	{
		return view('bank.index');
	}

	# Load Bank withdraw view
	public function createWithdraw()
	{
		// fetch all bank list
		$BankList = Bank::all();

		return view( 'bank.withdraw' , compact('BankList') );
	}

	# Load Bank Deposit view
	public function createDeposit()
	{
		// fetch all bank list


		
		$BankList = Bank::all();

		return view( 'bank.deposit', compact('BankList') );
	}

	public function storeBankWithGetMethod($id, $id2)
	{
		$bank  = new Bank();

        $bank['BankName'] = $id;
        $bank->save();
        $bankid           = $bank->BankID;

        $balance=new BankBalance();
        $balance->BankID=$bankid;
        $balance->Balance=$id2;


        $balance->save();


        $ledger=new BankLedger();

        $ledger->BankID=$bankid;
        $ledger->ChequeNumber=0;
        $ledger->RefChequeNumber=0;
        $ledger->RefBank=0;

        $ledger->Deposit=$id2;
        $ledger->Balance=$id2;
        $ledger->Withdraw=0;
        $ledger->TxBy="aaa";
        $ledger->Notes="opening Balance";

        $ledger->save();

        return $bankid;
	}


	#Store Bank to database
	public function storeBank(Request $Data)
	{	
		
		// Declaring objects
		$Bank 		 = new Bank;		
		$BankBalance = new BankBalance;
		$BankLedger  = new BankLedger;

		// Extracting Form data
		$FormData = $Data->all();

		// collecting data to insert into Bank Table
		$Bank['BankName'] = $FormData['BankName'];		

		// inserting into Bank Table
		$Bank->save();

		// retriving Bank ID after inserting
		$BankID = $Bank['BankID'];

		// collecting data to insert in Bank Balance table
		$BankBalance['BankID'] 	= $BankID;
		$BankBalance['Balance'] = $FormData['Balance'];

		// inserting into BankBalance Table
		$BankBalance->save();

		// collecting data for Bank Ledger table
		$BankLedger['BankID'] 			= $BankID;
		$BankLedger['ChequeNumber']	 	= 0;
		$BankLedger['RefChequeNumber'] 	= 0;
		$BankLedger['RefBank'] 			= '';
		$BankLedger['Deposit'] 			= $FormData['Balance'];
		$BankLedger['Balance'] 			= $FormData['Balance'];
		$BankLedger['TxBy'] 	  		= '';
		$BankLedger['Notes']   			= 'Opening Balance';

		try {

			// inserting into Bank Ledger table
			$BankLedger->save();

			// return to Bank List
			return redirect('/Bank/List');
		} 
		catch (\Exception $e) 
		{
			$e->getMessage();
			return redirect('/Bank/List');
		}
	}

	# Store Witdraw
	public function storeWithdraw(Request $Data)
	{			

		// extracting form data
		$FormData = $Data->all();

		$BankID=$FormData['BankID'];
        $BankBalance=BankBalance::where('BankID','=',$BankID)->get()->first();
        $CurrentBalance=$BankBalance->Balance;
        $UpdatedBalance=$CurrentBalance-$FormData['Amount'];
        $BankBalance->Balance=$UpdatedBalance;


        try {
			$BankBalance->save();

		} catch (\Exception $e) {
			echo $e->getMessage();			
		}



		$BankLedger  = new BankLedger;


		// collecting data for ledger input
		$BankLedger['BankID'] 			= $FormData['BankID'];
		$BankLedger['ChequeNumber'] 	= $FormData['ChequeNumber'];
		$BankLedger['Deposit'] 			= 0;
		$BankLedger['Withdraw'] 		= $FormData['Amount'];
		$BankLedger['Balance'] 			= $UpdatedBalance;
		$BankLedger['TxBy'] 			= $FormData['TxBy'];
		$BankLedger['Notes'] 			= $FormData['Notes'];


		try {
			$BankLedger->save();

		} catch (\Exception $e) {
			echo $e->getMessage();			
		}

		return redirect('Bank/Withdraw');
	}

	# Store Deposit
	public function storeDeposit(Request $Data)
	{
		// declare objects
		$FormData = $Data->all();
		
		$BankID=$FormData['BankID'];
        $BankBalance=BankBalance::where('BankID','=',$BankID)->get()->first();
        $CurrentBalance=$BankBalance->Balance;
        $UpdatedBalance=$CurrentBalance+$FormData['Amount'];
        $BankBalance->Balance=$UpdatedBalance;


        try {
			$BankBalance->save();

		} catch (\Exception $e) {
			echo $e->getMessage();			
		}

        


		// extracting form data
		

		// collecting data for ledger input
		$BankLedger  = new BankLedger;

		$BankLedger['BankID'] 			= $FormData['BankID'];
		$BankLedger['ChequeNumber'] 	= $FormData['ChequeNumber'];
		$BankLedger['Deposit'] 			= $FormData['Amount'];
		$BankLedger['Withdraw'] 		= 0;
		$BankLedger['Balance'] 			= $UpdatedBalance;
		$BankLedger['TxBy'] 			= $FormData['TxBy'];
		$BankLedger['Notes'] 			= $FormData['Notes'];






		try {
			$BankLedger->save();

		} catch (\Exception $e) {
			echo $e->getMessage();			
		}




		return redirect('Bank/Deposit');
	}


	# Load Bank List View
	public function listBank()
	{	
		// retriving all Bank List
		$BankList = Bank::where('bank.BankID','>',0)
		->join('bank_balance','bank.BankID','=','bank_balance.BankID')
		->get();

		// loading bank list view and passing data
		return view( 'bank.list', compact('BankList'));
	}

	public function detailsBank($BankID)
	{



		$Bank=Bank::where('bank.BankID','=',$BankID)->join('bank_balance','bank.BankID','=','bank_balance.BankID')->get();

		$BankName= $Bank[0]->BankName;
		$BankBalance= $Bank[0]->Balance;
		//return $BankBalance;
		$BankID= $Bank[0]->BankID;


		return view('bank.details',compact('BankName','BankID','BankBalance'));

		

	}

	public function listBankToJson()
	{
		$result=Bank::where('BankID','>',0)->get();
        $json = json_encode($result);
        return response()->json($json);
	}


	# Load view of Edit a Bank
	public function editBank($BankID)
	{


		// retrieving bank details from Bank Table
		$Bank = Bank::findOrFail($BankID);



		

		// retrieving Bank Balance from Bank Balance table
		$BankBalance = BankBalance::where('BankID','=',$BankID)->get();

		$BankBalance=$BankBalance[0]->Balance;





		// passing data to edit view
		return view('bank.edit', compact('Bank', 'BankBalance'));
	}


	# Update Bank Details
	public function updateBank(Request $Data, $BankID)
	{
		$Bank=Bank::findOrFail($BankID);
		$Bank->BankName=$Data->BankName;
		$Bank->save();

		$Balance=BankBalance::where('BankID','=',$BankID)->get();
		$Balance[0]->Balance=$Data->BankBalance;
		$Balance[0]->save();

		return back()->with('BankEdit');
		

	}


	# Delete a Bank from database
	public function destroyBank($BankID)
	{	
		try {
			// delete Bank
			Bank::findOrFail($BankID)->delete();

			// delete Bank Balance
			// BankBalance::findOrFail($BalanceID)->delete();
			
			// finding Bank Ledger from BankLedger table
			$BankLedgerDelete=BankLedger::where('BankID','=',$BankID)->delete();
			$BankBalanceDelete=BankBalance::where('BankID','=',$BankID)->delete();


			// delete Bank ledger from BankLedger Table
			// $BankLedger->delete();

			// return to Bank List view
			return redirect('/Bank/List');			
		} 
		catch (\Exception $e) {
			return redirect('/Bank/List');
		}
	}

	public function listLedger($BankID)
	{
		$BankLedger = new BankLedger;

		$Bank = Bank::where('bank.BankID','=',$BankID)->join('bank_balance','bank_balance.BankID','=','bank.BankID')->get()->first();

		$LedgerList = $BankLedger->listLedger($BankID);

		return view('bank.ledger.list', compact('Bank','LedgerList'));
	}



	public function editLedger($LedgerID)
	{


		$BankLedger=BankLedger::where('LedgerID',$LedgerID)->get()->first();

		if($BankLedger->Withdraw>0)
		{

			$mode="Withdraw";
		}

		if($BankLedger->Deposit>0)
		{
			$mode="Deposit";

		}

		$Bank=Bank::where('BankID','=',$BankLedger->BankID)->get()->first();
		$BankName=$Bank->BankName;


		return view('bank.ledger.edit',compact('BankLedger','BankName','mode'));



	}


	public function updateLedger(Request $Data,$LedgerID)
	{
		$mode=$Data->Mode;
		if($mode=="Withdraw")
		{
			$BankLedger=BankLedger::where('LedgerID','=',$LedgerID)->get()->first();
			$PreviousWithdraw=$BankLedger->Withdraw;
			$NewWithdraw=$Data->Withdraw;
			$UpdatedWithdraw=$NewWithdraw-$PreviousWithdraw;
			$BankBalance=BankBalance::where('BankID','=',$BankLedger->BankID)->get()->first();
			$CurrentBalance=$BankBalance->Balance;
			$UpdateBalance=$CurrentBalance-$UpdatedWithdraw;
			$BankBalance->Balance=$UpdateBalance;
			$BankLedger->Balance=$UpdateBalance;
			$BankLedger->Withdraw=$Data->Withdraw;



			try {
				$BankBalance->save();
				$BankLedger->save();
			
				} catch (\Exception $e) {
					echo $e->getMessage();			
				}		

		}

		if($mode=="Deposit")
		{
			$BankLedger=BankLedger::where('LedgerID','=',$LedgerID)->get()->first();
			$PreviousDeposit=$BankLedger->Deposit;
			$NewDeposit=$Data->Deposit;
			$UpdatedDeposit=$NewDeposit-$PreviousDeposit;
			$BankBalance=BankBalance::where('BankID','=',$BankLedger->BankID)->get()->first();
			$CurrentBalance=$BankBalance->Balance;
			$UpdateBalance=$CurrentBalance+$UpdatedDeposit;
			$BankBalance->Balance=$UpdateBalance;

			$BankLedger->Balance=$UpdateBalance;
			$BankLedger->Deposit=$Data->Deposit;


			try {
				$BankBalance->save();
				$BankLedger->save();
			
				} catch (\Exception $e) {
					echo $e->getMessage();			
				}		

		}


		return redirect('/Bank/Ledger/List/'.$BankLedger->BankID);

	}


	public function destroyLedger($LedgerID)
	{

		$BankLedger=BankLedger::findOrFail($LedgerID);
		$Withdraw=$BankLedger->Withdraw;
		$Deposit=$BankLedger->Deposit;

	    $LedgerBalance=$BankLedger->Balance;
	    $BankID=$BankLedger->BankID;
	    $BankBalance=BankBalance::where('BankID','=',$BankID)->get()->first();
	    $PreviuosBalance=$BankBalance->Balance;
	    if($Withdraw>0)
		{
			$NewBalance=$PreviuosBalance+$Withdraw;
		}
		if($Deposit>0)
		{
			$NewBalance=$PreviuosBalance-$Deposit;


		}

	    $BankBalance->Balance=$NewBalance;
	    $BankBalance->save();
	    $BankLedger->delete();
	    return redirect('/Bank/Ledger/List/'.$BankID);



	}
}