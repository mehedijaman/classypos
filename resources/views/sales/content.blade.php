<?php
  $ShopID       = session()->get('ShopID');
  $ProductID    = session()->get('ProductID');
  $ProductName  = session()->get('ProductName');
  $Qty          = session()->get('Qty');
  $Price        = session()->get('Price');
  $TotalPrice   = session()->get('TotalPrice');
  $Discount     = session()->get('Discount');
  $IDoftheCustomer=session()->get('CustomerID');
?>
@extends('layouts.sales')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="row inner-content hidden">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          @if(Cookie::get('IsRefund')==1)
            <a><a class="btn bg-blue" id="refund"><span>Refund</span></a></a>
          @endif

          <span id="customername">
            <?php
              if(session()->has('CustomerName')){
                $cname = session()->get('CustomerName');
                $cid = session()->get('CustomerID');
                echo '<input type="hidden" id="cid" value="'.$cid.'" >';
                echo '<a class="btn bg-blue " id="customer">'.$cname.'</a>';
              }
              else{
                echo '<input type="hidden" id="cid" value="0" >';
                echo '<a class="btn bg-blue" id="customer">Customer</a>';
              }
            ?>                
          </span> 

          @if(Cookie::get('IsOrder')==1)
            <button class="btn bg-blue" id="TableID">Table</button>
          @endif

          @if(Cookie::get('IsOrder')==1)
            <a class="btn bg-blue hidden" id="OrderPlace">KOT</a>
          @endif
          @if(Cookie::get('IsHold')==1)
            <!-- <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4" style="padding-right: 0px;margin-bottom: 2px;"> -->
              <a class="btn bg-green  disabled btn-flat" id="SaleHold">Hold</a>
            <!-- </div> -->
          @endif  
          @if(Cookie::get('IsAdvance')==1)
            <!-- <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4" style="padding-right: 0px;margin-bottom: 2px; margin-bottom: 2px;">                       -->
              <a class="btn bg-purple disabled btn-flat" id="Advance">Advance</a>
            <!-- </div> -->
          @endif
        </div>
      </div>     
    </section>

    @if(session()->has('Azhar'))
    <iframe id="fred" name="frame1" width="200" height="200"></iframe>
      <input type="text" id="KOTChecking" value="{{session()->get('Azhar')}}">
    @else
      <input type="hidden" id="KOTChecking" value="0">      
    @endif

    <div data-ng-app="indexDBSample" data-ng-controller="TodoController as vm">
      <table>
        <tr data-ng-repeat="todo in vm.todos">          
          <td>[<a href="#" data-ng-click="vm.deleteTodo(todo.id)">X</a>]</td>
        </tr>
      </table>
      <br />
      <!-- <input type="text" data-ng-model="vm.todoText" name="todo" placeholder="What's pending?" style="width: 200px;" /> -->
      <!-- <input type="button" value="Add" data-ng-click="vm.addTodo()"/>
      <input type="button" value="Refresh" data-ng-click="vm.refreshList()" /> -->
    </div>

    <input type="hidden" value="{{ $ShopID }}" id="IDofTheShop" name="shopid" class="form-control">
    <input type="hidden" value="{{$user->FirstName}}" id="shop_user_name"   name="username"  class="form-control">
    <input type="hidden" value="0" id="TableIDforOrder">
    <input type="hidden" value="0" id="OrderIDforOrderUpdate">
    <input type="hidden" value="0" id="CounterIDforList">
    <input type="hidden" value="0" id="Customerid">
    <input type="hidden" value="0" id="InvoiceIDforTender">
    <input type="hidden" value="0" id="OrderIDforInvoice">
    <input type="hidden" value="0" id="ParcelTest">
    <input type="hidden" value="0" id="BookingTest">
    <input type="hidden" value="0" id="KOTPrintOrderID">
    <input type="hidden" value="0" id="KOTPrintParcelTest">
    <input type="hidden" value="0" id="CounterTest">
    <input type="hidden" value="{{session()->get('Currency')}}" id="CurrencySymb">
    <input type="hidden" value="0" id="LocalCustomer">
    <input type="hidden" value="0" id="IndexForAdvanceDelete">
    <input type="hidden" value="0" id="RefundCheckforPayment">

    <!-- <div ng-app=""> -->

  
    <!-- <p>Name: <input type="text" ng-model="name"></p> -->
    <!-- <p ng-bind="name"></p> -->

    <!-- </div> -->
    
    
    <div id="CustomerArea">
      <input type="hidden" value={{$IDoftheCustomer}} id="customerid">
    </div>
    <input type="hidden" value="{{Cookie::get('IsTax')}}" id="TaxCookieCheck">
    <input type="hidden" value="{{Cookie::get('IsDiscount')}}" id="DiscountCookieCheck">  
    <input type="hidden" value="{{Cookie::get('IsServiceCharge')}}" id="ServiceCookieCheck">  
    <input type="hidden" value="{{Cookie::get('ServiceCharge')}}" id="ServiceChargeCookieCheck">  

    <div id="HiddenArea">
      <input type="hidden" value="{{ $product->toJson() }}" id="LookupProducts">
      <input type="hidden" value="{{$Draweropening}}" id="DrawerTest">
      <input type="hidden" value="{{Cookie::get('IsRestaurant')}}">
      <input type="hidden" value="{{Cookie::get('IsServiceCharge')}}">
      <input type="hidden" value="{{Cookie::get('IsTips')}}">
      <input type="hidden" value="{{Cookie::get('IsOrder')}}">
      <input type="hidden" value="{{Cookie::get('IsHold')}}">
      <input type="hidden" value="{{Cookie::get('IsAdvance')}}">
      <input type="hidden" value="{{Cookie::get('IsBarcode')}}">
      <input type="hidden" value="{{Cookie::get('InvoiceFormat')}}">
      <input type="hidden" value="{{Cookie::get('name')}}">

      
      <input type="hidden" value="0" id="PreviousAdvanceCheck">
      <input type="hidden" value="0" id="AdvanceIDValue">
      <input type="hidden" value="0" id="HoldIDValue">
      <input type="hidden" value="0" id="AdvanceAmountValue">
      <input type="hidden" value="0" id="AdvanceDueValue">
      <input type="hidden" value="0" id="AdvancePayableValue">
      <input type="hidden" value="0" id="keychecking">
      <input type="hidden" value="0" id="CardPaymentMethodID">
      <input type="hidden" value="0" id="CardPaymentMethodName">
      <input type="hidden" value="0" id="CustomerBalance">
      <input type="hidden" value="0" id="taxoverall">
      <input type="hidden" value="0" id="discountoverall">
      <input type="hidden" value="0" id="subtotaloverall">
      
          
      <input type="hidden" value="0" id="AllDiscountforCash">
      <input type="hidden" value="0" id="AllDiscountforPercentage">
      <input type="hidden" value="0" id="SingleDiscountforCash">
      <input type="hidden" value="0" id="SingleDiscountforPercentage">
      <input type="hidden" value="0" id="LoadInvoicefromList">
      <input type="hidden" value="0" id="TotalDiscountforInvoice">
      <input type="hidden" value="0" id="TotalDiscountforInvoiceforAdvance">
      <input type="hidden" value="0" id="NoLoadFromInvoicePrint">
      <input type="hidden" value="0" id="NoLoadFromOrderPrint">
      <input type="hidden" value="0" id="DicountPercent">
      <input type="hidden" value="0" id="HoldIDforDelete">
      <input type="hidden" value="0" id="IndexIDforHoldDelete">
      <input type="hidden" value="0" id="LoadFromAdvanceWithoutReload">
      <input type="hidden" value="0" id="ImranKhan">
      <input type="hidden" value="0" id="productselectedid" name="productselected">  
      <input type="hidden" value="0" id="productselectedidoriginal" name="productselected" >
      <input type="hidden" value="1" id="ShopExistenceCheck"  name="ShopCheck">
      <!-- <button id="ButtonCheck">Check</button> -->
      <!-- <meta name="_token" content="{{ csrf_token() }}" />             -->

      
      
      <input type="hidden" value="{{$admin}}" id="admin" name="admin" >
      <input type="hidden" value="0" id="TaxID">        
      
    </div>

    <section class="content">
      <div class="col-md-4 col-sm-4 col-lg-4 col-xs-6 inner-content hidden">
        <div class="row" id="RowforOrderDetails">
          <div class="box box-primary box-solid">              
            <div class="box-header with-border">
              <i class="fa fa-spinner fa-spin"></i> 
              <button type="button" class="btn btn-primary btn-sm" data-widget="collapse">Running Order Items</button>

              <div class="pull-right">
                <button type="button" id="ListToTicket" class="btn btn-primary btn-sm" title="Reprint KOT"><i class="fa fa-print fa-lg"></i></button>
                <button type="button" id="OrderCancel" class="btn btn-primary btn-sm" title="Cancel Order"><i class="fa fa-times fa-lg"></i></button>
              </div>
            </div>
            <div class="box-body" >                  
              <table class="table table-responsive table-condensed" id="OrderDetailsListBody">
              </table>
            </div>
            <div class="box-footer">
              <button class="btn bg-maroon" id="ListToCart"><i class="fa fa-chevron-down"></i> Make Bill</button>                
            </div>
          </div>
        </div>

        <div class="row">
          {{ Form::open(array('id' => 'SidebarForm')) }}              
            @if(Cookie::get('IsBarcode') == 1)
              <div class="input-group input-group">
                <span class="input-group-addon"><i class="fa fa-barcode fa-lg"></i></span>
                <input type="text" id="saqlain" name="barcodeInput" class="form-control" autofocus autocomplete="off" placeholder="Search/Scan here">
                <span class="input-group-btn">
                  <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-plus"></i>
                  </button>
                </span>
              </div>
            @endif 
          {{ Form::close() }}           
        </div>

        <!-- =============== Product Cart ====================== -->
        <div class="row">
          <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">   -->
            <div class="box box-success">              
              <!-- <div class="box-header with-border">
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                  <strong>Qty</strong>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                  <strong>Item</strong>
                </div>

                

                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                  <strong>Price</strong>
                </div>

                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                  <strong>Total</strong>
                </div>

                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                  <strong><i class="fa fa-trash fa-lg"></i></strong>
                </div>
              </div> -->

              <div class="box-body" id="CartContent">
                <div class="box-group" id="accordion">
                  <div id="add">
                  <!-- <button ng-click="GreatWork()">Great</button>  -->
                    <!-- <div class="panelCartRow box box-solid box-default" style="margin: 0px 0px 1px 0px;">
                      <div class="box-header CartRowHeader">
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                          <a href="#"><strong>100</strong></a>
                        </div>

                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed">
                            <strong>Collapsible Group Item with</strong>
                          </a>
                        </div>

                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                          <strong>15000</strong>
                        </div>

                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                          <strong><i class="fa fa-trash fa-lg"></i></strong>
                        </div>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false">
                        <div class="box-body">
                          <button class="btn btn-primary">Discount</button>
                          <button class="btn btn-primary">VAT</button>
                          <button class="btn btn-primary">Sale By</button>
                        </div>
                      </div>
                    </div> -->
                  </div>
                </div>                
              </div>
              <!-- <div class="box-footer">
                <a class="btn bg-red disabled" id="Cancel">Clear</a> 
              </div> -->
            </div> 
            <script>
              $(function(){
                $('#CartContent').slimScroll({
                  size: '5px',
                  height: '430px',
                  width: 'auto',
                  wheelStep: 50,
                  alwaysVisible: false
                });                
              });
            </script>
          <!-- </div> -->
        </div>

        <div class="row">
          <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><strong>Total Item</strong></div>
            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><strong><span id="InvoiceTotalItem">0</span></strong></div>

            <div class="col-xs-4 col-sm-4 col-lg-4 col-md-4"><strong>Sub Total</strong></div>
            <div class="col-xs-2 col-sm-2 col-lg-2 col-md-2"><strong><span id="SubTotal">0</span></strong></div> 
          </div>

          <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><strong>Total Qty</strong></div>
            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><strong><span id="InvoiceTotalQty">0</span></strong></div>

            <div class="col-xs-4 col-sm-4 col-lg-4 col-md-4"><strong>Tax</strong></div>
            <div class="col-xs-2 col-sm-2 col-lg-2 col-md-2"><strong><span id="VatTotal">0</span></strong></div> 
          </div>

          <div class="row">
            <div class="col-xs-4 col-sm-4 col-lg-4 col-md-4"><strong>Table No.</strong></div>
            <div class="col-xs-2 col-sm-2 col-lg-2 col-md-2"><strong><span id="">0</span></strong></div> 

            <div class="col-xs-4 col-sm-4 col-lg-4 col-md-4"><strong>Discount</strong></div>
            <div class="col-xs-2 col-sm-2 col-lg-2 col-md-2"><strong><span id="DiscountTotal">0</span></strong></div>
          </div>

          <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><strong>Order ID</strong></div>
            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><strong><span id="BottomOrderID">0</span></strong></div>

            <div class="col-xs-3 col-sm-4 col-lg-4 col-md-4"><strong>Service Charge</strong></div>
            <div class="col-xs-2 col-sm-2 col-lg-2 col-md-2"><strong><span id="ServiceCharge">0</span></strong></div>
          </div>

          <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><strong>Invoice ID</strong></div>
            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><strong><span id="BottomInvoiceID">0</span></strong></div>
            
            <div class="col-xs-4 col-sm-4 col-lg-4 col-md-4"><strong>Net Total</strong></div>
            <div class="col-xs-2 col-sm-2 col-lg-2 col-md-2"><strong><span id="Total">0</span></strong></div> 
          </div>

          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
              <a class="btn bg-red disabled" id="Cancel">Clear</a>                 
              @if(Cookie::get('IsDiscount')==1)
                  <a class="btn bg-blue disabled" id="DiscountOverAll" >Discount</a>
              @endif
              @if(Cookie::get('IsTax')==1)
                  <a class="btn bg-aqua disabled" id="TaxOverall" >VAT</a>                    
              @endif                  
              <a class="btn bg-yellow disabled " id="PrintInvoice">Print Bill</a>
            </div>
          </div>

          <div class="row" style="margin-top: 5px;">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <a class="btn bg-green disabled btn-block btn-lg" id="tender"> <i class="fa fa-chevron-circle-right"></i><br><strong>Pay</strong></a>
            </div>
          </div>
        </div>             
      </div>

      <!-- =============== Product List ====================== -->
      <div class="col-md-8 col-sm-8 col-lg-8 col-xs-6 inner-content hidden">
        <!-- <div class="row"> -->
          <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> -->
                <div class="input-group input-group">
                  <span class="input-group-addon"><i class="fa fa-search"></i></span>
                  <input type="text" id="ProductSearchInput" name="SearchProduct" class="form-control" autocomplete="off" placeholder="Search Product Name">
                  <!-- <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-plus"></i>
                    </button>
                  </span> -->
                </div>
          <!-- </div> -->
        <!-- </div> -->

        <div class="box box-solid">              
          <div class="box-header with-border" id="ProductCategoryContainer" style="padding: 0px; margin:0px;">
            @foreach ($CategoryList as $Category)
              <div class="col-sm-2 col-md-2 col-lg-2 col-xs-4" style="padding: 0px 5px 0px 0px; margin: 5px 0px 0px 0px;">
                <button name="CategoryFilter[]" type="button" class="btn btn-block  CategoryFilter" value="{{ $Category->CategoryID }}">
                @if($Category->Image != null)                  
                  <img src="/uploads/image/productCategory/{{$Category->Image}}" height="70" width="70">
                  <br>
                @endif                
                {{ $Category->CategoryName }}
                </button>
              </div>
            @endforeach
          </div>
          <div class="box-body" id="ProductListContainer" style="padding: 0px 0px 0px 0px;">
            @if($ShopID > 0)
              @foreach($btn as $data)
                <div class="col-sm-3 col-md-3 col-lg-3 col-xs-6" style="padding: 0px;">
                  <input type="hidden" name="hibuid[]" value="{{$data->ProductID}}">
                  <button name="topitem[]" type="button" class="btn btn-default btn-block topitem btn-flat" value="{{ $data->ProductID }}">
                    <span class="label label-primary pull-left">{{ $data->ProductID }}S{{ $ShopID }}</span>
                    <span class="pull-right">Price</span>
                    {{ $data->DisplayText }} <br>
                  </button>
                </div>
              @endforeach 
            @endif
          </div>
        </div>
        <script>
          $(function(){
            $('#ProductListContainer').slimScroll({
              size: '5px',
              height: '480px',
              width: 'auto',
              wheelStep: 50,
              alwaysVisible: false
            });

            $('#RefundInvoicePrint').slimScroll({
              size: '5px',
              height: '480px',
              width: 'auto',
              wheelStep: 50,
              alwaysVisible: false
            });


            $('#AdvanceInvoice').slimScroll({
              size: '5px',
              height: '480px',
              width: 'auto',
              wheelStep: 50,
              alwaysVisible: false
            });

            $('#ProductCategoryContainer').slimScroll({
              size: '5px',
              height: '215px',
              width: 'auto',
              wheelStep: 50,
              alwaysVisible: false
            });
          });
        </script>
      </div>
      
      {{ Form::open(array('id' => 'AdvanceForm', 'url' => '/Sale/Advance/Confirm', 'target' => 'AdvanceWindow')) }} 
      {{ Form::close() }}

      {{ Form::open(array('id'=>'CashSaleFormSubmit', 'url'=>'/Sale/Invoice', 'target'=>'TestWindow')) }}
        <div id="CashSaleForm"></div>
      {{ Form::close() }}

      {{ Form::open(array('id'=>'OrderFormSubmit', 'url'=>'/Sale/Order/New', 'target'=>'OrderWindow')) }}
        <div id="OrderForm"></div>
      {{ Form::close() }}

      {{ Form::open(array('id'=>'OrderFormSubmit', 'url'=>'/Sale/Order/New')) }}
        <div id="OrderForm"></div>
      {{ Form::close() }}

      {{ Form::open(array('id'=>'OrderFormforUpdateSubmit', 'url'=>'/Sale/Order/Update', 'target'=>'OrderWindowUpdate')) }}
        <div id="OrderFormforUpdate"></div>
      {{ Form::close() }}

      {{ Form::open(array('id'=>'OrderFormforUpdateWithoutProduct', 'url'=>'/Sale/Order/Update/WithoutProduct')) }}
      {{ Form::close() }}

      {{ Form::open(array('id'=>'OrderFormforInvoice', 'url'=>'/Sale/Order/Invoice', 'target'=>'OrderWindowforInvoice')) }}
      {{ Form::close() }}

      {{ Form::open(array('id'=>'OrderTicketForm')) }}
      {{ Form::close() }}


      {{ Form::open(array('id'=>'myform')) }}
        <input type="hidden" id="Payable" value="0">
        <input type="hidden" id="Paid" value="0">
        <input type="hidden" name="returned" id="Change" value="0" autocomplete="off">
        <div id="myformProductList"> </div>
      {{ Form::close() }}

      <!-- =================== Payment Methods Modal ===================-->
      <div class="modal" id="CashModal" role="dialog">
        <div class="modal-dialog modal-fullscreen-dialog" id="fahad">
            <div class="modal-content modal-fullscreen-content">
              <div class="modal-header">
                <button type="button" class="btn bg-maroon" data-dismiss="modal"><i class="fa fa-arrow-left"></i> <strong>Back</strong></button>

                <div class="pull-right">
                  <button type="button" class="btn bg-maroon" data-dismiss="modal"> <strong>Next Sale <i class="fa fa-arrow-right"></i></strong></button>
                </div>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="col-xs-4">
                      <ul class="nav nav-tabs tabs-left">
                        <li id="cash" class="active text-center"><a href="#CashPaymentTab" data-toggle="tab"><i class="fa fa-money fa-2x"></i><br><strong>Cash Payment</strong></a></li>
                        <li id="CardSingle" class="text-center"><a href="#CardPaymentTab" data-toggle="tab"><i class="fa fa-credit-card fa-2x"></i> <br><strong>Bank / Card</strong></a></li>
                        <li class="text-center"><a href="#SplitPaymentTab" data-toggle="tab"><i class="fa fa-random fa-2x"></i> <br><strong>Split Payment</strong></a></li>
                      </ul>
                    </div>

                    <div class="col-xs-8">
                      <div class="tab-content">
                        <div class="tab-pane active" id="CashPaymentTab">
                        
                          {{ Form::open(array('id'=>'myformshow')) }}
                            <div class="form-group">
                              <h3><label class="label label-primary">Total</label></h3>
                              <div class="input-group">
                                <input type="text" name="dada" id="PayableShow" class="form-control" readonly>
                                <span class="input-group-addon">{{ CurrencySymbol() }}</span>
                              </div>
                            </div>
                            <div class="form-group AdvanceCashAreaShow">   </div>
                            <div class="form-group" id="PayingAreaShow">
                              <h3><label class="label label-primary">Cash Paid</label></h3>
                              <div class="input-group">
                                <input type="text" name="paidshow" id="PaidShow" class="form-control" placeholder="Enter the paid amount" step=".0001" autocomplete="off" autofocus >                      
                              </div>
                            </div>
                            <div class="form-group" id="ExactButtonAreaShow">
                              <button type="button" class="btn   bg-purple btn-block btn-lg" id="ExactTenderAmountShow" class="form-control"> Exact Amount </button>
                            </div> 
                            <div class="form-group" id="ChangeAreaCashShow">
                              <h3><label class="label label-primary"> Change</label></h3>
                              <div class="input-group">
                                <input type="text" name="returned" id="ChangeShow" class="form-control"  value="0" autocomplete="off">                        
                                <span class="input-group-addon">{{ CurrencySymbol() }}</span>         
                              </div>
                            </div>
                            <div id="myformProductListShow"></div>
                            <div id="CashSubmitAreaShow">
                              <button type="submit" class="btn btn-success btn-lg   btn-block" id="SubmitTenderShow" disabled="disabled"><i class="fa fa-paper-plane"></i><br><strong>Submit Payment</strong></button>
                            </div>
                          {{ Form::close() }}
                        </div>

                        <div class="tab-pane" id="CardPaymentTab">
                          <div class="content">
                            {{ Form::open(array('class'=>'form-horizontal', 'id'=>'myformcard')) }}
                              <div class="form-group AdvanceCardArea"></div>
                              <div class="form-group">
                                <div class="col-xs-12">
                                  <h3><label class="label label-primary">Total:</label></h3>
                                </div>
                                <div class="col-xs-12">
                                  <input type="text" name="dada" id="PayableCard" class="form-control" readonly>
                                  <input type="hidden" name="cada[]" class="form-control" value="sss">
                                  <input type="hidden" name="cada[]" class="form-control" value="dhaka">
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-xs-12">
                                  <h3><label class="label label-primary">Card Number :</label></h3>
                                </div>
                                <div class="col-xs-12">
                                  <input type="number" name="paid" id="CardNumber" class="form-control" placeholder="Enter the Card Number" autocomplete="off" step=".0001">
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-xs-12">
                                  <h3><label class="label label-primary">Holder Name :</label></h3>
                                </div>
                                <div class="col-xs-12">
                                  <input type="text" name="paid" id="CardHolderName" class="form-control" placeholder="Enter Card Holder Name" autocomplete="off" maxlength="42">
                                </div>
                              </div>
                              
                              <div class="form-group" id="CustomerCheck">
                                <div class="col-xs-12">
                                  <h3><label class="label label-primary"> Amount :</label></h3>
                                </div>

                                <div class="col-xs-12">
                                  <input type="text" name="returned" id="CardAmountShow" class="form-control" style="padding:10px; font-size: 12px;" placeholder="Enter the Paid Amount" value="0" autocomplete="off">
                                </div>
                              </div>
                            
                              <div id="SingleCardBody">
                              </div>

                              <div class="form-group">
                                <button type="submit" class="btn btn-success btn-lg btn-block  " id="SubmitTenderCard" disabled="disabled"><i class="fa fa-paper-plane"></i><br>Submit</button>
                              </div> 
                            {{ Form::close() }}
                          </div>
                        </div>

                        <div class="tab-pane" id="SplitPaymentTab">
                          <div class="content">
                            {{ Form::open(array('class'=>'form-horizontal','id'=>'SplitPaymentForm')) }}

                              <table class="table table-bordered table-responsive table-condensed" id="SplitPaymentTable">
                                <tr>                  
                                  <th> Method Name</th>
                                  <th> Holder Name</th>
                                  <th> Card Number</th>
                                  <th> Amount     </th>                  
                                </tr>
                                <tbody id="SplitCardBody"> </tbody>
                              </table>

                              <div id="SplitCardCash">
                                <div class="form-group">
                                  <div class="col-md-4">
                                    <div class="input-group">
                                      <span class="input-group-addon">Cash Payable</span>
                                      <input type="text" id="SplitPaymentCashPaybale" value="0" readonly class="form-control">
                                    </div>                  
                                  </div>
                                  <div class="col-md-4">
                                    <div class="input-group">
                                      <span class="input-group-addon">Cash Paid</span>
                                      <input type="number" id="SplitPaymentCashPaid" class="form-control" value="0" step=".0001">
                                       <span class="input-group-btn"><button class=" btn bg-maroon" id="ExactAmountforSplitPayment">Exact</button></span>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="input-group">
                                      <span class="input-group-addon">Change</span>
                                      <input type="text" id="SplitPaymentCashChange" value="0"
                                      class="form-control" >
                                    </div>                  
                                  </div>
                                  <div id="SplitCardMethods"></div>
                                  <div id="SingleCardArea"></div>
                                  <div id="CardProductArea"></div> 
                                </div> 
                                <input type="hidden" name="CashPayable" class="bill2" id="SplitPaymentCashPaybaleForm" value="300">
                                <input type="hidden" name="CashPaid" id="SplitPaymentCashPaidForm" value="0">
                                <input type="hidden" name="CashChange" id="SplitPaymentCashChangeForm" value="0">
                                <input type="hidden" name="OverAllTaxSplit" value="0" id="OverAllTaxforSplit" placeholder="Tax Total">                       
                                <input type="hidden" name="AdvancePaymentValueSplit" value="0" id="AdvancePaymentValueforSplit" placeholder="Tax Total">                       
                                <input type="hidden" name="AdvanceIDValueSplit" value="0" id="AdvanceIDValueforSplit" placeholder="Tax Total">                       
                                <input type="hidden" name="OverAllDiscountSplit" value="0" id="OverAllDiscountforSplit" placeholder="Tax Total">                       
                                <input type="hidden" name="OverAllSubTotalSplit" value="0" id="OverAllSubTotalforSplit" placeholder="Tax Total">                       
                                                       
                                <input type="hidden" name="Paid" value="0" id="PaidforSplit">                       
                                <input type="hidden" name="InvoiceCheck" value="0" id="InvoiceCheckforSplit" placeholder="Tax Total">                       
                                <input type="hidden" name="Change" value="0" id="ChangeforSplit">                       
                                <input type="hidden" name="customer" value="0" id="customerforSplit">                      
                                <input type="hidden" name="Order" value="0" id="OrderforSplit" placeholder="Tax Total">
                              </div> 

                              <button type="button" class="btn btn-success btn-lg btn-block  " id="SubmitSplitPayment"><i class="fa fa-paper-plane fa-lg"></i> <br><strong>Submit Payment</strong></button>
                            {{ Form::close() }}
                          </div>
                        </div>
                      </div>
                    </div>                    
                  </div>
                  <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                    <button class="btn btn-default btn-block btn-lg" id="PrintRecipt" disabled><i class="fa fa-print"></i> Print</button>
                  </div>
                  <div class="col-md-6" id="SalesPanelRecipt">

                  </div>
                </div>
              </div>
              <div class="modal-footer">                
              </div>
            </div>
        </div>
      </div>

      <script>
        $(function(){
          $('#SalesPanelRecipt').slimScroll({
            size: '5px',
            height: '480px',
            width: '400px',
            wheelStep: 50,
            alwaysVisible: false
          });
        });
      </script>

     

      <!--=================== User Selection Modal ===================-->
      <div class="modal" id="userselect" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title text-center">
                <p class="label label-primary">Select Staff</p>
              </h1>
            </div>
            <div class="modal-body">
              <input type="hidden" name="usid" id="usid"> 
              @foreach ($alluser as $data)
                <input type="hidden" name="userid[]" value="{{$data->UserID}}" class="userid">
                <input class="btn bg-purple usersel   btn-app" name="usersel[]" type="button" value="{{$data->FirstName}}">
              @endforeach
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger  " data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>

      <!-- =================== Sale Price Modal ===================-->
      <div class="modal" id="PriceSelect" role="dialog">
        <div class="modal-dialog">          
          <div class="col-xs-6 col-md-6 col-sm-6 col-lg-6 col-xs-offset-3 col-md-offset-3 col-sm-offset-3 col-lg-offset-3">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-primary">Sale Price</p>
                </h1>
              </div>
              <div class="modal-body">
                <input type="hidden" name="priceindex" id="priceindex">
                <div class="input-group">  
                  <input type="number" class="form-control" min="1" step=".0001" id="modalpricechange" autocomplete="off" autofocus required>
                  <span class="input-group-btn">              
                    <input  class="btn bg-purple usersel  " id="pricesel" type="button" value="Apply"><br>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- =================== Quantity Modal ===================-->
      <div class="modal" id="quantityselect" role="dialog">
        <div class="modal-dialog modalquantity">          
          <div class="col-xs-6 col-md-6 col-sm-6 col-lg-6 col-xs-offset-3 col-md-offset-3 col-sm-offset-3 col-lg-offset-3">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-primary">Quantity</p>
                </h1>
              </div>
              <div class="modal-body">
                {{ Form::open(array('id'=>'QuantityForm')) }}
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon bg-olive"><strong>Current Stock :</strong></span>
                      <input type="text" class="form-control" id="ShopQuantity" readonly style="border: none;">
                    </div>
                  </div> 
                  <div class="input-group">
                    <span class="input-group-btn">
                      <button class="btn btn-primary" type="button" id="QuantityNumPadBtn"><i class="fa fa-calculator"></i></button>
                    </span>
                    <input type="hidden" name="quanindex" id="quanindex">
                    <input type="number" class="form-control" min="1" step=".0001" id="modalquanchange" autocomplete="off" autofocus required>
                    <span class="input-group-btn">              
                      <input  class="btn bg-purple usersel  " id="quantitysel" type="submit" value="Apply"><br>
                    </span>
                  </div>
                {{ Form::close() }}
              </div>
            </div>
          </div>
        </div>
      </div>  

      

      <!-- =================== Opening Balance Modal ===================-->
      <div class="modal" id="OpeningBalance" role="dialog">
        <div class="modal-dialog">
          <div class="col-xs-6 col-md-6 col-sm-6 col-lg-6 col-xs-offset-3 col-md-offset-3 col-sm-offset-3 col-lg-offset-3">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-primary">Opening Balance</p>
                </h1>
              </div>
              <div class="modal-body">
                {{ Form::open(array('id'=>'OpeningBalanceForm')) }}
                  <div class="input-group">
                    <input type="hidden" name="OpeningBalanceID" id="OpeningBalanceID">
                    <input type="number" step=".0001" class="form-control" id="OpeningBalanceValue" autocomplete="off" name="OpeningBalanceValue" autofocus>
                    <span class="input-group-btn">              
                      <input  class="btn bg-purple usersel  " id="OpeningBalanceSubmit" type="submit" value="Add Balance">
                    </span>
                  </div>
                {{ Form::close() }}
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- =================== Editing Balance Modal ===================-->
      <div class="modal" id="EditingBalance" role="dialog">
        <div class="modal-dialog">          
          <div class="col-xs-6 col-md-6 col-sm-6 col-lg-6 col-xs-offset-3 col-md-offset-3 col-sm-offset-3 col-lg-offset-3">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-primary">Editing Balance</p>
                </h1>
              </div>
              <div class="modal-body">
                {{ Form::open(array('id'=>'EditingBalanceForm')) }}
                  <input type="hidden" class="form-control" value="{{$CashDrawerID}}" id="CashDrawerID">
                  <div class="input-group">
                    <input type="hidden" name="EditingBalanceID" id="EditingBalanceID">
                    <input type="number" step=".0001" class="form-control" id="EditingBalanceValue" autocomplete="off" name="EditingBalanceValue" value="{{$BalanceValue}}" autofocus>
                    <span class="input-group-btn">              
                      <input  class="btn bg-purple usersel  " id="EditingBalanceSubmit" type="submit" value="Edit Balance">
                    </span>
                  </div>
                {{ Form::close() }}
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- =================== Closing Balance Modal ===================-->
      <div class="modal" id="ClosingBalance" role="dialog">
        <div class="modal-dialog">          
          <div class="col-xs-6 col-md-6 col-sm-6 col-lg-6 col-xs-offset-3 col-md-offset-3 col-sm-offset-3 col-lg-offset-3">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-primary">Closing Balance</p>
                </h1>
              </div>
              <div class="modal-body">
                <input type="hidden" class="form-control" value="{{$CashDrawerID}}" id="CashDrawerIDClose">
                <div class="input-group">
                  <input type="hidden" name="ClosingBalanceID" id="ClosingBalanceID">
                  <input type="number" step=".0001"  class="form-control" id="ClosingBalanceValue" autocomplete="off" name="ClosingBalanceValue" value="{{$BalanceValue}}">
                  <span class="input-group-btn">              
                    <input  class="btn bg-purple usersel  " id="ClosingBalanceSubmit" type="button" value="Close Balance">
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>     

      <!--===================== Open Item Modal ====================-->
      <div class="modal" id="OpenItemModal" role="dialog">
        <div class="modal-dialog modal-fullscreen-dialog">          
          <div class="modal-content modal-fullscreen-content">
            <div class="modal-header">
              <button type="button" class="btn bg-maroon" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Back</button>
              <h1 class="modal-title text-center"><p class="label label-primary"><i class="fa fa-opencart fa-lg"></i> Open Item</p></h1>
            </div>
            <div class="modal-body"> 
              <div class="content">
                {{ Form::open(array('class'=>'form-horizontal', 'id'=>'NewProductFromSale', 'url'=>'/Sale/Product/New')) }}
                  <input type="hidden" name="ProductEntryFromSale" value="1">
                  <div class="form-group">
                    <label for="CategoryID" class="col-sm-2 control-label">Category :</label>
                    <div class="col-sm-4">
                      <div class="input-group">
                        <select name="CategoryID" class="selectpicker form-control" data-live-search="true" id="PrCat">
                          @foreach($CategoryList as $Category) 
                            <option value="{{ $Category->CategoryID }}">{{ $Category->CategoryName }}</option>
                          @endforeach 
                       </select>
                        <span class="input-group-btn">
                          <button type="button" data-toggle="modal" data-target="#NewCategoryModal" class="btn bg-blue   " title="Add New Category"><i class="fa fa-plus"></i></button>
                        </span>
                      </div>                    
                    </div> 
                    <label for="VendorID" class="col-sm-2 control-label">Vendor :</label>
                    <div class="col-sm-4">
                      <div class="input-group">
                        <select name="VendorID" class=" form-control" id="VendorID">   
                          @foreach($VendorList as $Vendor)             
                            <option value="{{ $Vendor->VendorID }}">{{ $Vendor->VendorName }}</option>
                          @endforeach    
                        </select>  
                        <span class="input-group-btn">
                          <button data-toggle="modal" data-target="#NewSupplierModal" type="button" class="btn   bg-blue" title="Add New Supplier"><i class="fa fa-plus"></i></button>
                        </span>                    
                      </div>
                    </div>                 
                  </div>
                  <div class="form-group">
                    <label for="ProductName" class="col-sm-2 control-label">Name :</label>

                    <div class="col-sm-4">
                      <input name="ProductName" type="text" class="form-control" id="ProductName" placeholder="Enter Product Name">
                    </div>

                    <label for="ProductDescription" class="col-sm-2 control-label">Description:</label>

                    <div class="col-sm-4">
                      <input name="ProductDescription" type="text" class="form-control" id="ProductDescription" placeholder="Product Description">
                    </div>
                  </div>            
                  <div class="form-group">
                    <label for="Qty" class="col-sm-2 control-label">Qty :</label>
                    <div class="col-sm-4">

                      <input name="Qty" type="number" step="0.0001" class="form-control" id="Qty" placeholder="Qty" value="0">
                    </div>
                    <label for="MinQtyLevel" class="col-sm-2 control-label">MinQty :</label>
                    <div class="col-sm-4">
                      <input name="MinQtyLevel" type="number" step="0.0001" class="form-control" id="MinQtyLevel" placeholder="MinQtyLevel">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="CostPrice" class="col-sm-2 control-label">CP :</label>
                    <div class="col-sm-4">
                      <div class="input-group">
                        <input name="CostPrice" type="number" step="0.0001" class="form-control" id="CostPrice" placeholder="Cost Price">
                        <span class="input-group-addon"><strong>{{ currencySymbol() }}</strong></span>
                      </div>
                    </div>
                    <label for="SalePrice" class="col-sm-2 control-label">SP :</label>
                    <div class="col-sm-4">
                      <div class="input-group">
                        <input name="SalePrice" type="number" step="0.0001" class="form-control" id="SalePrice" placeholder="Sale Price">
                        <span class="input-group-addon"><strong>{{ currencySymbol() }}</strong></span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="Unit" class="col-sm-2 control-label">Unit :</label>
                    <div class="col-sm-4">
                      <input name="Unit" type="text" class="form-control" id="Unit" placeholder="Unit">
                    </div>
                    <label for="TaxCode" class="col-sm-2 control-label">TaxCode :</label>
                    <div class="col-sm-4">
                      <select name="TaxCode" class="form-control">
                        <option selected value="">Select a Tax Code</option>
                        @foreach ($TaxCodeList as $data)
                            <option value="{{ $data->TaxCodeID }}">{{ $data->TaxCode }} ({{ round($data->TaxPercent,2) }}%)</option>
                        @endforeach                      
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <input type="submit" name="SubmitProduct" value="Add New Product" class="btn   bg-navy" id="newproaj">

                      <input type="button" id="ResetBtn" class="btn bg-maroon"  value="Reset">
                    </div>
                  </div>                
                {{ Form::close() }}
              </div>
            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn   btn-danger" data-dismiss="modal">Cancel</button>
            </div> -->
          </div>
        </div>
      </div>  

      <!-- =============== Tax Selection Modal ====================== -->
      <div class="col-md-3 col-md-offset-1">
        <div class="modal" id="TaxModal" role="dialog">
          <div class="modal-dialog taxcodemodal">            
            <div class="modal-content">
              <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                <h1 class="modal-title text-center">
                  <p class="label label-primary">Apply Tax</p>
                </h1>
              </div>
              <div class="modal-body"> 
                <table id="taxcode" class="table table-striped DataTable">
                  <thead>
                    <tr>
                      <th> TaxCode </th>
                      <th> TaxPercent </th>
                      <th> Action     </th>                      
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($tax as $data)
                    <tr>
                      <td>
                        <input type="text" readonly name="taxselect[]" class="taxselect" value="{{$data->TaxCode}}" style="border:0px solid; background: transparent;">
                      </td>
                      <td>
                        <input type="text" readonly name="TaxValue[]" class="TaxValue" value="{{$data->TaxPercent}}" style="border:0px solid; background: transparent;">
                        <input type="hidden" name="taxnam[]" value="{{$data->TaxCode}}" class="taxnam">
                      </td>
                      <td>
                        <input type="button" name="TaxSelect[]" class="btn btn-danger btn-block TaxSelect " value="Select">
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn bg-olive   btn-lg" data-dismiss="modal" id="TaxReset">Reset</button>
                <button type="button" class="btn btn-danger   btn-lg" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- =============== Advance Modal ====================== -->
      <div class="modal" id="AdvanceModal" role="dialog">
        <div class="modal-dialog modalAdvance modal-fullscreen-dialog">                  
          <div class="modal-content modal-fullscreen-content">
            <div class="modal-header">
              <button type="button" class="btn bg-maroon" data-dismiss="modal"><i class="fa fa-arrow-left"></i> <strong>Back</strong></button>
              <h1 class="modal-title text-center">                
                <p class="label label-primary"><i class="fa fa-hand-lizard-o"></i> Advance</p>
              </h1>
            </div>
            <div class="modal-body">
              <div class="content">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                  {{ Form::open(array('id'=>'AdvanceAddForm')) }}
                    <div class="form-group">
                      <label class="label label-primary">Name :</label>
                      <input type="text" name="AdvanceCustomerName" id="AdvanceCustomerName" class="form-control" placeholder="Customer Name" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label class="label label-primary">Phone :</label>
                      <input type="text" name="AdvanceCustomerPhone" id="AdvanceCustomerPhone" class="form-control" placeholder="Customer Phone" autofocus autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label class="label label-primary">Master Name :</label>
                      <input type="text" name="AdvanceCustomerAddress" id="AdvanceCustomerAddress" class="form-control" placeholder="Master Name" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label class="label label-primary">Memeo Number :</label>
                      <input type="text" name="AdvanceNotes" id="AdvanceNotes" class="form-control" placeholder="Memo Number" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label class="label label-primary">Advance Payment :</label>
                      <input type="text" name="AdvanceAmount" id="AdvanceAmount" class="form-control" placeholder="Advance Payment" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label class="label label-primary">Delivary Date :</label>
                      <input type="date" name="AdvanceDelivaryDate" id="AdvanceDelivaryDate" class="form-control" placeholder="Delivary Date" autocomplete="off">
                    </div>
                    <button type="submit" class="btn bg-purple   btn-lg btn-lg btn-block"  id="AdvanceConfirm" value="Confirm Advance"><i class="fa fa-paper-plane"></i> <br> <strong>Confirm Advance</strong></button>
                  {{ Form::close() }}
                </div>
                <div class="col-md-6" id="AdvanceInvoiceArea">
                  <button class="pull-right btn btn-primary btn-lg" id="AdvanceInvoicePrint">Print</button>
                  <div id="AdvanceInvoice"></div> 
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn bg-maroon" data-dismiss="modal">Cancel</button>
            </div>
          </div> 
        </div>
      </div>

      <!-- =================== Order Start Modal ===================-->
      <div class="modal" id="OrderStart" role="dialog">
        <div class="modal-dialog modal-fullscreen-dialog">
          <div class="modal-content modal-fullscreen-content">            
            <div class="modal-header">
              <button type="button" class="btn bg-maroon" data-dismiss="modal"><i class="fa fa-arrow-left"></i> <strong>Back</strong></button>
              <div class="pull-right">
                <button type="button" class="btn bg-maroon" data-dismiss="modal"><strong>Next Order <i class="fa fa-arrow-right"></i></strong></button>
              </div>
            </div>
            <div class="modal-body">
              <div class="content">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                {!! Form::open(['url'=>'register','id'=>'OrderPlaceForm','class'=>'col-md-6 col-md-push-4 form-horizontal'])!!}

                  <div id="OrderSpecial">
                    
                  </div>  
                 
                    <div class="form-group">
                      <select name="StaffID" class="form-control" id="StaffID">
                        @foreach($alluser as $data)
                          <option value="{{$data->UserID}}">{{$data->FirstName}}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <input type="number" name="GuestNumber" id="GuestCount" class="form-control" placeholder="Guest Number">
                      <input type="hidden" id="CounterID" value="25">
                    </div>
                    <div class="form-group">
                      <input type="text" name="OrderNote" class="form-control" placeholder="Order Note" id="NotesforNewOrder">
                    </div>
                    <button type="submit" name="SendToKitchen" id="SendToKitchen" class="btn btn-primary">Send to Kitchen</button>

                    

                  {{ Form::close() }}

                </div>
                <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                  <button class="btn btn-block btn-lg btn-default" id="PrintKOT" disabled><i class="fa fa-print"></i> Print</button>
                  <div class="OrderPrint" id="PrintAnOrder"></div>
                </div>
                
                <script>
                  $(function(){
                    $('.OrderPrint').slimScroll({
                      size: '5px',
                      height: '480px',
                      width: '400px',
                      wheelStep: 50,
                      alwaysVisible: false
                    });
                  });
                </script>

              </div>
            </div>
            <!-- <div class="modal-footer">
              <button class="btn btn-danger" data-dismiss="modal">Cancel</button>                
            </div> -->
          </div>
        </div>
      </div>

      <!-- =================== Select Table modal ===================-->
      <div class="modal" id="SelectTableModal" role="dialog">
        <div class="modal-dialog modal-fullscreen-dialog">          
          <div class="modal-content modal-fullscreen-content">
            <div class="modal-header">
              <button type="button" class="btn bg-maroon" data-dismiss="modal"><i class="fa fa-arrow-left"></i> <strong>Back</strong></button>
              <button type="button" class="btn bg-yellow" id="TableReset"> <strong>Reset</strong></button>
            </div>
            <div class="modal-body">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#TableList" id="TableNav" data-toggle="tab"><i class="fa "></i> Tables</a></li>
                  <li><a href="#ParcelList" id="Parcel" data-toggle="tab"> <i class="fa "></i> Parcel</a></li>
                </ul>

                <div class="tab-content">
                  <div class="tab-pane active" id="TableList">
                    @foreach($Counters as $data)
                      @if($data->IsBooked==0)
                        <div class="col-md-1 col-sm-1 col-xs-2 col-lg-1">
                            <input type="hidden" name="CounterName[]" value="{{$data->Name}}"> 
                            <input type="hidden" name="CounterBookingChecking[]" value="{{$data->IsBooked}}">                      
                            <button class="btn btn-block btn-flat btn-lg CounterButton" name="CounterButton[]" value="{{$data->ID}}" >{{$data->Name}}</button>
                            <hr style="border: none;">
                        </div>
                      @endif
                      @if($data->IsBooked==1)
                        <div class="col-md-1 col-sm-1 col-xs-2 col-lg-1">
                            <input type="hidden" name="CounterName[]" value="{{$data->Name}}">
                            <input type="hidden" name="CounterBookingChecking[]" value="{{$data->IsBooked}}">   
                            <button class="btn btn-block btn-lg btn-flat bg-maroon CounterButton CounterUpdate" name="CounterButton[]" value="{{$data->ID}}" >{{$data->Name}}</button>
                            <hr style="border: none;">
                        </div>
                      @endif
                    @endforeach
                  </div> 

                  <div class="tab-pane" id="ParcelList"></div>                      
                </div>                    
              </div> 
            </div>
            <!-- <div class="modal-footer">
              <button class="btn btn-danger" data-dismiss="modal">Cancel</button>               
            </div> -->
          </div>
        </div>
      </div>
      
      <!-- =============== Order Update Modal ====================== -->
      <div class="modal" id="OrderUpdateModal" role="dialog">
        <div class="modal-dialog modaldiscount">
          <div class="col-md-12">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h1 class="modal-title text-center">
                  <p class="label label-warning"><i class="fa fa-check-circle fa-lg"></i> Update Order</p>
                </h1>
              </div>
              <div class="modal-body">
                <div class="content">
                  {{ Form::open(array('id'=>'OrderUpdateForm', 'class'=>'form-horizontal')) }}
                    <div class="form-group"> 
                      <input type="hidden" name="CounterFormforUpdate" id="CounterIDUpdate" value="0">
                      <input type="hidden" name="OrderFormforUpdating" id="OrderIDUpdate" value="0">
                      <div id="UpdateCounterID1"> </div>
                      <div id="UpdateCounterID2"> </div>
                    </div>
                    <div id="OrderDetailsforUpdate">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Time</th>
                            <th>Action</th>                  
                          </tr>
                        </thead>
                        <tbody id="OrderDetailsListBody"></tbody>
                      </table>
                    </div>
                    <div id="OrderUpdateBody">
                      <div class="form-group">
                        <div class="col-md-6">
                          <div class="input-group">
                            <span class="input-group-addon">Staff :</span>

                            <select id="UpdateStaffID" class="form-control">
                              @foreach($alluser as $data)
                                <option value="{{$data->UserID}}">{{$data->FirstName}}</option>
                              @endforeach
                            </select>
                          </div>                          
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-6">
                          <div class="input-group">
                            <span class="input-group-addon">Guests :</span>
                            <input type="number" step=".0001" class="form-control" name="UpdateGuestCount" id="UpdateGuestCount" step=".0001">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-6">
                          <div class="input-group">
                            <span class="input-group-addon">Note :</span>
                            <input type="text" class="form-control" name="Notes" id="UpdateNotes">
                          </div>
                        </div>
                      </div>                      
                      <button type="submit" class="btn bg-purple   btn-lg" id="OrderPlacing"><i class="fa fa-check-circle fa-lg"></i> <br><strong>Update Order</strong></button>
                    </div>
                  {{ Form::close() }}
                </div>                
              </div>
            </div>
          </div>          
        </div>
      </div>       

      <!-- =============== Sale Hold Modal ====================== -->
      <div class="modal" id="SaleHoldModal" role="dialog">
        <div class="modal-dialog modaldiscount">          
          <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-6 col-xs-offset-3 col-lg-6 col-lg-offset-3">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h1 class="modal-title text-center">
                  <p class="label label-primary"><i class="fa fa-hand-stop-o"></i> Sale Hold</p>
                </h1>
              </div>
              <div class="modal-body">
                {{ Form::open(array('id'=>'SaleHoldForm')) }}
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon ">Note :</span>
                      <input type="text" name="SaleHoldName" id="SaleHoldName" class="form-control" placeholder="Name" autofocus>
                    </div>
                  </div> 
                  <button type="submit" class="btn bg-purple   btn-lg btn-block" id="ConfirmHold" value="Confirm Hold"><i class="fa fa-paper-plane"></i> <br><strong>Confirm Hold</strong></button>
                {{ Form::close() }}
              </div>
            </div>
          </div>          
        </div>
      </div>        

      <!-- ===============OverAll Tax Selection Modal ====================== -->
      <div class="modal" id="TaxModalOverAll" role="dialog">
        <div class="modal-dialog taxcodemodal">          
          <div class="modal-content">
            <div class="modal-header">              
              <h1 class="modal-title text-center">
                <p class="label label-primary">VAT</p>
              </h1>
            </div>
            <div class="modal-body"> 
              <table id="taxcode" class="table table-bordered table-striped DataTable">
                <thead>
                  <tr>
                    <th> TaxCode    </th>
                    <th> TaxPercent </th>
                    <th> Action </th>                    
                  </tr>
                </thead>
                <tbody>
                  @foreach ($tax as $data)
                    <tr>
                      <td>
                        <input type="text" readonly name="taxselectoverall[]" class="taxselectoverall" value="{{$data->TaxCode}}" style="border:0px solid; background: transparent;">
                      </td>
                      <td>
                        <input type="text" readonly name="TaxValueOverAll[]" class="TaxValueOverAll" value="{{$data->TaxPercent}}" style="border:0px solid; background: transparent;">
                      </td> 
                      <td>
                        <input type="hidden" name="taxnamoverall[]" value="{{$data->TaxCode}}" class="taxnamoverall">
                        <input type="button" name="TaxSelectOverAll[]" class="btn bg-purple btn-block   btn-lg TaxSelectOverAll" value="Apply">
                      </td> 
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn bg-olive" id="OverallTaxReset">Reset</button>
              <button type="button" class="btn bg-maroon" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>  

      <!-- =============== Refund Modal ====================== -->
      <div class="modal" id="RefModal">
        <div class="modal-dialog  modal-fullscreen-dialog">
          <div class="modal-content modal-fullscreen-content">
            <div class="modal-header">
              <button type="button" class="btn bg-maroon" data-dismiss="modal"><i class="fa fa-arrow-left"></i> <strong>Back</strong></button>
              <h1 class="modal-title text-center">                
                <p class="label label-primary"><i class="fa fa-hand-o-left"></i> Refund Product</p>
              </h1>
            </div>
            <div class="modal-body">
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">                
                <div class="form-group CustomerPaymentforRefund">                
                    <label class="col-sm-1">Refund Method</label>
                    <div class="col-md-3">
                      <select class="form-control" id="RefundPaymentMethod">
                        <option value="0" selected>Cash Back</option>
                        <option value="1">Adjust With Due</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    {{ Form::open(array('id' => 'formrefund')) }}
                      <div class="input-group">
                        <span class="input-group-addon bg-purple"><strong>Invoice ID / Barcode :</strong></span>
                        <input type="text" id="RefundID" name="RefundCode" class="form-control" autofocus autocomplete="off" placeholder="Enter Invoice ID">

                        <input type="text" class="form-control" id="RefundBarcodeID" name="RefundBarcodedID" placeholder="Enter Barcode" autocomplete="off">

                        <span class="input-group-btn">
                          <button type="submit" name="refundproduct" id="refund-btn" class="btn   bg-purple"><i class="fa fa-cart-arrow-down fa-lg"></i> <br>Enter</button>
                        </span>
                      </div>                  
                    {{ Form::close() }}
                  </div> 
                  <table class="table table-bordered table-responsive table-condensed" id="RefInvID">
                    <tr class="text-center">
                    {{ Form::open(array('id'=>'RefundforInvoice', 'url'=>'/Sales/Refund/Invoice', 'target'=>'RefundWindow')) }}
                      <th class="text-center"> Select</th>
                      <th class="text-center"> ID</th>
                      <th class="text-center"> Name</th>
                      <th class="text-center"> Qty</th>
                      <th class="text-center"> Price</th>
                      <th class="text-center"> Back To</th>
                      <th class="text-center"> Refund Reason</th>
                    </tr>
                    <tbody id="ree"></tbody>
                  </table>

                  <div class="RefundInvoiceFooter">
                    <input type="button" class="btn btn-info btn-lg  " value="Refund" id="RefundInvoice">
                   <input type="button" class="btn btn-danger btn-lg  " value="Cancel" data-dismiss="modal">
                  {{ Form::close() }} 
                  </div>
                  <table class="table table-bordered table-responsive table-condensed" id="RefProID">
                    <tr class="text-center">
                    {{ Form::open(array('id'=>'RefundforProduct')) }}
                      <th class="text-center"> ID</th>
                      <th class="text-center"> Name</th>
                      <th class="text-center"> Qty</th>
                      <th class="text-center"> Price</th>
                      <th class="text-center"> Back To</th>
                      <th class="text-center"> Refund Reason</th>
                      <th class="text-center"> Action</th>
                    </tr>
                    <tbody id="RefProBody"> </tbody>
                  </table>
                  <div class="RefundProductIDFooter">
                    <input type="button" class="btn btn-success btn-lg" value="Refund" id="RefundProductByID">                
                    {{ Form::close() }}
                  </div>
              </div>
              <button class="btn btn-success btn-lg btn-flat pull-right" id="RefundPrint" disabled>Print</button>

              <div class="col-md-6" id="RefundInvoicePrint"></div>

            </div>
            <!-- <div class="modal-footer">
              <input type="button" class="btn btn-danger  " value="Cancel" data-dismiss="modal">
            </div> -->
          </div>          
        </div>
      </div>

      <!-- =================== Customer Due Payment from Refund  Modal ===================-->
      <div class="modal" id="CustomerBalancePayment" role="dialog">
        <div class="modal-dialog modalCustomerPayment">
          <div class="col-xs-6 col-md-6 col-sm-6 col-lg-6 col-xs-offset-3 col-md-offset-3 col-sm-offset-3 col-lg-offset-3">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-success">Customer Payment</p>
                </h1>
              </div>
              <div class="modal-body">
                {{ Form::open(array('id'=>'CustomerPaymentForm')) }} 
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon bg-olive"><strong>Customer Due :</strong></span>
                      <input type="text" class="form-control" id="CustomerBalanceForm" value="0">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon bg-olive"><strong>Refunded Amount :</strong></span>
                      <input type="text" class="form-control" id="CustomerRefundForm" value="0">
                    </div>
                  </div> 
                  <div class="input-group">
                    <input type="hidden" name="quanindex" id="quanindex">
                    <input type="number" step=".0001" class="form-control" value="0" min="0" id="CustomerPaymentRefund" autocomplete="off" autofocus>
                    <span class="input-group-btn">              
                      <input  class="btn bg-purple usersel  " id="customerpaymentsel" type="button" value="Adjust"><br>
                    </span>
                  </div>
                {{ Form::close() }}
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- =============== Single Discount Modal ====================== -->
      <div class="col-md-2 col-md-offset-1">
        <div class="modal" id="dismodal" role="dialog">
          <div class="modal-dialog modaldiscount">
            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-6 col-xs-offset-3 col-lg-6 col-lg-offset-3">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h1 class="modal-title text-center">
                    <p class="label label-primary">Single Discount</p>
                  </h1>
                </div>
                <div class="modal-body">
                  {{ Form::open(array('id'=>'DiscountForm')) }}
                    <div class="form-group">
                      <label class="label label-primary">Cash Discount :</label>
                      <input type="number" name="paid" id="cash_discount" class="form-control" placeholder="Enter Discount By Cash" step=".0001">
                    </div>
                    <div class="form-group">
                      <label class="label label-success">% Discount:</label>
                      <input type="number" name="returned" id="percent" class="form-control" placeholder="Enter Percentage of Discount" value="0" step=".0001" autofocus>
                      <input type="hidden" name="didi" value="0" id="idid">
                    </div>
                    <button type="submit" value="Apply Discount" class="btn bg-purple   btn-lg btn-block" id="DiscountSingle"> <strong>Apply Discount</strong></button>
                  {{ Form::close() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- =============== Overall Discount modal ====================== -->
      <div class="modal" id="DiscountModal" role="dialog">
        <div class="modal-dialog">
          <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-6 col-xs-offset-3 col-lg-6 col-lg-offset-3">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h1 class="modal-title text-center">
                  <p class="label label-primary">Overall Discount</p>
                </h1>
              </div>
              <div class="modal-body">
                {{ Form::open(array('id'=>'OverAllDiscountForm')) }}
                  <div class="form-group">
                    <label class="label label-primary">Cash Discount :</label>
                    <input type="number" name="dispaid" id="disca" class="form-control" placeholder="Enter Discount By Cash" value="0" autocomplete="off" step=".0001">
                  </div>
                  <div class="form-group">
                    <label class="label label-success">% Discount:</label>
                    <input type="number" name="returned" id="allpercent" class="form-control" placeholder="Enter Percentage of Discount" value="0" autocomplete="off" step=".0001" autofocus>
                    <input type="hidden" name="didi" value="0" id="idid">
                  </div>
                  <button type="submit" class="btn bg-purple   btn-lg btn-block" id="alldiscount"><strong>Apply Discount</strong></button>
                {{ Form::close() }}
              </div>
            </div>
          </div>
        </div>
      </div>  

      <!-- =============== Customer Selection Modal ====================== -->
      <div class="modal" id="CustomerModal" role="dialog">
        <div class="modal-dialog modal-fullscreen-dialog">
          
          <div class="modal-content modal-fullscreen-content">
            <div class="modal-header">
              <button type="button" class="btn bg-maroon" data-dismiss="modal"><i class="fa fa-arrow-left"></i> <strong>Back</strong></button>

              <button type="button" class="btn btn-danger" id="CustomerReset" data-dismiss="modal">Reset</button>
              <h1 class="modal-title text-center">
                <p class="label label-primary"><i class="fa fa-user"></i> Select Customer</p>
              </h1>
            </div>
            <div class="modal-body">
              <div class="content">
                <div class="row">
                  <button class="btn btn-primary   pull-right btn-lg" type="button" id="NewCusModal"><i class="fa fa-user-plus" ></i> New Customer</button>
                </div>
                <div class="row">
                  <table id="example2" class="table table-striped table-condensed DataTable">
                    <thead>
                      <tr>
                        <th> Name </th>
                        <th> Phone </th>
                        <th> Action </th>
                      </tr>
                    </thead>
                    <tbody id="bodyforcustomer">
                      @foreach ($cus as $data)
                        <tr>
                          <td> {{$data->FirstName}} {{$data->LastName}} </td>
                          <td>{{$data->Phone}}</td>
                          <td>
                            <input type="hidden" name="cusnam[]" value="{{$data->CustomerID}}" class="cusnam">
                            <button class="btn btn-primary cusselect" name="cusselect[]" type="button" value="{{$data->FirstName}} {{$data->LastName}}">Select</button>
                            <button class="btn btn-info cusdetail " name="cusdetail[]" type="button">Details</button>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>                
            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-primary   " id="CustomerReset" data-dismiss="modal">Reset</button>
              <button type="button" class="btn btn-danger  " data-dismiss="modal">Cancel</button>
            </div> -->
          </div>
        </div>
      </div>

      <!---=============== New Customer Modal ================-->
      <div class="modal" id="NewCustomer" role="dialog">        
        <div class="modal-dialog">          
          <div class="col-md-10 col-md-offset-1">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-primary">Add New Customer</p>
                </h1>
              </div>
              <div class="modal-body">
                {{ Form::open(array('id'=>'newcustomerform', 'class'=>'form-horizonta', 'url'=>'/Customer/New')) }}                  
                    <div class="row">
                      <div class="col-xs-12">
                        <input type="text" name="Phone"  id="Phone" class="form-control" placeholder="Phone" required >
                        <span id="PhoneCheck"></span>                        
                      </div>
                    </div>                     
                    <div class="row">
                      <div class="col-xs-6">
                      <input type="hidden" name="ShopID" value="{{session()->get('ShopID')}}" id="ShopID">
                        <input type="text" name="FirstName" id="FirstName" class="form-control" placeholder="FirstName" autocomplete="off" required>
                        <span id="NameCheck"></span>
                      </div> 
                       <div class="col-xs-6">
                        <input type="text" name="LastName" id="LastName" class="form-control" placeholder="LastName" autocomplete="off">
                      </div>
                    </div>
                    <div class="row">
                       <div class="col-xs-6">
                        <input type="text" name="Address" id="Address" class="form-control" placeholder="Address" autocomplete="off">
                      </div>
                      <div class="col-xs-6">
                        <input type="text" name="City" id="City" class="form-control" placeholder="City" autocomplete="off">
                      </div>
                    </div>
                     <div class="row">
                       <div class="col-xs-6">
                        <input type="text" name="Province" id="Province" class="form-control" placeholder="Province" autocomplete="off">
                      </div>

                      <div class="col-xs-6">
                        <input type="text" name="ZipCode" id="ZipCode" class="form-control" placeholder="ZipCode" autocomplete="off">
                      </div>
                    </div>
                    <div class="row">
                       <div class="col-xs-6">
                        <input type="text" name="Country" id="Country" class="form-control" placeholder="Country" autocomplete="off">
                      </div>
                      <div class="col-xs-6">
                        <input type="date" name="DateOfBirth" id="DateOfBirth" class="form-control" placeholder="DateOfBirth" autocomplete="off">
                      </div>
                    </div>
                    <div class="row">
                       <div class="col-xs-6">
                        <input type="text" name="Email" id="Email" class="form-control" placeholder="Email" autocomplete="off">
                      </div>
                      <div class="col-xs-6">
                        <input type="text" name="Notes" id="Notes" class="form-control" placeholder="Notes" autocomplete="off">
                      </div>
                    </div>
                     <div class="row">
                       <div class="col-xs-6">
                        <input type="file" name="CustomerImg" id="CustomerImg" class="form-control" placeholder="CustomerImg">
                      </div>
                      <div class="col-xs-6">
                        <img id="CustomerImgPlace" src="" alt="your image" width="100" height="100" />
                        <script>
                          function readURL(input) {
                            if (input.files && input.files[0]) {
                              var reader = new FileReader();
                              reader.onload = function (e) {
                                $('#CustomerImgPlace').attr('src', e.target.result);
                              }
                              reader.readAsDataURL(input.files[0]);
                            }
                          }
                          $("#CustomerImg").change(function(){
                            readURL(this);
                          });
                        </script> 
                      </div>
                    </div>       
                </div>
                <div class="modal-footer">
                 <input type="button" class="btn btn-success    btn-lg " id="AddCus" value="Add New Customer">
                  {{ Form::close() }}
                  <button type="button" class="btn btn-danger   btn-lg" data-dismiss="modal">Cancel</button>
                </div> 
            </div>            
          </div>
        </div>        
      </div> 

      <!-- =============== Customer Details Modal ====================== -->
      <div class="col-md-2 col-md-offset-1">
        <div class="modal" id="CustomerDetailsModal" role="dialog">
          <div class="modal-dialog">            
            <div class="modal-content">
              <div class="modal-header" id="heading">
                <h1 class="modal-title text-center"><p class="label label-primary">Customer Details</p>
              </div>
              <div class="modal-body">
                <div class="box box-info">
                  <div class="box-header with-border">
                      <h3 class="box-title" id="CustomerName"></h3>
                  </div>
                  <div class="box-body">
                      <table class="table table-bordered table-striped" id="modalcustomerdetail">
                      </table>  
                  </div>
                </div>              
              </div>
              <div class="modal-footer" >              
                <button class="btn btn-primary   btn-lg" id="SelectFromCustomerDetailsModal" type="button">Select</button>
                <button class="btn btn-danger   btn-lg" type="button" data-dismiss="modal"">Cancel</button>
              </div>
            </div>            
          </div>
        </div>
      </div> 
    </section>    
  </div> 

  <!-- =================== AppName() Info Modal ===================-->
  <div class="col-md-6 col-md-offset-1">
    <div class="modal" id="{{ AuthorName() }}InfoModal" role="dialog">
      <div class="modal-dialog">            
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>                
            <h1 class="modal-title text-center">
              <span class="logo-lg">{{ AuthorName() }}</span>
            </h1>
          </div>
          <div class="modal-body">  
            <p>
              For any Emergency please feel free to contact -
              <strong> {{ AuthorPhone() }}</strong> or <strong>{{ AuthorEmail() }}</strong>
            </p>      
          </div>
        </div>
      </div>
    </div>
  </div> 

  <!-- =================== Order List Modal ===================-->
  <div class="modal" id="OrderPlaceListModal" role="dialog">
    <div class="modal-dialog modal-fullscreen-dialog">          
      <div class="modal-content modal-fullscreen-content">
        <div class="modal-header">
          <button type="button" class="btn bg-maroon" data-dismiss="modal"><i class="fa fa-arrow-left"></i> <strong>Back</strong></button>
          <h1 class="modal-title text-center">                
            <p class="label label-primary"><i class="fa fa-hand-stop-o"></i> Order List</p>
          </h1>
        </div>
        <div class="modal-body">     
          <div class="content">
            <div class="row">
              {{ Form::open(array('class' => 'form-inline')) }}
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><strong>From :</strong></span>
                    <input type="date" class="form-control" id="OrderFromDate">                  
                  </div> 
                </div> 
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><strong>To :</strong></span>
                    <input type="date" class="form-control" id="OrderToDate">
                  </div>
                </div>                   
              {{ Form:: close() }} 
            </div>
            <div class="row">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                  <li><a href="#CompletedOrders" data-toggle="tab"><i class="fa fa-check-circle fa-lg"></i> Completed</a></li>
                  <li class="active"><a href="#PendingOrders" data-toggle="tab"> <i class="fa fa-spinner fa-spin fa-lg"></i> Pending</a></li>
                  <li class="pull-left header"><i class="fa fa-th"></i> Orders</li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="PendingOrders">
                    <table class="table table-striped table-hover table-responsive DataTable" id="PendingOrdersList">
                      <thead>
                        <tr>                 
                          <th>Counter</th>
                          <th>OrderID</th>
                          <th>Staff</th>
                          <th>Guest</th>
                          <th>Time</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="OrderListBody"></tbody>                 
                    </table>
                  </div>                      
                  <div class="tab-pane" id="CompletedOrders">
                    <table class="table table-striped table-hover table-responsive DataTable" id="CompletedOrdersList">
                      <thead>
                        <tr>                 
                          <th>Table</th>
                          <th>OrderID</th>
                          <th>Waiter</th>
                          <th>Guest</th>
                          <th>Invoice</th>
                          <th>Payment</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="OrderListBody"></tbody>                 
                    </table>
                  </div>                      
                </div>                    
              </div>                   
            </div>
          </div>              
        </div>
        <!-- <div class="modal-footer">
          <button  class="btn btn-danger  " type="button " data-dismiss="modal">Cancel</button>
        </div> -->
      </div>
    </div>
  </div> 

  <!-- =================== Order Details Modal ===================-->
  <div class="modal" id="OrderDetailsModal" role="dialog">
    <div class="modal-dialog">          
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title text-center">
            <p class="label label-success">Order Details</p>
          </h1>
        </div>            
        <div class="modal-body">     
          <div class="content">
            <div class="row"></div>
            <div class="row">
              <table class="table table-hover" id="OrderDetails">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Item/Description</th>
                    <th>Price</th>                        
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody id="AddOrderList"></tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer" "> 
          <button  class="btn btn-danger   " type="button " data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <!-- =================== Hold List Modal ===================-->
  <div class="modal" id="SaleHoldListModal" role="dialog">
    <div class="modal-dialog modal-fullscreen-dialog">          
      <div class="modal-content modal-fullscreen-content">
        <div class="modal-header">
          <button type="button" class="btn bg-maroon" data-dismiss="modal"><i class="fa fa-arrow-left"></i> <strong>Back</strong></button>
          <h1 class="modal-title text-center">
            <p class="label label-primary"><i class="fa fa-hand-stop-o"></i> Hold List</p>
          </h1>
        </div>
        <div class="modal-body">     
          <div class="content">
            <div class="row">
                {{ Form::open(array('class' => 'form-inline')) }}
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><strong>From :</strong></span>
                      <input type="date" class="form-control" id="HoldFromDate">                  
                    </div> 
                  </div>  

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><strong>To :</strong></span>
                      <input type="date" class="form-control" id="HoldToDate">
                    </div>
                  </div>                   
                {{ Form:: close() }} 
            </div>
            <div class="row">
              <table class="table table-striped table-hover table-responsive DataTable" id="HoldTable">
                <thead>
                  <tr>                 
                    <th>Name</th>
                    <th>Products</th>                     
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="SaleHoldList"></tbody>                 
              </table>
            </div>
          </div>              
        </div>
        <!-- <div class="modal-footer">
          <button  class="btn btn-danger  " type="button " data-dismiss="modal">Cancel</button>
        </div> -->
      </div>
    </div>
  </div>

  <!-- =================== Hold Details Modal ===================-->
  <div class="modal" id="PreviousHoldDetailsModal" role="dialog">
    <div class="modal-dialog">          
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title text-center">
            <p class="label label-success">Hold Details</p>
          </h1>
        </div>
        <div class="modal-body">     
          <div class="content">
            <div class="row"></div>
            <div class="row">
              <table class="table table-hover" id="PreviousSaleListTable">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Item/Description</th>
                    <th>Amount</th>                        
                  </tr>
                </thead>
                <tbody id="AddHoldList"></tbody>                 
              </table>
              <div id="HoldSummary"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer" "> 
          <button  class="btn btn-danger   " type="button " data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <!-- =================== New Expense Modal ===================-->
  <div class="modal" id="NewExpense" role="dialog">
    <div class="modal-dialog">          
      <div class="col-xs-12 col-md-6 col-sm-6 col-lg-6 col-md-offset-3 col-sm-offset-3 col-lg-offset-3">
        <div class="modal-content">
          <div class="modal-header">
            <button  class="btn bg-maroon" type="button " data-dismiss="modal"><i class="fa fa-arrow-left"></i> Back</button>
            <!-- <h1 class="modal-title text-center">
              <p class="label label-primary"><i class="fa fa-pencil"></i> New Expense</p>
            </h1> -->
          </div>
          <div class="modal-body">
            <h1 class="modal-title text-center">
              <p class="label label-primary"><i class="fa fa-pencil"></i> New Expense</p>
            </h1><br>
            {{ Form::open() }}
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><strong>Category</strong></span>
                  <select id="ExpenseCategory" class="form-control" >                        
                    @foreach($ExpenseCategoryList as $data)
                      <option value="{{$data->CategoryID}}">{{$data->CategoryName}}</option> 
                    @endforeach 
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><strong>Staff</strong></span>
                  <select class="form-control" id="ExpenseUser" >                        
                    @foreach($alluser as $data)
                      <option value="{{$data->UserID}}">{{$data->FirstName}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><strong>Amount</strong></span>
                  <input type="number" step=".0001" class="form-control" id="ExpenseValue" autocomplete="off"   placeholder=" Amount" autofocus>
                  <span class="input-group-addon">{{ CurrencySymbol() }}</span>
                </div>                        
              </div>   
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><strong>Note</strong></span>
                  <input type="text"  id="ExpenseNotes" class="form-control" placeholder="Notes" >
                </div>
              </div> 
              <button  class="btn bg-olive usersel   btn-lg btn-block" id="ExpenseSubmit" type="button"><i class="fa fa-paper-plane"></i> <br> Add Expense </button>
            {{ Form::close() }}
          </div>
          <!-- <div class="modal-footer">                 
            <button  class="btn btn-danger  " type="button " data-dismiss="modal">Cancel</button>
          </div> -->
        </div>
      </div>
    </div>
  </div>

  <!-- =================== Day Summary Modal ===================-->
  <div class="modal" id="DailyReportModal" role="dialog">
    <div class="modal-dialog modalquantity">          
      <div class="col-xs-10 col-md-6 col-sm-6 col-lg-6 col-xs-offset-1 col-md-offset-3 col-sm-offset-3 col-lg-offset-3">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title text-center">
              <p class="label label-primary">Daily Report</p>
            </h1>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <input type="date" class="form-control" name="DailyReportDate" id="DailyReportDate">
            </div>
            <button class="btn bg-olive btn-lg btn-block" id="DaySummary">Day Summary</button>
            <button class="btn bg-olive btn-lg btn-block" id="DayInvoices">Day Invoices</button>
            <button class="btn bg-olive btn-lg btn-block" id="DaySales">Day Sales</button>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" data-dismiss="modal">Cancel</button>                
          </div>
        </div>
      </div>
    </div>
  </div>


   <!-- =================== Print Invoice Modal ===================-->
  <div class="modal" id="PrintInvoiceModal" role="dialog">
    <div class="modal-dialog modalquantity">          
      <div class="col-xs-6 col-md-6 col-sm-6 col-lg-6 col-xs-offset-3 col-md-offset-3 col-sm-offset-3 col-lg-offset-3">
        <div class="modal-content">
          <div class="modal-header">
            <button id="PrintInvoiceRecipt" class="btn btn-default btn-block btn-lg"><i class="fa fa-print fa-lg"></i> Print</button>
          </div>
          <div class="modal-body">          
            <div id="SalesPanelInvoiceRecipt"></div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" data-dismiss="modal">Cancel</button>                
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- =================== Print kot Modal ===================-->
  <div class="modal" id="PrintKOTModal" role="dialog">
    <div class="modal-dialog modalquantity">          
      <div class="col-xs-6 col-md-6 col-sm-6 col-lg-6 col-xs-offset-3 col-md-offset-3 col-sm-offset-3 col-lg-offset-3">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title text-center">
              <p class="label label-primary">PrintKOT</p>

            </h1>
            <i class="fa fa-times pull-left" data-dismiss="modal"></i>
          </div>
          <div class="modal-body">
          <button id="PrintKOTRecipt" class="btn btn-success pull-right">Print</button>
            <div id="SalesPanelKOTRecipt"></div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" data-dismiss="modal">Cancel</button>                
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- =================== Invoice List Modal ===================-->
  <div class="modal" id="PreviousInvoiceModal" role="dialog">
    <div class="modal-dialog modal-fullscreen-dialog">          
      <div class="modal-content modal-fullscreen-content">
        <div class="modal-header">
          <button type="button" class="btn bg-maroon" data-dismiss="modal"><i class="fa fa-arrow-left"></i> <strong>Back</strong></button>
          <h1 class="modal-title text-center">
            <p class="label label-primary"><i class="fa fa-th-list"></i> Invoice List</p>
          </h1>
        </div>
        <div class="modal-body">     
          <div class="content">
            <div class="row">
              {{ Form::open(array('class' => 'form-inline')) }}
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><strong>From :</strong></span>
                    <input type="date" class="form-control" id="FromDate">
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><strong>To :</strong></span>
                    <input type="date" class="form-control" id="ToDate">
                  </div>
                </div>                    
              {{ Form:: close() }} 
            </div>
            <div class="row">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                  <li><a href="#PaidInvoices" data-toggle="tab"><i class="fa fa-check-circle fa-lg"></i> Paid</a></li>
                  <li class="active"><a href="#UnPaidInvoices" data-toggle="tab"> <i class="fa fa-spinner fa-spin fa-lg"></i> Unpaid</a></li>
                  <li class="pull-left header"><i class="fa fa-th-list"></i> Invoices</li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="UnPaidInvoices">
                    <table class="table table-responsive table-striped table-hover table-bordered DataTable" id="InvoiceListTableforUnpaid">
                      <thead>
                        <tr>                 
                          <th>InvoiceID</th>
                          <th>OrderID</th>
                          <th>Date</th>
                          <th>Total</th>                                                    
                          <th>Action</th>
                        </tr>
                      </thead>                                     
                    </table>                        
                  </div>
                  <div class="tab-pane" id="PaidInvoices">
                    <table class="table table-responsive table-striped table-hover table-bordered DataTable" id="InvoiceListTable">
                      <thead>
                        <tr>                 
                          <th>InvoiceID</th>
                          <th>Date</th>                                         
                          <th>Total</th>                    
                          <th>Paid</th>                    
                          <th>Change</th>                    
                          <th>Action</th>
                        </tr>
                      </thead>                                     
                    </table>
                  </div>
                </div>
                
              </div>                   
            </div>
          </div>              
        </div>
        <!-- <div class="modal-footer">
          <button  class="btn btn-danger  " type="button " data-dismiss="modal">Cancel</button>
        </div> -->
      </div>
    </div>
  </div>

  <!-- =================== Invoice Details Modal ===================-->
  <div class="modal" id="PreviousSaleDetailsModal" role="dialog">
    <div class="modal-dialog">          
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title text-center">
            <p class="label label-success">Invoice Details</p>
          </h1>
        </div>
        <div class="modal-body">     
          <div class="content">
            <div class="row"> </div>
            <div class="row">
              <table class="table table-hover" id="OrderDetails">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Item/Description</th>
                    <th>Price</th>                        
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody id="AddSaleList"> </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer" "> 
          <button  class="btn btn-danger   " type="button " data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <!-- ===================  Calculator Modal ===================-->
  <div class="modal" id="CalculatorModal" role="dialog">
    <div class="modal-dialog" id="fahad">          
      <div class="col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title text-center">
              <p class="label label-primary"><i class="fa fa-calculator"></i> Calculator</p>
            </h1>
          </div>
          <div class="modal-body">                
            <div id="result"></div>
            <div id="main">
              <div id="first-rows">
                <button class="btn btn-primary   del-bg" id="delete">CLEAR</button>
                <button value="%" class="btn btn-primary   btn-style operator opera-bg fall-back">%</button>
                <button value="+" class=" btn btn-primary   btn-style opera-bg value align operator">+</button>
              </div>
              <div class="rows">
                <button value="7" class="btn btn-primary   btn-style num-bg num first-child">7</button>
                <button value="8" class="btn btn-primary   btn-style num-bg num">8</button>
                <button value="9" class="btn btn-primary   btn-style num-bg num">9</button>
                <button value="-" class="btn btn-primary   btn-style opera-bg operator">-</button>
              </div>
              <div class="rows">
                <button value="4" class="btn btn-primary   btn-style num-bg num first-child">4</button>
                <button value="5" class="btn btn-primary   btn-style num-bg num">5</button>
                <button value="6" class="btn btn-primary   btn-style num-bg num">6</button>
                <button value="*" class="btn btn-primary   btn-style opera-bg operator">x</button>
              </div>
              <div class="rows">
                <button value="1" class="btn btn-primary   btn-style num-bg num first-child">1</button>
                <button value="2" class="btn btn-primary   btn-style num-bg num">2</button>
                <button value="3" class="btn btn-primary   btn-style num-bg num">3</button>
                <button value="/" class="btn btn-primary   btn-style opera-bg operator">/</button>
              </div>
              <div class="rows">
                <button value="0" class="btn btn-primary   num-bg zero" id="delete">0</button>
                <button value="." class="btn btn-primary   btn-style num-bg period fall-back">.</button>
                <button value="=" id="eqn-bg" class="btn btn-primary   eqn align">=</button>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger  " data-dismiss="modal" >Cancel</button> 
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- =================== Refund List Modal ===================-->
  <div class="modal" id="PreviousRefundModal" role="dialog">
    <div class="modal-dialog modal-fullscreen-dialog">          
      <div class="modal-content modal-fullscreen-content">
        <div class="modal-header">
          <button type="button" class="btn bg-maroon" data-dismiss="modal"><i class="fa fa-arrow-left"></i> <strong>Back</strong></button>
          <h1 class="modal-title text-center">
            <p class="label label-primary"><i class="fa fa-th-list"></i> Refund List</p>
          </h1>
        </div>
        <div class="modal-body">     
          <div class="content">
            <div class="row">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right"> 
                  <li ><a href="#RefundedInvoiceList" data-toggle="tab"> <i class="fa fa-th-list fa-lg"></i> Invoices</a></li>
                  <li class="active"><a href="#RefundedProductList" data-toggle="tab"><i class="fa fa-check-circle fa-lg"></i> Products</a></li>
                  <li class="pull-left header"><i class="fa fa-th"></i> Refunds</li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="RefundedProductList">
                    <table class="table table-striped table-responsive DataTable">
                      <thead>
                        <tr>                 
                          <th>ProductID</th>
                          <th>InvoiceID</th>                                         
                          <th>SaleDate</th>                                         
                          <th>RefundDate</th>   
                          <th>Qty</th>                 
                          <th>Amount</th> 
                        </tr>
                      </thead>
                      <tbody id="AddRefundInvoice"> 
                      </tbody>                 
                    </table>
                  </div>                      
                  <div class="tab-pane" id="RefundedInvoiceList"></div>                                            
                </div>                    
              </div> 
            </div>
          </div>              
        </div>
      </div>
    </div>
  </div>

  <!-- =================== Advance List  Modal ===================-->
  <div class="modal" id="PreviousAdvanceModal" role="dialog">
    <div class="modal-dialog  modal-fullscreen-dialog">          
      <div class="modal-content modal-fullscreen-content">
        <div class="modal-header">
          <button type="button" class="btn bg-maroon" data-dismiss="modal"><i class="fa fa-arrow-left"></i> <strong>Back</strong></button>
          <h1 class="modal-title text-center">
            <p class="label label-primary"> <i class="fa fa-hand-lizard-o"></i> Advance List</p>
          </h1>
        </div>
        <div class="modal-body">
          <div class="content">
            <div class="row">
              <div class="container">
                {{ Form::open(array('class' =>'form-inline')) }}
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><strong>From :</strong></span>
                      <input type="date" name="datefromadvance" id="datefromadvance" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><strong>To :</strong></span>
                      <input type="date" name="datetoadvance" id="datetoadvance" class="form-control">
                    </div>
                  </div>
                {{ Form::close() }}
              </div>
            </div>
            <div class="row">
              <table class="table table-responsive table-stripped table-hover DataTable" id="AdvanceTable">
                <thead>
                  <tr>                 
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Advance</th> 
                    <th>Due</th> 
                    <th>Total</th> 
                    <th>A.Date</th>
                    <th>D.Date</th>                    
                    <th>Memo#</th>                    
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="AddAdvance"> </tbody>                 
              </table>
            </div>
          </div>              
        </div>
        <!-- <div class="modal-footer">
          <button  class="btn btn-danger  " type="button " data-dismiss="modal">Cancel</button>
        </div> -->
      </div>
    </div>
  </div>

  <!-- =================== Advance Details Modal ===================-->
  <div class="modal" id="PreviousAdvanceDetailsModal" role="dialog">
    <div class="modal-dialog modal-fullscreen-dialog">          
      <div class="modal-content modal-fullscreen-content">
        <div class="modal-header">
          <h1 class="modal-title text-center">
            <p class="label label-success">Advance Details</p>
          </h1>
        </div>
        <div class="modal-body">     
          <div class="content">
            <div class="row"> </div>
            <div class="row">
              <table class="table table-hover" id="PreviousSaleListTable">
                <thead>
                  <tr>
                  <th>#</th>
                  <th>Item/Description</th>
                  <th>Amount</th>                        
                  </tr>
                </thead>
                <tbody id="AddAdvanceList"></tbody>                 
              </table>
              <div id="AdvanceSummary"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer" "> 
          <button  class="btn btn-danger  " type="button " data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div> 
@endsection