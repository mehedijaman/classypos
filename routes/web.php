<?php
    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    */

    // One Click Install Project
    Route::get('/ServerRequest/GetData','SalesController@AngularTest');
    Route::get('/Sale/Customer/LocalStorage/','SalesController@CustomerLocalStorage');
    Route::get('/Sale/Table/LocalStorage/','SalesController@TableLocalStorage');
    Route::get('/Install', 'InstallController@index');    
    Route::post('/Install', 'InstallController@install');    
 
    Route::auth();
    Auth::routes();

    Route::get('/Search','ProductController@searchProduct');

    //Route::post('/Sale/Ali/Rezwan/','SalesController@Checking'); 
//    Route::post('/registerFahad','SalesController@saleOrder');
    Route::post('/registerFahad','KOTController@newKOT');
    Route::post('/Afnan','SalesController@afnan');
    Route::post('/Sale/Card/Payment','TenderController@cardPayment');   
    Route::post('/Sale/Payment/Method/IDtoName','SalesController@paymentMethodIDToName');   

    Route::get('/', 'HomeController@index' );

    Route::get('/logout', 'LogoutController@logout');

    Route::get('/Home', 'HomeController@index');    

    Route::get('/Admin', 'DashboardController@index')->middleware('Role');

    Route::get('/Dashboard', 'DashboardController@index')->middleware('Role');



    /*********************** Role  Routes ***********************/ 
    Route::get('/SalesRole/{url}','RoleController@SalesRole');

    Route::get('/NewCustomerRole','RoleController@NewCustomerRole');    


    /*********************** Sales Routes ***********************/
    Route::get('/Sales','SalesController@begin')->middleware('Role');  
    Route::post('/Sale/Product/New','ProductController@storeProduct');
    Route::get('/Sale/Symbol/','SalesController@symbol');

    // Select Shop
    //Route::get('/Sales/Shop/Select/{ShopID}','SalesController@ShopSelect');


    /*********************** Waiter Routes ***********************/
    Route::get('/Waiter', 'WaiterController@begin')->middleware('Role');


    /*********************** Kitchen Routes ***********************/
    Route::get('/Kitchen', 'KitchenController@index');

    Route::get('/Kitchen/Category/Confirm/{CategoryID}/{KitchenID}','KitchenController@categoryToKitchen');

    Route::get('/Kitchen/KOT/New','KitchenController@newKOT')->middleware('Role');
    Route::get('/Kitchen/KOT/New/{ShopID}/{KitchenID}/{DateFrom}/{DateTo}/{Option?}', 'KOTController@listKOT')->middleware('Role');

    Route::get('/Kitchen/KOT/Confirmed/','KitchenController@confirmedKOT');
    Route::get('/Kitchen/KOT/Confirmed/{SubOrderID}', 'KitchenController@confirmed');

    Route::get('/Kitchen/KOT/Completed','KitchenController@completedKOT');
    Route::get('/Kitchen/KOT/Completed/{SubOrderID}','KitchenController@completed');
    Route::get('/Kitchen/KOT/Undo/{SubOrderID}','KitchenController@undoCompleted');
    Route::get('/Kitchen/SubOrder/New/{SubOrderID}','KitchenController@newSubOrder');
    Route::get('/Kitchen/Order/Delete/{OrderID}','KitchenController@orderDelete');





    /*********************** Hold Routes ***********************/
    Route::get('/Sale/Hold/Insert/{ProductIDHold}/{QuantityHold}/{DiscountHold}/{VatHold}/{fShopHold}/{Name}','SalesController@saleHold');
    
    Route::get('/Sale/Hold/Delete/{HoldID}','SalesController@saleHoldDelete');

    Route::get('/Sale/Hold/Details/{HoldID}','SalesController@saleHoldDetails');

    Route::get('/Sale/Hold/List/{From}/{To}','InvoiceController@holdList');

    Route::get('/Sale/Hold/Load/{HoldID}','SalesController@holdtoProduct')->middleware('Role2');


    /*********************** Order Routes ***********************/
    Route::get('/Sale/Order/Delete/{OrderID}','SalesController@saleOrderDelete');

    Route::get('/Sale/Order/List/Update/{OrderID}','SalesController@saleOrderListUpdate');

    Route::get('/Sale/Order/List/Delete/{MappingID}','SalesController@saleOrderListDelete'); 

    Route::post('/Sale/Order/Ticket','SalesController@saleOrderTicket');
    
    Route::get('/Sale/Order/Ticket/KOT/{OrderID}/{Ticket}/{Booking}','SalesController@saleOrderTicketKOT');
    Route::get('/Sale/Order/Ticket/KOT/Print/{OrderID}/{Ticket}/{Booking}','SalesController@saleOrderTicketKOTPrint');

    Route::get('/Sale/Order/Details/{OrderID}','SalesController@saleOrderDetails'); 

    Route::post('/Sale/Order/New','SalesController@saleOrderWindow');

    Route::post('/Sale/Order/Update','SalesController@saleOrderUpdate');

    Route::post('/Sale/Order/Update/WithoutProduct','SalesController@saleOrderUpdateWithoutProduct');


    Route::get('/Sale/Counter/Show/','SalesController@showCounters');

    Route::post('/Sale/Order/Invoice','SalesController@saleOrderInvoice');

    Route::get('/Sale/Order/Counter/{CounterID}','SalesController@counterDetails');
    Route::get('/Sale/Order/Parcel/','SalesController@showParcels');
    Route::get('/Sale/Order/Parcel/{OrderID}','SalesController@parcelDetails');

    //Route::get('/Sale/Order/Counter/Check','SalesController@saleCounterCheck');

    //Route::get('/Sale/Order/Counter/Check2','SalesController@saleCounterUpdateCheck');

    Route::get('/Sale/Order/List/{From}/{To}','InvoiceController@orderList');

    Route::get('/Sale/Order/Load/{OrderID}','SalesController@ordertoProduct')->middleware('Role2');
   

    Route::post('/Sale/Invoice/','TenderController@saleInvoice');

    //Refund a product by Using ProductID
    Route::post('/Sales/Refund/Product','TenderController@saleRefundProductID');

    //Refund a Product by using InvoiceID
    Route::post('/Sales/Refund/Invoice','TenderController@saleRefundInvoice');

    Route::get('/Invoice/Setting/{ShopID}','InvoiceController@footerEdit');

    /*********************** Advance Routes ***********************/    
    Route::get('/Sale/Advance/List/{From}/{To}','InvoiceController@AdvanceList');

    Route::post('/Sale/Advance/Confirm','SalesController@advanceConfirm');

    Route::get('/Sale/Advance/{ProductID}','SalesController@advancetoProduct')->middleware('Role2');

    Route::get('/Sale/Advance/Delete/{ProductID}','SalesController@advanceListDelete')->middleware('Role2');

    Route::get('/Sale/Advance/Complete/{ProductID}','SalesController@advanceListComplete')->middleware('Role2');

    Route::get('/AdvanceConfirm/{ProductIDAdvance}/{QuantityAdvance}/{CustomerName}/{Address}/{Phone}/{Amount}/{DelivaryDate}/{Notes}','SalesController@productIDAdvance');

    
    // Add Opening Balance
    Route::post('/Sale/OpeningBalance','SalesController@OpeningBalanceSubmit');

    Route::post('Sale/EditingBalance','SalesController@EditingBalanceSubmit');

    Route::get('/openingbalance/{BalanceValue}','SalesController@OpeningBalance');

    // Edit Opening Balance
    Route::get('/editingbalance/{BalanceValue}/{CashDrawerID}','SalesController@EditingBalance');

    // Close Opening Balance
    Route::get('/ClosingBalance/{CashDrawerID}','DrawerController@ClosingBalance');

    Route::get('/DailyReport/DaySummary/{Date?}','DrawerController@DaySummary');   
    Route::get('/DailyReport/DayInvoices/{Date?}','DrawerController@DayInvoices');   
    Route::get('/DailyReport/DaySales/{Date?}','DrawerController@DaySales');   

    Route::get('/ProductNew',['middleware' => 'Role:1,Shop','uses' => 'CustomerController@Role',]);
    

    Route::get('/Sale/Tender/SplitPayment','SalesController@splitPayment')->middleware('Role');
    Route::post('/Sale/Tender/SingleCard','TenderController@singleCard');

    Route::post('/Sale/Tender/SplitPayment','TenderController@storeSplitPayment')->middleware('Role');

    Route::get('/Sale/Shop/Select/{ShopID}','SalesController@shopSelect');
    Route::get('/Sale/Kitchen/Select/{KitchenID}','KitchenController@kitchenSelect');

    Route::get('/Sale/Vat/CodetoPercentage/{TaxCodeID}','SalesController@taxCodetoPercentage');
    
    Route::get('/Sale/Customer/List/','CustomerController@listforSales');
    Route::get('/Sale/Customer/getID/','CustomerController@getCustomerID');
    Route::get('/Sale/Customer/Check/','CustomerController@checkforSales');

    Route::get('/Sale/Customer/List/NewAdd','CustomerController@listforSalesforNewCustomer');

    Route::get('/customerinvoice/{id}/{id2}/{id3}/{id4}/{id5}/{id6}/{id7}/{id8}/{id9}/{id10}/{id11}/{id12}/{id13}/{Shop}','TenderController@invoice');

    Route::get('/customerinvoicecard/{id}/{id2}/{id3}/{id4}/{id5}/{id6}/{id7}/{id8}/{id9}/{id10}/{id11}/{id12}/{id13}/{id14}/{id15}/{id16}','TenderController@invoicecard');

    Route::get('/refundinvoice/{id}/{id2}/{id3}/{id4}/{id5}/{id6}/{id7}/{id8}/{id9}/{refundtype}','TenderController@Refund');  

    Route::post('/ModalTender','TenderController@modal')->middleware('Role');

    Route::post('/Tender','TenderController@execute')->middleware('Role'); 

    Route::get('/ajax-shop-change/{id}','ProductController@ShopWiseProductList');

    Route::get('/ajax-phone-check/{id}','CustomerController@searchCustomerByPhone');
   
    Route::get('/Sale/Product/AddToCart/{id}/{id2}','SalesController@AddProductToCart');
    Route::get('/Sale/Product/Category/Filter/{CategoryID}','SalesController@filterProduct');

    Route::get('/Sale/Product/ShopExistenceCheck/{id}/{id2}','SalesController@shopExistenceCheck');

    Route::get('/ajax-refund-change/{InvoiceID}/{ShopID}','InvoiceController@InvoiceSearchForRefund');

    Route::post('/ProductRefund','RefundController@refund');



    /*********************   Report Routes ************************/ 
    Route::get('/Report', 'ReportController@index')->middleware('Role');

    // Product Reports
    Route::get('/Report/Product', 'ProductController@Report')->middleware('Role');   

    Route::get('/Report/Product/{ShopID}/{CategoryID}/{VendorID}/{DateFrom}/{DateTo}/{Quantity}', 'ReportController@product')->middleware('Role2');

    Route::get('/Report/TopSold', 'ProductController@TopSold')->middleware('Role');

    // Sales Report
    Route::get('/Report/Sales', 'ReportController@salesReport')->middleware('Role');

    Route::get('/Report/Sales/{ReportName}/{ShopID}/{CategoryID}/{VendorID}/{UserID}/{DateFrom}/{DateTo}', 'ReportController@sales')->middleware('Role2');

    // Activity Report
    Route::get('/Report/Activity', 'ActivityController@report')->middleware('Role');

    Route::get('/Report/Activity/{ShopID}/{UserID}/{DateFrom}/{DateTo}', 'ReportController@activity')->middleware('Role2');

    // Waste Report
    Route::get('/Report/Waste', 'WasteController@report')->middleware('Role');

    Route::get('/Report/Waste/{ShopID}/{DateFrom}/{DateTo}', 'ReportController@waste')->middleware('Role2');

    // Drawer Report
    Route::get('/Report/Drawer', 'DrawerController@report')->middleware('Role');

    Route::get('/Report/Drawer/{ShopID}/{UserID}/{Status}/{DateFrom}/{DateTo}', 'ReportController@drawer')->middleware('Role2');

    // Accounts Report
    Route::get('/Report/Accounts', 'AccountsController@report')->middleware('Role');



    /*********************   Invoice Routes ************************/    
    Route::get('/Invoice', 'InvoiceController@index')->middleware('Role');

    Route::get('/Invoice/List', 'InvoiceController@listInvoice')->middleware('Role');

    // Datewise Invoice List
    Route::get('/Sale/DateInvoice/{From}/{To}','InvoiceController@DateWiseInvoiceList');

    //Refund List
    Route::get('/Sale/RefundInvoice','InvoiceController@DateWiseRefundInvoiceList');

    // Load Invoice Settings view
    Route::get('/Invoice/Settings', 'InvoiceController@createSettings')->middleware('Role');

    // Store Invoice Settings
    Route::post('/Invoice/Settings', 'InvoiceController@updateSettings')->middleware('Role');

    // edit Invoice settings
    Route::get('/Invoice/Settings/Edit/{ShopID}', 'InvoiceController@editSettings')->middleware('Role2');

    // update Invoice Settings
    Route::post('/Invoice/Settings/Edit', 'InvoiceController@updateSettings')->middleware('Role');

    //Table Settings

    Route::get('/Table/Settings/','TableController@create');

    Route::post('/Table/New/','TableController@store');

    Route::post('/Table/Update/','TableController@update');

    Route::get('/Table/Details/{TableID}','TableController@details');

    Route::get('/Table/Delete/{TableID}','TableController@delete');

    //Kitchen Settings
    Route::get('/Kitchen/Settings/','KitchenController@create')->middleware('Role');
    Route::post('/Kitchen/New/','KitchenController@store');
    Route::post('/Kitchen/Update/','KitchenController@update');
    Route::get('/Kitchen/Delete/{KitchenID}','KitchenController@delete');

