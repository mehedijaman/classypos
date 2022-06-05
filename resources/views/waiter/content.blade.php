<?php
  $ShopID       = session()->get('ShopID');
  $ProductID    = session()->get('ProductID');
  $ProductName  = session()->get('ProductName');
  $Qty          = session()->get('Qty');
  $Price        = session()->get('Price');
  $TotalPrice   = session()->get('TotalPrice');
  $Discount     = session()->get('Discount');
?>
@extends('layouts.sales')
@section('content')
  <!--===================== Sidebar ===================-->
  <aside class="main-sidebar" >
    <section class="sidebar">
      <!--==================== Sidebar Menu ====================-->
      <ul class="sidebar-menu">
        @if(Cookie::get('IsOrder')==1)
        <li>
          <a href="#"  id="OrderList" ><i class="fa fa-th"></i> <span>Order List</span></a>
        </li>
        @endif
        <li>
          <a href="#" class="" id="InvoiceList"><i class="fa fa-th-list"></i> <span>Invoice List</span></a>
        </li> 
        @if(Cookie::get('IsHold')==1)
        <li>
          <a href="#" id="HoldList" ><i class="fa fa-hand-stop-o"></i> <span>Hold List</span></a>
        </li>
        @endif
        @if(Cookie::get('IsAdvance')==1)
        <li>
          <a href="#" class="" id="AdvanceList"><i class="fa fa-hand-lizard-o"></i> <span>Advance List</span></a>
        </li>
        @endif 
        <li>
          <a href="#" class="" id="RefundList"><i class="fa fa-hand-o-left
          "></i> <span>Refund List</span></a>
        </li> 
        <li>
          <a href="#" class="" data-toggle="modal" data-target="#NewExpense" id="AddExpense"><i class="fa fa-pencil fa-lg"></i> <span>Add Expense</span></a>
        </li>
        <li>
          <a href="#" class="" id="TodaySummary"><i class="fa fa-print fa-lg"></i> <span>Day Summary</span></a>
        </li>
        <li>
          <a href="#" class="" data-toggle="modal" data-target="#CalculatorModal"><i class="fa fa-calculator fa-lg"></i> <span>Calculator</span></a>
        </li> 
        <li>
          <a href="#" class="bg-purple" data-toggle="modal" data-target="#{{ AuthorName() }}InfoModal" ><i class="fa fa-copyright"></i><span class="TechLab"> {{ AuthorName() }} </span></a>
        </li>
      </ul>
      <!--==================== /Sidebar-menu ====================-->
    </section>    
  </aside>

  <!--===================== Wrapper ===================-->
  <div class="content-wrapper">
    <!--===================== On Screen Buttons ===================-->
    <section class="content-header">
      <table class="table table-reponsive table-condensed">
        <tr>
          @if($ShopID > 0) 
            @foreach($btn as $data)
            <td>
              <input type="hidden" name="hibuid[]" value="{{$data->ProductID}}">
              <button name="topitem[]" type="button" class="btn btn-lg bg-navy topitem btn-block">{{ $data->DisplayText }}</button>
            </td>
            @endforeach 
          @endif
        </tr>
      </table>      
    </section>

    <input type="hidden" value=<?php $sid=session()->get('ShopID'); echo $sid;?> id="IDofTheShop" name="shopid" class="form-control">
     <input type="hidden" value="{{$user->FirstName}}" id="shop_user_name"   name="username"  class="form-control" >   

    <div id="HiddenArea">
      <input type="hidden" value="{{ $product->toJson() }}" id="LookupProducts">
      <input type="hidden" value="{{$Draweropening}}" id="DrawerTest">
      <input type="hidden" value="{{Cookie::get('IsRestaurant')}}">
      <input type="hidden" value="{{Cookie::get('IsServiceCharge')}}">
      <input type="hidden" value="{{Cookie::get('IsTips')}}">
      <input type="hidden" value="{{Cookie::get('IsTax')}}" id="TaxCookieCheck">
      <input type="hidden" value="{{Cookie::get('IsOrder')}}">
      <input type="hidden" value="{{Cookie::get('IsHold')}}">
      <input type="hidden" value="{{Cookie::get('IsAdvance')}}">
      <input type="hidden" value="{{Cookie::get('IsBarcode')}}">
      <input type="hidden" value="{{Cookie::get('InvoiceFormat')}}">
      <input type="hidden" value="{{Cookie::get('name')}}">

      <input type="hidden" value="0" id="Customerid">
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
      <input type="hidden" value="0" id="OrderIDforInvoice">
      <input type="hidden" value="0" id="InvoiceIDforTender">      
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

      <input type="hidden" value="{{$admin}}" id="admin" name="admin" >
      <input type="hidden" value="0" id="TaxID">        
      <input type="hidden" value=<?php $id=session()->get('CustomerID'); echo $id;?> id="customerid" name="customer"  >
    </div>

    <!--====================== Main content =========================-->
    <section class="content">      
      <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6 inner-content">
        <div class="row">
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
              <a class="btn bg-blue" data-toggle="modal" data-target="#SelectTableModal">Table</a>
            @endif

            @if(Cookie::get('IsHold')==1)
              <a class="btn bg-blue  disabled" id="SaleHold">Hold</a>
            @endif
            
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <!--==================== Search From ====================-->
            {{ Form::open(array('id' => 'SidebarForm')) }}              
              @if(Cookie::get('IsBarcode') == 1)
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-search"></i></span>
                  <input type="text" id="saqlain" name="barcodeInput" class="form-control" autofocus autocomplete="off" placeholder="Search/Scan here">
                  <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn bg-maroon"><i class="fa fa-plus"></i>
                    </button>
                  </span>
                </div>
              @endif 
            {{ Form::close() }}           
          </div>
        </div>  

        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <hr style="margin: 2px 0px 2px 0px;">
          </div>
        </div>
        
        <!-- =============== Product Cart ====================== -->
        <div class="row" id="CartContent">          
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">             
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bg-blue">
              <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                <strong>Item / Description</strong>
              </div>

              <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                <strong>VAT</strong>
              </div>

              <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                <strong>Discount</strong>
              </div>

              <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                <strong>SaleBy</strong>
              </div>

              <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                <strong><i class="fa fa-times"></i></strong>
              </div>
            </div>
            <div id="add"> </div>

            <script>
              $(function(){
                $('#CartContent').slimScroll({
                  size: '1px',
                  height: '300px',
                  wheelStep: 80,
                  alwaysVisible: false
                });
              });
            </script>
          </div>
        </div> 
        <hr>

        <div class="row" style="background-color: #F0F4F4;">
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><strong>Total Item :</strong></div>
          <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><strong><span id="InvoiceTotalItem">0</span></strong></div>

          <div class="col-sm-4 col-xs-4 col-lg-4 col-md-4"><strong>Sub Total :</strong></div>
          <div class="col-sm-2 col-xs-2 col-lg-2 col-md-2"><strong><span id="SubTotal">0</span></strong></div>            
        </div>

        <div class="row" style="background-color: #F0F4F4;">
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><strong>Total Qty :</strong></div>
          <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><strong><span id="InvoiceTotalQty">0</span></strong></div>

          <div class="col-sm-4 col-xs-4 col-lg-4 col-md-4"><strong>Tax :</strong></div>
          <div class="col-sm-2 col-xs-2 col-lg-2 col-md-2"><strong><span id="VatTotal">0</span></strong></div>
        </div>

        <div class="row" style="background-color: #F0F4F4;">
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><strong>Order ID :</strong></div>
          <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><strong><span id="">0</span></strong></div>

          <div class="col-sm-4 col-xs-4 col-lg-4 col-md-4"><strong>Discount :</strong></div>
          <div class="col-sm-2 col-xs-2 col-lg-2 col-md-2"><strong><span id="DiscountTotal">0</span></strong></div>
        </div>

        <div class="row" style="background-color: #F0F4F4;">
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><strong>Invoice ID :</strong></div>
          <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><strong><span id="">0</span></strong></div>

          <div class="col-sm-4 col-xs-4 col-lg-4 col-md-4"><strong>Net Total :</strong></div>
          <div class="col-sm-2 col-xs-2 col-lg-2 col-md-2"><strong><span id="Total">0</span></strong></div>
        </div>
        <hr>

        <div class="row">
          <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
              @if(Cookie::get('IsDiscount')==1)
                <a class="btn bg-blue disabled btn-block" id="DiscountOverAll" >Discount</a>
              @endif
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
              @if(Cookie::get('IsTax')==1)
                <a class="btn bg-blue disabled btn-block"  id="TaxOverall" >VAT</a>
              @endif
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
              @if(Cookie::get('IsOrder')==1)
                <a class="btn bg-blue btn-block" id="OrderPlace">KOT</a>
              @endif
            </div>

            <hr>

            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
              <a class="btn bg-red disabled btn-block" id="Cancel">Cancel</a> 
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
              <a class="btn bg-green disabled btn-block" id="PrintInvoice">Print Bill</a>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
              @if(Cookie::get('IsAdvance')==1)
                <a class="btn bg-blue btn-block disabled" id="Advance">Advance</a>
              @endif
            </div>
          </div>

          <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            <a class="btn bg-maroon btn-lg disabled btn-block" id="tender"> <i class="fa fa-chevron-circle-right"></i><br><strong>Pay</strong></a>
          </div>
        </div>              
      </div>

      <!-- =============== Product List ====================== -->
      <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6 inner-content ">
        <div class="row" id="ProductCategoryContainer">
          @foreach ($CategoryList as $Category)
            <div class="col-sm-4 col-md-4 col-lg-4 col-xs-6">
              <button name="CategoryFilter[]" type="button" class="btn bg-blue btn-block CategoryFilter" value="{{ $Category->CategoryID }}">{{ $Category->CategoryName }}</button>
              <hr style="margin:2px 0px 2px 0px;">
            </div>
          @endforeach
        </div>

        <div class="row" id="ProductListContainer">
          @foreach($product as $data)
            <div class="col-sm-4 col-md-4 col-lg-4 col-xs-6">
              <button name="ProductSelect[]" class="btn btn-default btn-block ProductSelect" value="{{$data->ProductID}}">
                {{ $data->ProductName }}<br>
                {{ CurrencySymbol() }} {{ round($data->SalePrice,2) }}
              </button>
              <hr style="margin:2px 0px 2px 0px;">
            </div>
          @endforeach
        </div>

        <script>
          $(function(){
            $('#ProductListContainer').slimScroll({
              size: '1px',
              height: '500px',
              width: 'auto',
              wheelStep: 50,
              alwaysVisible: false
            });

            $('#ProductCategoryContainer').slimScroll({
              size: '1px',
              height: '100px',
              width: 'auto',
              wheelStep: 50,
              alwaysVisible: false
            });
          });
        </script>
      </div>
      
      {{ Form::open(array('id' => 'AdvanceForm', 'url' => '/Sale/Advance/Confirm', 'target' => 'AdvanceWindow')) }} 
      {{ Form::close() }}

      <form id="CashSaleFormSubmit" method="post" action="{{URL::to('/Sale/Invoice/')}}" target="TestWindow">
        {{ csrf_field() }}
        <div id="CashSaleForm"></div>
      </form>

      <form id="OrderFormSubmit" method="POST" action="{{URL::to('/Sale/Order/New')}}" target="OrderWindow">
        {{ csrf_field() }}
        <div id="OrderForm">          
        </div>
      </form>
      <form id="OrderFormforUpdateSubmit" method="POST" action="{{URL::to('/Sale/Order/Update')}}" target="OrderWindowUpdate">
        {{ csrf_field() }}
        <div id="OrderFormforUpdate"></div>
      </form>
      <form id="OrderFormforUpdateWithoutProduct" method="POST" action="{{URL::to('/Sale/Order/Update/WithoutProduct')}}">
        {{ csrf_field() }}
      </form>
      <form id="OrderFormforInvoice" method="POST" action="{{URL::to('/Sale/Order/Invoice')}}" target="OrderWindowforInvoice">
        {{ csrf_field() }}
      </form>
      <form id="OrderTicketForm" method="POST" action="{{URL::to('/Sale/Order/Ticket')}}" target="OrderTicketWindow">
        {{ csrf_field() }}
      </form> 

      <!-- =================== Payment Methods Modal ===================-->
      <div class="modal" id="CashModal" role="dialog">
        <div class="modal-dialog" id="fahad">
          <!-- Modal content-->
          <!-- <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-6 col-xs-offset-3 col-lg-6 col-lg-offset-3"> -->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h1 class="modal-title text-center">
                  <p class="label label-primary">Payment Methods</p>
                </h1>
              </div>
              <div class="modal-body">
                <button type="button" class="btn btn-success btn-block   btn-lg"  id="cash"> <i class="fa fa-hand-lizard-o fa-lg"></i> <br> Cash Payment</button>
                <div class="PaymentMethods">
                  @foreach($Payment as $data)
                    <input type="hidden" name="PaymentMethodCardID[]" value="{{$data->ID}}">      
                    <input type="hidden" name="PaymentMethodCardName[]" value="{{$data->MethodName}}">
                    <button type="button" class="btn btn-primary   btn-block  btn-lg PaymentMethodCardNameButton" name="PaymentMethodCardNameButton[]" id="{{$data->ID}}"><i class="fa fa-credit-card"></i> <br> {{$data->MethodName}}</button>
                  @endforeach
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn bg-purple   btn-block  btn-lg " id ="SplitPayment"><i class="fa fa-paper-plane"></i> Split Payment</button>
              </div>
            </div>
          <!-- </div> -->
        </div>
      </div>
      <!-- ===================  Calculator Modal ===================-->
      <div class="modal" id="CalculatorModal" role="dialog">
        <div class="modal-dialog" id="fahad">
          <!-- Modal content-->
          <div class="col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-primary"><i class="fa fa-calculator"></i> Calculator</p>
                </h1>
              </div>
              <div class="modal-body">
                <!-- Calculator Body -->
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
      <!--=================== Shop Select Modal ===================-->
      <div class="modal" id="shopselect" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="col-md-6 col-sm-6 col-lg-5 col-xs-10 col-md-offset-3 col-sm-offset-3 col-lg-offset-3 col-xs-offset-1 ">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-info">Enter Shop</p>
                </h1>
              </div>
              <div class="modal-body">
                <div class="btn-group-vertical">
                  @foreach ($all as $data)
                    <input type="hidden" name="shopnam[]" value="{{$data->ShopID}}" class="shopnam">
                    <button class="btn bg-blue btn-lg   shopselect" name="shopselect[]" type="button">{{$data->ShopName}}</button> <hr>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--=================== User Selection Modal ===================-->
      <div class="modal" id="userselect" role="dialog">
        <div class="modal-dialog">
          <!--=================== Modal content ===================-->
          <div class="col-xs-6 col-md-6 col-sm-6 col-lg-6 col-xs-offset-3 col-md-offset-3 col-sm-offset-3 col-lg-offset-3">
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
      </div>
      <!-- =================== Sale Price Modal ===================-->
      <div class="modal" id="PriceSelect" role="dialog">
        <div class="modal-dialog">
          <!-- =================== Modal content =================== -->
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
          <!-- =================== Modal content =================== -->
          <div class="col-xs-6 col-md-6 col-sm-6 col-lg-6 col-xs-offset-3 col-md-offset-3 col-sm-offset-3 col-lg-offset-3">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-primary">Quantity</p>
                </h1>
              </div>
              <div class="modal-body">
              <form method="post" id="QuantityForm">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon bg-olive"><strong>Current Stock :</strong></span>
                    <input type="text" class="form-control" id="ShopQuantity" readonly>
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
              </div>
            </div>
          </div>
        </div>
      </div>   
      <!-- =================== Customer Due Payment from Refund  Modal ===================-->
      <div class="modal" id="CustomerBalancePayment" role="dialog">
        <div class="modal-dialog modalCustomerPayment">
          <!-- =================== Modal content =================== -->
          <div class="col-xs-6 col-md-6 col-sm-6 col-lg-6 col-xs-offset-3 col-md-offset-3 col-sm-offset-3 col-lg-offset-3">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-success">Customer Payment</p>
                </h1>
              </div>
              <div class="modal-body">
                <form id="CustomerPaymentForm">  
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
                </form>
                <!-- Input Group -->
              </div>
              <!-- Modal Body -->
            </div>
            <!-- Modal Content -->
          </div>
          <!-- Div Class -->
        </div>
        <!-- Modal Dialog -->
      </div>
      <!-- =================== Opening Balance Modal ===================-->
      <div class="modal" id="OpeningBalance" role="dialog">
        <div class="modal-dialog">
          <!-- =================== Modal content =================== -->
          <div class="col-xs-6 col-md-6 col-sm-6 col-lg-6 col-xs-offset-3 col-md-offset-3 col-sm-offset-3 col-lg-offset-3">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-primary">Opening Balance</p>
                </h1>
              </div>
              <div class="modal-body">
                <form id="OpeningBalanceForm">
                  <div class="input-group">
                    <input type="hidden" name="OpeningBalanceID" id="OpeningBalanceID">
                    <input type="number" step=".0001" class="form-control" id="OpeningBalanceValue" autocomplete="off" name="OpeningBalanceValue" autofocus>
                    <span class="input-group-btn">              
                      <input  class="btn bg-purple usersel  " id="OpeningBalanceSubmit" type="submit" value="Add Balance">
                    </span>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- =================== Editing Balance Modal ===================-->
      <div class="modal" id="EditingBalance" role="dialog">
        <div class="modal-dialog">
          <!-- =================== Modal content =================== -->
          <div class="col-xs-6 col-md-6 col-sm-6 col-lg-6 col-xs-offset-3 col-md-offset-3 col-sm-offset-3 col-lg-offset-3">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-primary">Editing Balance</p>
                </h1>
              </div>
              <div class="modal-body">
                <form id="EditingBalanceForm">
                  <input type="hidden" class="form-control" value="{{$CashDrawerID}}" id="CashDrawerID">
                  <div class="input-group">
                    <input type="hidden" name="EditingBalanceID" id="EditingBalanceID">
                    <input type="number" step=".0001" class="form-control" id="EditingBalanceValue" autocomplete="off" name="EditingBalanceValue" value="{{$BalanceValue}}" autofocus>
                    <span class="input-group-btn">              
                      <input  class="btn bg-purple usersel  " id="EditingBalanceSubmit" type="submit" value="Edit Balance">
                    </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- =================== Closing Balance Modal ===================-->
      <div class="modal" id="ClosingBalance" role="dialog">
        <div class="modal-dialog">
          <!-- =================== Modal content =================== -->
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
      <!-- =================== New Expense Modal ===================-->
      <div class="modal" id="NewExpense" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="col-xs-12 col-md-6 col-sm-6 col-lg-6 col-md-offset-3 col-sm-offset-3 col-lg-offset-3">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-primary"><i class="fa fa-pencil"></i> New Expense</p>
                </h1>
              </div>
              <div class="modal-body">
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
              <div class="modal-footer">                 
                <button  class="btn btn-danger  " type="button " data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--===================== Open Item Modal ====================-->
      <div id="OpenItemModal" class="modal" role="dialog">
        <div class="modal-dialog modal-fullscreen-dialog">
          <!-- Modal content-->
          <div class="modal-content modal-fullscreen-content">
            <div class="modal-header">
              <h1 class="modal-title text-center"><p class="label label-primary"><i class="fa fa-opencart fa-lg"></i> Open Item</p></h1>
            </div>
            <div class="modal-body"> 
              <div class="content">
                <form class="form-horizontal" id="NewProductFromSale" action="{{URL::to('/Sale/Product/New')}}" method="post">
                {{ csrf_field() }}
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

                    <input type="button" id="ResetBtn" class="btn   bg-maroon"  value="Reset">
                  </div>
                </div>                
              </form>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn   btn-danger" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div> 
      <!-- =================== AppName() Info Modal ===================-->
      <div class="col-md-6 col-md-offset-1">
        <div class="modal" id="{{ AuthorName() }}InfoModal" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
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
      <!-- =================== Previous Invoice Modal ===================-->
      <div class="modal" id="PreviousInvoiceModal" role="dialog">
        <div class="modal-dialog modal-fullscreen-dialog">
          <!-- Modal content-->
          <div class="modal-content modal-fullscreen-content">
            <div class="modal-header">
              <h1 class="modal-title text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                    <!-- /.tab-content -->
                  </div>                   
                </div>
              </div>              
            </div>

            <div class="modal-footer">
              <button  class="btn btn-danger  " type="button " data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>      
      <!-- =================== Previous Refund Modal ===================-->
      <div class="modal" id="PreviousRefundModal" role="dialog">
        <div class="modal-dialog modal-fullscreen-dialog">
          <!-- Modal content-->
          <div class="modal-content modal-fullscreen-content">
            <div class="modal-header">
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
                      <!-- /.tab-pane -->
                      <div class="tab-pane" id="RefundedInvoiceList"></div>
                      <!-- /.tab-pane -->                      
                    </div>
                    <!-- /.tab-content -->
                  </div> 
                </div>
              </div>
              <button  class="btn btn-danger  " type="button " data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>

      <!-- =================== Previous Advance  Modal ===================-->
      <div class="modal" id="PreviousAdvanceModal" role="dialog">
        <div class="modal-dialog  modal-fullscreen-dialog">
          <!-- Modal content-->
          <div class="modal-content modal-fullscreen-content">
            <div class="modal-header">
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
            <div class="modal-footer">
              <button  class="btn btn-danger  " type="button " data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>

      <!-- =================== Previous Advance Details Modal ===================-->
      <div class="modal" id="PreviousAdvanceDetailsModal" role="dialog">
        <div class="modal-dialog modal-fullscreen-dialog">
          <!-- Modal content-->
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
      <!-- =============== Tax Selection Modal ====================== -->
      <div class="col-md-3 col-md-offset-1">
        <div class="modal" id="TaxModal" role="dialog">
          <div class="modal-dialog taxcodemodal">
            <!--=============== Modal content ===============-->
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
        <div class="modal-dialog modalAdvance">
          <!--=============== Modal content ===============-->        
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <p class="label label-primary"><i class="fa fa-hand-lizard-o"></i> Advance</p>
              </h1>
            </div>
            <div class="modal-body">
              <form id="AdvanceAddForm" >
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
              </form>
            </div>
          </div>          
          <!--=============== / Modal content ===============-->
        </div>
      </div>
      <!-- =================== Day Summary Modal ===================-->
      <div class="modal" id="DaySummaryModal" role="dialog">
        <div class="modal-dialog modalquantity">
          <!-- =================== Modal content =================== -->
          <div class="col-xs-6 col-md-6 col-sm-6 col-lg-6 col-xs-offset-3 col-md-offset-3 col-sm-offset-3 col-lg-offset-3">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-primary">Day Summary</p>
                </h1>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <input type="date" class="form-control" name="DaySummaryDate" id="DaySummaryDate">
                </div>
                <button class="btn bg-olive btn-lg btn-block" id="DaySummary">View Day Summary</button>
              </div>
              <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>                
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- =================== Order Start Modal ===================-->
      <div class="modal" id="OrderStart" role="dialog">
        <div class="modal-dialog modalquantity">
          <!-- =================== Modal content =================== -->
          <div class="col-xs-6 col-md-6 col-sm-6 col-lg-6 col-xs-offset-3 col-md-offset-3 col-sm-offset-3 col-lg-offset-3">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-primary">Take Order</p>
                </h1>
              </div>
              <div class="modal-body">
                <button class="btn bg-olive btn-lg" id="NewOrderButton"><i class="fa fa-check-circle"></i> <br>New Order</button>
                <button class="btn bg-orange btn-lg" id="UpdateOrderButton"><i class="fa fa-pencil-square-o"></i> <br>Update Order</button>
              </div>
              <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>                
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- =================== Select Table ===================-->
      <div class="modal" id="SelectTableModal" role="dialog">
        <div class="modal-dialog modal-fullscreen-dialog">
          <!-- =================== Modal content =================== -->
            <div class="modal-content modal-fullscreen-content">
              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-primary">Tables</p>
                </h1>
              </div>
              <div class="modal-body">
                <div class="content">
                  <div class="col-md-1 col-sm-1 col-xs-2 col-lg-1">                                      
                    <button class="btn btn-block btn-lg">1</button>
                  </div>

                  <div class="col-md-1 col-sm-1 col-xs-2 col-lg-1">
                    <button class="btn btn-block btn-lg bg-maroon"><strong>2 </button>
                  </div>

                  <div class="col-md-1 col-sm-1 col-xs-2 col-lg-1">                                      
                    <button class="btn btn-block btn-lg">1</button>
                  </div>
                  <div class="col-md-1 col-sm-1 col-xs-2 col-lg-1">                                      
                    <button class="btn btn-block btn-lg">12</button>
                  </div>
                  <div class="col-md-1 col-sm-1 col-xs-2 col-lg-1">                                      
                    <button class="btn btn-block btn-lg">1</button>
                  </div>
                  <div class="col-md-1 col-sm-1 col-xs-2 col-lg-1">                                      
                    <button class="btn btn-block btn-lg">1</button>
                  </div>
                  <div class="col-md-1 col-sm-1 col-xs-2 col-lg-1">                                      
                    <button class="btn btn-block btn-lg">1</button>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-danger  " data-dismiss="modal">Cancel</button>                
              </div>
            </div>
        </div>
      </div>

      <!-- =============== New Order Place Modal ====================== -->
      <div class="modal" id="OrderPlaceModal" role="dialog">
        <div class="modal-dialog modaldiscount">
          <!--=============== Modal content ===============-->
          <div class="col-md-12">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h1 class="modal-title text-center">
                  <p class="label label-primary"><i class="fa fa-check-circle fa-lg"></i> New Order</p>
                </h1>
              </div>
              <div class="modal-body">
                <div class="content">
                  <form id="OrderPlaceForm" class="form-horizontal">                
                    <!--=============== Counter List ===============-->
                    <div class="form-group">           
                      <input type="hidden" name="CounterForm" id="CounterID" value="0">
                      <div id="CounterID1"> </div> 
                      <div id="CounterID2"> </div> 
                    </div>
                    <!--=============== User List ===============-->
                    <div id="OrderNewBody">
                      <div class="form-group">                    
                        <div class="col-md-6">
                          <div class="input-group">
                            <span class="input-group-addon">Staff :</span>
                            <select id="StaffID" class="form-control">
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
                            <input type="number" class="form-control" name="GuestCount" id="GuestCount" step=".0001" >
                          </div>
                        </div>                      
                      </div>
                      <div class="form-group">
                        <div class="col-sm-6">
                          <div class="input-group">
                            <span class="input-group-addon">Note :</span>
                            <input type="text" class="form-control" name="Notes" id="NotesforNewOrder">
                          </div>
                        </div>
                      </div>
                      <div class="form-group"> </div>                      
                      <div class="form-group">
                        <div class="col-md-6">
                          <button type="submit" class="btn bg-purple   btn-lg btn-block" id="ConfirmOrderPlace"><i class="fa fa-check-circle fa-lg"></i> <br><strong>Place New Order</strong></button>
                        </div>            
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!--=============== / Modal content ===============-->
        </div>
      </div>
      <!-- =============== Order Update Modal ====================== -->
      <div class="modal" id="OrderUpdateModal" role="dialog">
        <div class="modal-dialog modaldiscount">

          <!--=============== Modal content ===============-->
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
                  <form id="OrderUpdateForm" class="form-horizontal">                
                    <!--=============== Counter List ===============-->
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
                      
                      <button type="submit" class="btn bg-purple   btn-lg" id="OrderPlace"><i class="fa fa-check-circle fa-lg"></i> <br><strong>Update Order</strong></button>
                    </div>
                  </form>
                </div>                
              </div>
            </div>
          </div>
          <!--=============== / Modal content ===============-->
        </div>
      </div>
      <!-- =================== Order Place List Modal ===================-->
      <div class="modal" id="OrderPlaceListModal" role="dialog">
        <div class="modal-dialog modal-fullscreen-dialog">
          <!-- Modal content-->
          <div class="modal-content modal-fullscreen-content">
            <div class="modal-header">
              <h1 class="modal-title text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                      <!-- /.tab-pane -->
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
                      <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                  </div>                   
                </div>
              <button  class="btn btn-danger  " type="button " data-dismiss="modal">Cancel</button>

              </div>              
            </div>
            <!-- <div class="modal-footer">
              <button  class="btn btn-danger  " type="button " data-dismiss="modal">Cancel</button>
            </div> -->
          </div>
        </div>
      </div>  
      <!-- =============== Sale Hold Modal ====================== -->
      <div class="modal" id="SaleHoldModal" role="dialog">
        <div class="modal-dialog modaldiscount">
          <!--=============== Modal content ===============-->
          <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-6 col-xs-offset-3 col-lg-6 col-lg-offset-3">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h1 class="modal-title text-center">
                  <p class="label label-primary"><i class="fa fa-hand-stop-o"></i> Sale Hold</p>
                </h1>
              </div>

              <div class="modal-body">
                <form id="SaleHoldForm">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon ">Note :</span>
                      <input type="text" name="SaleHoldName" id="SaleHoldName" class="form-control" placeholder="Name" autofocus>
                    </div>
                  </div> 
                  <button type="submit" class="btn bg-purple   btn-lg btn-block" id="ConfirmHold" value="Confirm Hold"><i class="fa fa-paper-plane"></i> <br><strong>Confirm Hold</strong></button>
                </form>
              </div>
            </div>
          </div>
          <!--=============== / Modal content ===============-->
        </div>
      </div>
      <!-- =================== Sale Hold List Modal ===================-->
      <div class="modal" id="SaleHoldListModal" role="dialog">
        <div class="modal-dialog modal-fullscreen-dialog">
          <!-- Modal content-->
          <div class="modal-content modal-fullscreen-content">
            <div class="modal-header">
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
            <div class="modal-footer">
              <button  class="btn btn-danger  " type="button " data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>
      <!-- =================== Hold Details Modal ===================-->
      <div class="modal" id="PreviousHoldDetailsModal" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
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
      <!-- =================== Order Details Modal ===================-->
      <div class="modal" id="OrderDetailsModal" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
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

      <!-- =================== Invoice Details Modal ===================-->
      <div class="modal" id="PreviousSaleDetailsModal" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
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
      <!-- ===============OverAll Tax Selection Modal ====================== -->
      <div class="modal" id="TaxModalOverAll" role="dialog">
        <div class="modal-dialog taxcodemodal">
          <!--=============== Modal content ===============-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
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
              <button type="button" class="btn bg-olive   btn-lg" id="OverallTaxReset">Reset</button>
            </div>
          </div>
        </div>
      </div>

      <!---=============== CashPayment Modal ================-->
      <div class="modal" id="" role="dialog">
        <!-- =============== Modal Dialog ===============-->
        <div class="modal-dialog modal-fullscreen-dialog">
          <!--=============== Modal content ===============-->
          <!-- <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 col-lg-6 col-lg-offset-3"> -->
            <div class="modal-content modal-fullscreen-content">
              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-primary">Cash Payment</p>
                </h1>
              </div>
              <!--=============== Modal Body ===============-->
              <div class="modal-body">
                <form  role="form" enctype="multipart/form-data" id="myform">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <h3><label class="label label-primary">Total</label></h3>
                    <div class="input-group">
                      <input type="hidden" name="dada" id="Payable" class="form-control" readonly>
                      <input type="number" value="0" id="CashPaymentforTender" class="form-control" readonly>
                      <span class="input-group-addon">{{ CurrencySymbol() }}</span>
                    </div>
                  </div>
                  <div class="form-group AdvanceCashArea"></div>
                  <div class="form-group" id="PayingArea">
                    <h3><label class="label label-primary">Cash Paid</label></h3>
                    <div class="input-group">
                      <input type="text" name="paid" id="Paid" class="form-control" placeholder="Enter the paid amount" step=".0001" autocomplete="off" autofocus > 
                    </div>
                  </div>
                  <div id="CashPaymentExtraInformation"></div>                      
                  <div class="form-group" id="ExactButtonArea">
                    <button type="button" class="btn   bg-purple btn-block btn-lg" id="ExactTenderAmount" class="form-control"> Exact Amount </button>
                  </div> 
                  <div class="form-group" id="ChangeAreaforCash">
                    <h3><label class="label label-primary"> Change</label></h3>
                    <div class="input-group">
                      <input type="text" name="returned" id="Change" class="form-control" readonly value="0" autocomplete="off">                        
                      <span class="input-group-addon">{{ CurrencySymbol() }}</span>         
                    </div>
                  </div>
                  <div id="myformProductList"></div>
                  <div id="CashSubmitArea">
                    <button type="submit" class="btn btn-success btn-lg   btn-block" id="SubmitTender" disabled="disabled"><i class="fa fa-paper-plane"></i><br><strong>Submit Payment</strong></button>
                  </div>
                </form> 
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger  " data-dismiss="modal">Cancel</button>
              </div>
              <!--=============== /Modal Body ===============-->
            </div>
            <!--=============== /Modal Content ===============-->
          <!-- </div> -->
        </div>
        <!--=============== /Modal Dialog ===============-->
      </div>

      <!---=============== CashPayment Modal ================-->
      <div class="modal" id="PaymentCashModalShow" role="dialog">
        <!-- =============== Modal Dialog ===============-->
        <div class="modal-dialog">
          <!--=============== Modal content ===============-->
          <!-- <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-6 col-xs-offset-3 col-lg-6 col-lg-offset-3"> -->
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-primary">Cash Payment</p>
                </h1>
              </div>
              <!--=============== Modal Body ===============-->
              <div class="modal-body">
                <form id="myformshow">
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
                </form> 
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger  " data-dismiss="modal">Cancel</button>
              </div>
              <!--=============== /Modal Body ===============-->
            </div>
            <!--=============== /Modal Content ===============-->
          </div>
        <!-- </div> -->
        <!--=============== /Modal Dialog ===============-->
      </div>     

      <!---=============== SingleCardPayment Modal ================-->
      <div class="modal" id="PaymentMasterCardModal" role="dialog">
        <!-- =============== Modal Dialog ===============-->
        <div class="modal-dialog">
          <!--=============== Modal content ===============-->
          <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-6 col-xs-offset-3 col-lg-6 col-lg-offset-3">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title text-center">
                <div id="CardName">
                  <p class="label label-primary"><i class="fa fa-cc-mastercard"></i> Master Card</p></div>
                </h1>
              </div>
              <!--=============== Modal Body ===============-->
              <div class="modal-body">
                <div class="content">
                  <form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{URL::to('ModalTenderCard')}}" id="myformcard">
                    {{ csrf_field() }}
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
                    <div class="form-group CustomerCheck">
                      <div class="col-xs-12">
                        <h3><label class="label label-primary"> Amount :</label></h3>
                      </div>

                      <div class="col-xs-12">
                        <input type="text" name="returned" id="CardAmount" class="form-control" style="padding:10px; font-size: 12px;" placeholder="Enter the Paid Amount" value="0" autocomplete="off">
                      </div>
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-success btn-lg btn-block  " id="SubmitTenderCard" disabled="disabled"><i class="fa fa-paper-plane"></i><br>Submit</button>
                    </div> 
                  </form> 
                </div>               
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-lg  " data-dismiss="modal">Cancel</button>
              </div>
              <!--=============== /Modal Body ===============-->
            </div>
            <!--=============== /Modal Content ===============-->
          </div>
        </div>
        <!--=============== /Modal Dialog ===============-->
      </div>        

      <!---=============== SplitPayment Modal ================-->
      <div class="modal" id="PaymentSplitModal" role="dialog">
        <!-- =============== Modal Dialog ===============-->
        <div class="modal-dialog ">
          <!--=============== Modal content ===============-->
          <!-- <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-6 col-xs-offset-3 col-lg-6 col-lg-offset-3"> -->
            <div class="modal-content">
              <div class="modal-header with-border">
                <h1 class="modal-title text-center">
                  <p class="label label-primary">Split Payment</p>                
                </h1>
                <h2 class="modal-title text-center">
                  <p  id="SplitPaymentPayable"></p>
                </h2>
              </div>
              <!--=============== Modal Body ===============-->
              <div class="modal-body">
                <form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{URL::to('/Sale/Tender/SplitPayment')}}" id="SplitPaymentForm" target="SplitWindow">

                {{ csrf_field() }}

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
                  </div>                 

                  <button type="button" class="btn btn-success btn-lg btn-block  " id="SubmitSplitPayment"><i class="fa fa-paper-plane fa-lg"></i> <br><strong>Submit Payment</strong></button>
                </form>

                <div class="modal-footer">
                  <button type="button" class="btn btn-danger  " data-dismiss="modal">Cancel</button>
                </div>
              </div>
              <!--=============== /Modal Body ===============-->
            </div>
            <!--=============== /Modal Content ===============-->
          </div>
        <!-- </div> -->
        <!--=============== /Modal Dialog ===============-->
      </div>

      <!-- =============== Refund Modal ====================== -->
      <div class="modal" id="RefModal">
        <div class="modal-dialog  modal-fullscreen-dialog">
          <div class="modal-content modal-fullscreen-content">
            <div class="modal-header">
              <h1 class="modal-title text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <p class="label label-primary"><i class="fa fa-hand-o-left"></i> Refund Product</p>
              </h1>
            </div>

            <div class="modal-body">
             <div class="form-group CustomerPaymentforRefund">
                <!-- <hr> -->
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

                <form id="RefundforInvoice" action="{{URL::to('/Sales/Refund/Invoice')}}" method="post" target="RefundWindow">
                  {{ csrf_field() }}

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

              </form> 
              </div>
              <table class="table table-bordered table-responsive table-condensed" id="RefProID">
                <tr class="text-center">
                <form id="RefundforProduct" action="{{URL::to('/Sales/Refund/Product')}}" method="post" target="RefundWindowforProduct">
                {{ csrf_field() }} 
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
                </form>
              </div>
            </div>

            <div class="modal-footer">
              <input type="button" class="btn btn-danger  " value="Cancel" data-dismiss="modal">
            </div>
          </div>
          <!-- Modal content-->
        </div>
      </div>
      <!-- =============== Single Discount Modal ====================== -->
      <div class="col-md-2 col-md-offset-1">
        <div class="modal" id="dismodal" role="dialog">
          <div class="modal-dialog modaldiscount">
            <!--=============== Modal content ===============-->
            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-6 col-xs-offset-3 col-lg-6 col-lg-offset-3">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h1 class="modal-title text-center">
                    <p class="label label-primary">Single Discount</p>
                  </h1>
                </div>
                <div class="modal-body">
                  <form id="DiscountForm">
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
                  </form>
                </div>
              </div>
            </div>
            <!--=============== / Modal content ===============-->
          </div>
        </div>
      </div>
      <!-- =============== Overall Discount modal ====================== -->
      <div class="modal" id="DiscountModal" role="dialog">
        <div class="modal-dialog">
          <!-- =============== Modal content ====================== -->
          <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-6 col-xs-offset-3 col-lg-6 col-lg-offset-3">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h1 class="modal-title text-center">
                  <p class="label label-primary">Overall Discount</p>
                </h1>
              </div>
              <div class="modal-body">
                <form id="OverAllDiscountForm">
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
                </form>
              </div>
            </div>
          </div>
          <!-- =============== Modal content ====================== -->
        </div>
      </div>      
      <!-- =============== Customer Selection Modal ====================== -->
      <div class="modal" id="CustomerModal" role="dialog">
        <div class="modal-dialog modal-fullscreen-dialog">
          <!--=============== Modal content ===============-->
          <div class="modal-content modal-fullscreen-content">
            <div class="modal-header">
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
            <div class="modal-footer">
              <button type="button" class="btn btn-primary   " id="CustomerReset" data-dismiss="modal">Reset</button>
              <button type="button" class="btn btn-danger  " data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>
      <!---=============== New Customer Modal ================-->
      <div class="modal" id="NewCustomer" role="dialog">
        <!-- =============== Modal Dialog ===============-->
        <div class="modal-dialog">
          <!--=============== Modal content ===============-->
          <div class="col-md-10 col-md-offset-1">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-primary">Add New Customer</p>
                </h1>
              </div>
              <!--=============== Modal Body ===============-->
              <div class="modal-body">
                <form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{URL::to('/Customer/New')}}" id="newcustomerform">
                  {{ csrf_field() }}                   
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
                        <img id="CustomerImgPlace" src="/uploads/image/customer/malik.jpg" alt="your image" width="100" height="100" />
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
                 </form>
                  <button type="button" class="btn btn-danger   btn-lg" data-dismiss="modal">Cancel</button>
                </div>              
              <!--=============== /Modal Body ===============-->
            </div>
            <!--=============== /Modal Content ===============-->
          </div>
        </div>
        <!--=============== /Modal Dialog ===============-->
      </div> 
      <!-- =============== Customer Details Modal ====================== -->
      <div class="col-md-2 col-md-offset-1">
        <div class="modal" id="CustomerDetailsModal" role="dialog">
          <div class="modal-dialog">
            <!--=============== Modal content===============-->
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
            <!--=============== /Modal content===============-->
          </div>
        </div>
      </div> 
      <!-- =============== Product Details Modal ====================== -->
      <div class="col-md-2 col-md-offset-1">
        <div class="modal" id="ProductDetailsModal" role="dialog">
          <div class="modal-dialog">
            <!--=============== Modal content===============-->
            <div class="modal-content">

              <div class="modal-header" id="heading">
                <h1 class="modal-title text-center" ><p class="label label-primary">Product Details</p></h1>
              </div>

              <div class="modal-body">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title" id="Product_Title"></h3>
                    </div>

                    <div class="box-body">
                        <table class="table table-bordered table-striped table-responsive" id="modalproductdetail">
                        </table>
                    </div>
                </div>
                <button class="btn btn-primary   " id="SelectFromProductDetailsModal" type="button" title="Select"> Select</button>
                <button class="btn btn-danger   " type="button" data-dismiss="modal" title="Cancel">Cancel</button>
              </div>
            </div>
            <!--=============== /Modal content===============-->
          </div>
        </div>
      </div>
    </section>
    <!--====================== Main content =========================-->
  </div>  
@endsection