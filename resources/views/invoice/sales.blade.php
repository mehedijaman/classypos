<!DOCTYPE html>
<html>
<head>
  <title>Sales Invoice # {{ $Invoice->InvoiceID }}</title>

  <!-- Latest jquery -->
  {{ Html::script('/plugins/jQuery/jquery-3.2.1.min.js') }}

  <!-- Font Awesome -->
  {{ Html::style('/font-awesome/css/font-awesome.min.css') }}

  <!-- AlertfityJS -->  
  {{ Html::style('/plugins/alertify/css/alertify.min.css') }}
  {{ Html::script('/plugins/alertify/alertify.min.js') }}
  
  <!-- Invoice CSS -->
  {{ Html::style('/css/invoice.css', array('media' => 'all')) }}

  <!-- Invoice JS -->
  {{ Html::script('/js/invoice.js') }}
  <style>
    img {  margin-left:110px; } 
  </style>

</head>

<body id="body">

  <div class="wrapper" id="wrapper">
    <h4 align="center"><i class="fa fa-shopping-bag fa-lg"></i> Sales Invoice</h4>

    <hr>

    @if($Shop->ShopLogo!="")
      <img src="/uploads/image/shop/{{$Shop->ShopLogo}}" width=70 height=70 class="img img-responsive">
    @endif

    <h4 align="center">{{$Shop->ShopName}}</h4>

    <hr>
    
    <table>
      @if ($Shop->ShopAddress)
        <tr>
          <td>Address</td>
          <td>: {{ $Shop->ShopAddress }}</td>
        </tr>
      @endif

      @if ($Shop->Phone)
        <tr>
          <td>Phone</td>
          <td>: {{ $Shop->Phone }}</td>
        </tr>
      @endif

      @if ($Shop->Email)
        <tr>
          <td>Email</td>
          <td>: {{ $Shop->Email }}</td>
        </tr>
      @endif

      @if ($Shop->Website)
        <tr>
          <td>Website</td>
          <td>: {{ $Shop->Website }}</td>
        </tr>
      @endif

      @if($Shop->VatRegNo)
        <tr>
          <td>VAT Reg</td>
          <td>: {{ $Shop->VatRegNo }}</td>
        </tr>
      @endif
    </table>

    @if(isset($Order))
      <hr>

      <table>      
        <tr>
          <td>Order ID</td>
          <td>
            : {{ $Order->ID }}
          </td> 

          <td>Table </td>
          <td>
            : {{ $Order->Name }}
          </td>        
        </tr>

        <tr>
               
        </tr>

        <tr>
          @if($Order->Guests)
            <td>Guest </td>
            <td>
              : {{ $Order->Guests }}
            </td>
          @endif

          <td>Served By </td>
          <td>
            : {{ $Order->FirstName }}
          </td>
        </tr>
       
      </table>
    @endif

    <hr>

    <table>
      <tr>
        <td>Invoice ID</td>
        <td>
          : <strong>{{ $Invoice->InvoiceID }}</strong>
        </td>       
      </tr>
      <tr>
        <td>Invoice Date</td>
        <td>: {{ date('d/m/y | h:i A', strtotime($Invoice->created_at)) }}</td>
      </tr>

      <tr>
        <td>Print Date</td>
        <td>: {{ date('d/m/y | h:i A') }}</td>
      </tr>
    </table>

    <hr>

    <table>
      <tr>
        <th>#</th>
        <th>Item / Description</th>
        <th>Amount</th>
      </tr>

      <?php $TotalQty = 0;$SubTotal=0; ?>

      @for($i=0; $i<$ItemQty; $i++) 

        <?php $TotalQty += $Qty[$i]; ?>

        @if($Qty[$i]>0)

          <tr>
            <td><strong>{{ $i+1 }}.</strong></td>


            <td>
              {{ $ProductName[$i] }} [{{$ProductID[$i]}}S{{$ShopID[$i]}}] <br> 
              [{{ round($Qty[$i],2) }} X {{ round($Price[$i],2) }}]@if($discount[$i]>0) [Dis-{{round($discount[$i],2)}}]@endif <br>          
            </td>

            <?php          
              $FinalPrice = $Price[$i] * $Qty[$i]; 
              $SubTotal   = $SubTotal  + $FinalPrice; 
            ?>
            <td>{{ round($FinalPrice),2}}</td>
          <tr>
        @endif
      @endfor    
    </table>

    <hr>

    Total Quantity : {{ $TotalQty }}

    <hr>

    <table> 

      <tr>
        <td>Sub Total</td>
        <td> : <strong>{{ round($Invoice->SubTotal,2) }}</strong></td>
      </tr>

      @if($Invoice->TaxTotal != 0)
        <tr>
          <td>VAT </td>
          <td> : <strong>{{ round($Invoice->TaxTotal,2) }}</strong></td>
        </tr>
      @endif

      @if($Invoice->ServiceCharge != 0)
        <tr>
          <td>Service Charge</td>
          <td>: <strong>{{ round($Invoice->ServiceCharge,2) }}</strong></td>
        </tr>
      @endif

      @if($TotalDiscount > 0)
        <tr>
          <td>Discount </td>
          <td> : <strong>{{ round($Invoice->Discount,2) }}</strong></td>
        </tr>
      @endif

      <tr>
        <td>Total Due</td>
        <td> : <strong>{{ round($Invoice->Total,2) }}</strong></td>
      </tr>      

      @if(isset($MethodName))
        @for($i=0;$i<$TotalMethod;$i++)
          <tr>
            <td colspan="2"><hr></td>
          </tr>
          
          <tr>
            <td>{{$MethodName[$i]}}</td>
            <td> : <strong>{{round($CardAmount[$i],2)}}</strong></td>
          </tr>
        @endfor

        @if( !isset($SingleCard) )
          <tr>      
            <td>Cash Paid </td>
            <td> : <strong>{{ round($CashAmount,2) }}</strong></td>
          </tr>
        @endif
      @endif 

      @if(isset($AdvanceValue))
        @if($AdvanceValue>0 && !isset($MethodName))

        <tr>
          <td>Advance Paid </td>
          <td> : <strong>{{ round($AdvanceValue,2) }}</strong></td>
        </tr>

        <tr>
          <td>Cash Due </td>
          <td> : <strong>{{ round($CashAmount,2) }}</strong></td>
        </tr>
         
        @endif
      @endif


      @if(isset($AdvanceValue))
        @if($AdvanceValue>0 && isset($MethodName))
        
         <tr>
          <td>Advance Paid </td>
          <td> : <strong>{{ round($AdvanceValue,2) }}</strong></td>
        </tr>
        @endif
      @endif  

      @if($Invoice->IsPaid == 1)
        <tr>
          <td colspan="2"><hr></td>
        </tr>

        @if($Invoice->PaidMoney>0)
        <tr>
          <td>Total Paid </td>
          <td>: <strong>{{ round($Invoice->PaidMoney,2) }}</strong></td>
        </tr>
        @endif

        @if($Invoice->ReturnedMoney>0)
        <tr>
          <td>Changes </td>
          <td> : <strong>{{ round($Invoice->ReturnedMoney, 2)}}</strong></td>
        </tr>
        @endif
      @endif
    </table>

    <hr>

    <p class="InWords" style="text-transform: capitalize;"> {{ $InWords }}  {{ CurrencyName() }} Only</p>    
    
    @if ($CustomerName != 'Annonymous')
      <hr>
      <table>
        <tr>
          <td>Customer</td>
          <td>| {{ $CustomerName }}</td>
        </tr>
        @if($CustomerPreviousBalance>0)
         <tr>
          <td>Previous Due</td>
          
          <td>| {{ round($CustomerPreviousBalance,2) }}</td>
        </tr>
        @endif

        @if($CustomerCurrentBalance>0)
        <tr>
          <td>Current Due</td>
          <td>| {{ round($CustomerCurrentBalance,2) }}</td>
        </tr>
        @endif

        @if($CustomerCurrentBalance>0)
        <tr>
          <td>Total Due</td>
          <td>| {{ round($CustomerTotalBalance,2) }}</td>
        </tr>
        @endif


      </table>      
    @endif  

    @if(isset($ShopFooter))
      <hr>
      <div class="InvoiceFooter">
        {!! $ShopFooter->Footer !!}
      </div>
    @endif 

    <hr>

    Have a nice Day ! | <span class="">{{ $User->name }}</span>    

    <hr>

    <div class="company-info">
      Software by : <span class="TechLab">{{ AuthorName() }} </span> 01614 777555
    </div>

    <hr>
  </div>


</body>
</html>