// Print Sales Invoice
    Route::get('/Invoice/Sales/Print/{InvoiceID}','InvoiceController@InvoicePrint')->middleware('Role2');

    Route::get('/Invoice/Sales/Details/{InvoiceID}','InvoiceController@InvoiceDetails')->middleware('Role2');

    Route::get('/Invoice/Sales/Details/Modal/{InvoiceID}','InvoiceController@InvoiceDetailsforModal')->middleware('Role2');

    Route::get('/Invoice/Advance/Print/{InvoiceID}','SalesController@advancePrintFromList')->middleware('Role2');

    Route::get('/Invoice/Advance/Details/{InvoiceID}','SalesController@advanceDetailsFromList')->middleware('Role2');

    // Print Refund Invoice
    Route::get('/Invoice/Refund/Print/{InvoiceID}','InvoiceController@InvoicePrint')->middleware('Role2');

    // Print Purchase Invoice
    Route::get('/Invoice/Purchase/Print/{InvoiceID}','InvoiceController@InvoicePrint')->middleware('Role');

    Route::get('/purchasevoice/{ProductID}/{Quantity}/{UnitPrice}/{SubTotal}/{VendorID}/{TotalPrice}/{Paid}/{Due}/{Bank}/{Memo}/{BankID}/{Cheque}','PurchaseController@store');

    Route::get('/ReturnPurchaseInvoice/{InvoiceID}/{ShopID}/{ProductID}/{Quantity}/{UnitPrice}/{SubTotal}/{Reason}/{VendorID}/{TotalPrice}/{Paid}/{Due}','PurchaseController@returnStore'); 



    /*********************   Vendor Routes ************************/
    Route::get('/Vendor', 'VendorController@index')->middleware('Role');

    // load new vendor create view
    Route::get('/Vendor/New','VendorController@createVendor')->middleware('Role');

    Route::post('/Vendor/New','VendorController@storeVendor')->middleware('Role');

    Route::post('/Vendor/New/Bulk','ExcelController@postVendor')->middleware('Role');

    // show vendor list
    Route::get('/Vendor/List','VendorController@listVendor')->middleware('Role');

    // show details of a vendor
    Route::get('/Vendor/Details/{VendorID}','VendorController@detailsVendor')->middleware('Role2');

    Route::get('/Vendor/Delete/{VendorID}','VendorController@destroyVendor')->middleware('Role2');

    Route::get('/Vendor/Invoices/{VendorID}','VendorController@listInvoice')->middleware('Role2'); 

    // load vendor edit view
    Route::get('/Vendor/Edit/{VendorID}', 'VendorController@editVendor')->middleware('Role2');    

    // update vendor via post method
    Route::post('/Vendor/Edit/{VendorID}', 'VendorController@updateVendor')->middleware('Role2');

    // vendor balance
    Route::get('/Vendor/Balance','VendorController@showBalance')->middleware('Role');    

    Route::get('/Vendor/Balance/{VendorID}', 'VendorController@showBalance')->middleware('Role');
    
    Route::get('/Vendor/Payment/{VendorID}', 'VendorController@showPayment')->middleware('Role2');

    Route::get('/Vendor/Payment/Ajax', 'VendorController@storePayment');

    // vendor ledger
    Route::get('/Vendor/Ledger', 'VendorController@createLedger')->middleware('Role');

    Route::get('/Vendor/Ledger/Delete/{LedgerID}','VendorController@destroyLedger')->middleware('Role2');

    Route::get('/Vendor/Ledger/Edit/{LedgerID}','VendorController@editLedger')->middleware('Role2');

    Route::post('/Vendor/Ledger/Edit/{LedgerID}','VendorController@updateLedger')->middleware('Role2');

    Route::get('/Vendor/Ledger/{VendorID}', 'VendorController@listLedger')->middleware('Role2');

    Route::get('/VendorPayment/{VendorID}/{Amount}/{Memo}/{Withdraw}/{BankID}/{ChequeNumber}','VendorController@ajaxPayment')->middleware('Role2');




    /*********************   Customer Routes ************************/

    Route::get('/Customer', 'CustomerController@index')->middleware('Role');

    // Select Customer
    Route::get('/Sales/Customer/Select/{CustomerID}','SalesController@CustomerSelect')->middleware('Role2');

    Route::get('/Sales/Customer/Balance/{CustomerID}','CustomerController@customerBalanceSale');

    // Reset Selected Customer
    Route::get('/Customer/Reset','CustomerController@reset')->middleware('Role');

    // load new customer create view
    Route::get('/Customer/New','CustomerController@createCustomer')->middleware('Role');

    // add new customer via post method
    Route::post('/Customer/New','CustomerController@storeCustomer')->middleware('Role');

    Route::post('/Customer/New/Bulk','ExcelController@postCustomer')->middleware('Role');

    // Add New Customer 
    Route::get('/AddCustomerFromSale/{Phone}/{Shop}/{FirstName}/{LastName}/{Address}/{City}/{Province}/{Country}/{ZipCode}/{Email}/{Notes}/{DateOfBirth}','SalesController@AddCustomer');

    // show customer list
    Route::get('/Customer/List', 'CustomerController@listCustomer')->middleware('Role');
    Route::get('/Customer/List/Data', ['as'=>'CustomerListData', 'uses' => 'CustomerController@makeList']);

    // show customer details
    Route::get('/Customer/Details/{ID}','CustomerController@detailsCustomer')->middleware('Role2');
    
    Route::get('DetailsCustomer/{ID}','CustomerController@AjaxCustomer')->middleware('Role2');

    Route::get('/cusdetailsale/{id}','CustomerController@detailsale');

    // load Customer Edit view    
    Route::get('/Customer/Edit/{ID}','CustomerController@editCustomer')->middleware('Role2');

    // update a customer via post method
    Route::post('/Customer/Edit/{ID}', 'CustomerController@updateCustomer')->middleware('Role2');

    // delete a customer
    Route::get('/Customer/Delete/{ID}','CustomerController@destroyCustomer')->middleware('Role2');

    // customer balance   
    Route::get('/Customer/Balance/{CustomerID?}', 'CustomerController@createBalance')->middleware('Role2');

    // Customer Payment
    Route::get('/Customer/Payment/{CustomerID?}', 'CustomerController@CreatePayment')->middleware('Role2');

    // customer ledger
    Route::get('/Customer/Ledger', 'CustomerController@createLedger')->middleware('Role');

    Route::get('/Customer/Ledger/{CustomerID}', 'CustomerController@showLedger')->middleware('Role2');

    Route::get('/Customer/Ledger/Delete/{LedgerID}','CustomerController@destroyLedger')->middleware('Role2');

    Route::get('/Customer/Ledger/Edit/{LedgerID}','CustomerController@editLedger')->middleware('Role2');
    Route::post('/Customer/Ledger/Edit/{LedgerID}','CustomerController@updateLedger')->middleware('Role2');

    // show customer details via JSON 
    Route::get('/customer_details_sales/{id}','CustomerController@detailssales');

    Route::get('/CustomerPayment/{CustomerID}/{Amount}/{Memo}/{Withdraw}/{BankID}/{ChequeNumber}','CustomerController@ajaxPayment')->middleware('Role2');




    /*********************   Accounts Routes ************************/
    Route::get('/Accounts', 'AccountsController@index')->middleware('Role');

    // Load Income Category List view
    Route::get('/Income/Category','IncomeController@createCategory')->middleware('Role');

    // create a new Income category via post method
    Route::post('/Income/Category/New','IncomeController@storeCategory')->middleware('Role');

    // return to Income Category list page in case of get method
    Route::get('/Income/Category/New','IncomeController@createCategory')->middleware('Role');

    // Income Category Update 
    Route::get('/Income/Category/Update/{CategoryID}/{CategoryName}','IncomeController@updateCategory')->middleware('Role');


    // load Income Create view
    Route::get('/Income/New', 'IncomeController@createIncome')->middleware('Role');

    // store new income
    Route::post('/Income/New', 'IncomeController@storeIncome')->middleware('Role');

    // Income List 
    Route::get('/Income/List', 'IncomeController@listIncome')->middleware('Role');

    // Income Edit
    Route::get('/Income/Edit/{ID}', 'IncomeController@editIncome')->middleware('Role2');

    // Income Update
    Route::post('/Income/Edit/{ID}', 'IncomeController@updateIncome')->middleware('Role2');

    // Income Delete
    Route::get('/Income/Delete/{ID}', 'IncomeController@deleteIncome')->middleware('Role');
    
    // load expense category list view
    Route::get('/Expense/Category', 'ExpenseController@createCategory')->middleware('Role');

    // Add new expense category via post method
    Route::post('/Expense/Category/New', 'ExpenseController@storeCategory')->middleware('Role');

    Route::get('/Expense/Category/Update/{CategoryID}/{CategoryName}', 'ExpenseController@updateCategory')->middleware('Role');

    // load New Expense create view
    Route::get('/Expense/New', 'ExpenseController@createExpense')->middleware('Role');

    Route::post('/Expense/New', 'ExpenseController@storeExpense')->middleware('Role');

     // Add Expense 
    Route::get('/ExpenseinSales/{ExpenseCategory}/{ExpenseUser}/{ExpenseValue}/{ExpenseNotes}','SalesController@Expense');

    // Expense List 
    Route::get('/Expense/List', 'ExpenseController@listExpense')->middleware('Role');

    // Expense Edit
    Route::get('/Expense/Edit/{ID}', 'ExpenseController@editExpense')->middleware('Role2');

    // Expense Update
    Route::post('/Expense/Edit/{ID}', 'ExpenseController@updateExpense')->middleware('Role2');

    // Expense Delete
    Route::get('/Expense/Delete/{ID}', 'ExpenseController@deleteExpense')->middleware('Role');


    /************************** On Screen Button Routes *******************/

    // load onscreen button list view
    Route::get('/OnScreenButton','OnScreenButtonController@createOnScreenButton')->middleware('Role');

    Route::get('/OnScreenButton/Delete/{ButtonID}','OnScreenButtonController@destroy')->middleware('Role');

    // add onscreen button
    Route::get('ProductSelection/{id1}/{id2}/{id3}','OnScreenButtonController@storeOnScreenButton');



    /************************** Payment Method Routes *******************/
    Route::get('/PaymentMethod', 'PaymentMethodController@Index')->middleware('Role');

    Route::post('/PaymentMethod/New', 'PaymentMethodController@Store')->middleware('Role');

    Route::get('/PaymentMethod/Edit/{ID}', 'PaymentMethodController@Edit')->middleware('Role2');

    //Route::get('/PaymentMethod/Update/{ID}/{Name}', 'PaymentMethodController@Update')->middleware('Role2');

    Route::post('/PaymentMethod/Update','PaymentMethodController@update');    




    /************************** Tax Routes *******************/

    Route::get('/Tax', 'TaxController@Index')->middleware('Role');

    Route::post('/Tax/New', 'TaxController@Store')->middleware('Role');

    Route::get('/Tax/New', 'TaxController@Index')->middleware('Role');

    Route::get('/Tax/Delete/{TaxID}', 'TaxController@Delete')->middleware('Role');

    Route::post('/Tax/Edit', 'TaxController@update')->middleware('Role');



    /************************** Bank routes *******************/

    // load bank view    
    Route::get('/Bank', 'BankController@index')->middleware('Role');

    // laod bank list view
    Route::get('/Bank/List','BankController@listBank')->middleware('Role');

    Route::get('/Bank/Edit/{BankID}','BankController@editBank')->middleware('Role');

    Route::post('/Bank/Edit/{BankID}','BankController@updateBank')->middleware('Role');



    // add new bank via post method
    Route::post('/Bank/New','BankController@storeBank')->middleware('Role');

    Route::get('purchase-new-bank/{id}/{id2}','BankController@storeBankWithGetMethod');

    // return to bank page in case of get method
    Route::get('/Bank/New','BankController@listBank')->middleware('Role');

    //Show The Details of a Bank
    Route::get('/Bank/Details/{BankID}','BankController@detailsBank')->middleware('Role');



    // delete a bank
    Route::get('/Bank/Delete/{BankID}', 'BankController@destroyBank')->middleware('Role2');

    // load Bank Withdraw
    Route::get('/Bank/Withdraw', 'BankController@createWithdraw')->middleware('Role');

    // store new Withdraw via post method
    Route::post('/Bank/Withdraw/New', 'BankController@storeWithdraw')->middleware('Role');

    //  return to bank page in case of get method
    Route::get('/Bank/Withdraw/New', 'BankController@createWithdraw')->middleware('Role');

    // load Bank Deposit
    Route::get('/Bank/Deposit', 'BankController@createDeposit')->middleware('Role');

    // store new deposit via post method
    Route::post('/Bank/Deposit/New', 'BankController@storeDeposit')->middleware('Role');

    // return to deposit page in case of get method
    Route::get('/Bank/Deposit/New', 'BankController@createDeposit')->middleware('Role');

    Route::get('/Bank/Ledger/List/{BankID}',    'BankController@listLedger')->middleware('Role2');

    Route::get('/Bank/Ledger/Edit/{LedgerID}',  'BankController@editLedger')->middleware('Role2');

    Route::post('/Bank/Ledger/Edit/{LedgerID}',  'BankController@updateLedger')->middleware('Role2');

    Route::get('/Bank/Ledger/Delete/{LedgerID}','BankController@destroyLedger')->middleware('Role2');
    
   

    /*********************** Product Routes ***********************/
    // load product page
    Route::get('/Product', 'ProductController@index')->middleware('Role');

    // load product create view
    Route::get('/Product/New','ProductController@createProduct')->middleware('Role');

    // store new product via post method
    Route::post('/Product/New','ProductController@storeProduct')->middleware('Role');

    // Store new product via get method with minimum properties
    Route::get('/Product/New/Min','ProductController@storeProductMin')->middleware('Role');

    // Store new products via bulk insert
    Route::post('/Product/New/Bulk','ExcelController@postProduct')->middleware('Role');

    // load product list view
    Route::get('/Product/List', 'ProductController@listProduct')->middleware('Role');
    Route::get('/Product/List/Data', ['as'=>'ProductListData', 'uses' => 'ProductController@makeList']);

    Route::get('/Product/List/Mapping/{ShopID}', 'ProductController@listProductMapping')->middleware('Role');

    Route::get('Kitchen/Category/Mapping/','KitchenController@mapping');

    // Product List by Filtering
    Route::get('/Product/List/{ShopID}/{CategoryID}/{VendorID}/{DateFrom}/{DateTo}','ProductController@filterProductList')->middleware('Role2');
   

    // Product Details of Shop
    Route::get('/Product/Details/ShopID/{ProductID}','ProductController@detailsProduct')->middleware('Role2');


    // Edit Product
    Route::get('/Product/Edit/{ProductID}', 'ProductController@editProduct')->middleware('Role'); 

    Route::post('/Product/Edit', 'ProductController@updateProduct')->middleware('Role2');

    // Delete Product
    Route::get('/Product/Delete/{ProductID}', 'ProductController@destroyProduct')->middleware('Role2');

    // load product category list and create view
    Route::get('/Product/Category','ProductController@createCategory')->middleware('Role')->middleware('Role');

    // add new category via post method
    Route::post('/Product/Category','ProductController@storeCategory')->middleware('Role')->middleware('Role');

    // Category Details
    Route::get('/Product/Category/Details/{CategoryID}', 'ProductController@detailsCatgory')->middleware('Role2');

    //Route::get('/Product/Category/Update/{CategoryID}/{CategoryName}', 'ProductController@updateCategory')->middleware('Role2');
    Route::post('/Product/Category/Update','ProductController@updateCategory');

    Route::get('/Product/List/ShopWise','ProductController@shopProductList');

    Route::get('/Product/Search/ByName/{Title}/{CategoryID}','ProductController@searchItemByName');

    Route::get('/Product/Search/ByID/{Title}','ProductController@searchItemByID');

    // Search Product by name and return as JSON, minimum information
    Route::get('/Product/Search/ByName/{Name}', 'ProductController@searchProduct');

    



    /************************ Product Inventory Routes ***************/
    // Load Inventory Check View
    Route::get('/Product/Inventory/', 'InventoryController@Inventory')->middleware('Role');

    // Check the Product
    Route::get('/Product/Inventory/Check/{ShopID}/{ProductID}', 'InventoryController@CheckProduct')->middleware('Role2');

    // Check Inventory
    Route::get('/Product/Inventory/Store/{ShopID}/{ProductID}', 'InventoryController@CheckInventory')->middleware('Role2');

    // Reset Inventory
    Route::get('/Product/Inventory/Reset/{ShopID}', 'InventoryController@Reset')->middleware('Role2');

    // generate inventory report
    Route::get('/Product/Inventory/Report/{ShopID}', 'InventoryController@Report')->middleware('Role2');

    // print inventory report
    Route::get('/Product/Inventory/Report/Print/{ShopID}', 'InventoryController@PrintReport')->middleware('Role2');





    /*********************** Product Purchase Routes ***********************/
    // load product purchase create view
    Route::get('/Product/Purchase','PurchaseController@index')->middleware('Role');

    Route::get('/Product/Purchase/New','PurchaseController@Create')->middleware('Role');

    Route::post('Purchase/store','PurchaseController@store')->middleware('Role');

    // Purchase REturn 
    Route::get('/Product/Purchase/Return','PurchaseController@PurchaseReturn')->middleware('Role');

    // Purchase Return List
    Route::get('/Product/Purchase/Return/List','PurchaseController@listReturn')->middleware('Role');

    // Purchase List
    Route::get('/Product/Purchase/List','PurchaseController@ListPurchaseInvoice')->middleware('Role');

    // New Purchase
    Route::get('/Product/Purchase/New/{id}/{id2}/{id3}/{id4}/{id5}/{id6}/{id7}/{id8}/{id9}/{id10}/{id11}/{id12}','PurchaseController@Store')->middleware('Role2');


    Route::get('/purchase-new-cat/{id}','ProductController@storeCategoryByGetMethod');    

    Route::get('/OSB-Shop/{ShopID}','OnScreenButtonController@ShopwiseCategoryList');
    
    Route::get('purchase-bank','BankController@listBankToJson');

    Route::get('purchase-detail/{id}','ProductController@detailsProductByGetMethod');

    Route::get('/listProductWithParam/{ID}/{ID1}/{ID2}/{ID3}/{ID4}', 'ProductController@listProductWithParam');




    /*********************   Product Distribution Routes ************************/
    // load product list
    Route::get('/Product/Distribute','ProductController@shopProductMapping')->middleware('Role')->middleware('Role');

    Route::post('/Product/Distribute/','ProductController@ShopByShop')->middleware('Role');

    // load product distribute view
    Route::get('/Product/Distribute/{ProductID}','ProductController@shopProductMappingList')->middleware('Role2')->middleware('Role2');

    // distribute product via post method
    Route::post('/Product/Distribute/{ProductID}','ProductController@storeShopProductMapping')->middleware('Role2');

    // load distribute edit view
    Route::get('/Product/Distribute/Edit/{ID}','ProductController@editShopProductMapping')->middleware('Role2');

    // update distribution via post method
   // Route::post('/Product/Distribute/Edit/{ID}','ProductController@updateShopProductMapping')->middleware('Role2');
    Route::post('/Product/Admin/Distribute/Edit/','ProductController@updateShopProductMapping');



    /*********************   Product Barcode Routes ************************/
    // load product barcode view
    Route::get('/Product/Barcode','BarCodeController@index')->middleware('Role');

    Route::get('/Product/Barcode/ShopIDtoName/{ShopID}','BarCodeController@idtoName');

    // Print Barcode
    Route::post('/Product/Barcode/Print','BarCodeController@PrintBarCode');


    /*********************   Product QR Code Routes ************************/

    // load product QR Code view
    Route::get('/Product/QRCode','BarCodeController@QRCode')->middleware('Role');

    Route::get('/Product/QRCode/ShopIDtoName/{ShopID}','BarCodeController@idtoName');

    // Print QR Code
    Route::post('/Product/QRCode/Print','BarCodeController@PrintQRCode');


    /*********************** Shop Routes ***********************/

    // load shop view
    Route::get('/Shop', 'ShopController@index')->middleware('Role');

    // load shop create view
    Route::get('/Shop/New','ShopController@create')->middleware('Role');  

    // create new shop via post method
    Route::post('/Shop/New','ShopController@store')->middleware('Role');

    // load shop list view
    Route::get('/Shop/List','ShopController@listShop')->middleware('Role');

    // shop details
    Route::get('/Shop/Details/{ShopID}', 'ShopController@details')->middleware('Role2');

    // shop edit
    Route::get('/Shop/Edit/{ShopID}', 'ShopController@edit')->middleware('Role2');

    // update shop via post method
    Route::post('/Shop/Edit/{ShopID}', 'ShopController@update')->middleware('Role');

    Route::get('/Shop/Category/Mapping/{ShopID}', 'ShopController@mapping');

    Route::get('/Shop/Product/Mapping/{ShopID}', 'ShopController@mappingProduct');

    Route::get('/Shop/Category/Mapping/Delete/{MappingID}', 'ShopController@mappingDelete');

    Route::get('/Shop/Product/Mapping/Delete/{MappingID}', 'ShopController@mappingProductDelete');

    Route::get('/Shop/Setting/List/{ShopID}','ShopController@settings');

    Route::get('/Shop/Setting/Update/{ShopID}/{Index}/{Value}/{Service}','ShopController@settingsUpdate');





    /*********************** Waste Routes ***********************/

    Route::get('/Waste', 'WasteController@index')->middleware('Role');

    // load waste create view
    Route::get('/Waste/New', 'WasteController@create')->middleware('Role');

    // store a waste via get method
    Route::get('/Waste/New/{ShopID}/{ProductID}/{Qty}/{UnitCost}/{TotalPrice}/{WastedBy}/{Note}','WasteController@store')->middleware('Role2');    

    // load  a waste edit form
    Route::get('/Waste/Edit/{WasteID}','WasteController@edit')->middleware('Role2');

    // edit waste via post method
    Route::post('/Waste/Edit/{WasteID}','WasteController@update')->middleware('Role2');

    // Delete Waste
    Route::get('/Waste/Delete/{WasteID}','WasteController@destroy')->middleware('Role2');

    // waste list view 
    Route::get('/Waste/List', 'WasteController@listWaste')->middleware('Role');

    



    /*********************** User Routes ***********************/

    // load user page
    Route::get('/User', 'UserController@index')->middleware('Role');

    // load new user create view
    Route::get('/User/New','UserController@create')->middleware('Role');

    Route::post('/User/New','UserController@store')->middleware('Role');

    // load user list
    Route::get('/User/List','UserController@listUser')->middleware('Role');

    Route::get('/User/Role','UserController@RoleAssignment')->middleware('Role');

    Route::post('/User/Role','UserController@storeRoleAssignment')->middleware('Role');

    // load user edit view
    Route::get('/User/Edit/{UserID}', 'UserController@edit')->middleware('Role2');

    // update user via post method
    Route::post('/User/Edit/{UserID}', 'UserController@update')->middleware('Role2');

    // Delete User
    Route::get('/User/Delete/{UserID}', 'UserController@destroy')->middleware('Role2');

    // User details
    Route::get('/User/Details/{UserID}', 'UserController@details')->middleware('Role2');

    // user activity log
    Route::get('/User/Activity/{UserID}', 'UserController@activityLog')->middleware('Role2');

    // user sales history
    Route::get('/User/History/{UserID}', 'UserController@history')->middleware('Role2');

    // user specific permission
    Route::get('/User/Permission/{UserID}', 'UserController@permission')->middleware('Role2');

    Route::post('/User/Permission/{UserID}', 'UserController@storePermission')->middleware('Role2');

    // Settings
    Route::get('/Settings', 'DashboardController@createSettings')->middleware('Role');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
