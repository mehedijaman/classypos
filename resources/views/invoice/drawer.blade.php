<!DOCTYPE html>
<html>
<head>

  @if($Summary==0)
    <title>Drawer Invoice</title>
  @endif
  @if($Summary==1)
  <title>Today's Report</title>
  @endif

  <!-- Latest jquery -->
  {{ Html::script('/plugins/jQuery/jquery-3.2.1.min.js') }}

  <!-- Font Awesome -->
  {{ Html::style('/font-awesome/css/font-awesome.min.css') }}

  <!-- AlertfityJS -->  
  {{ Html::style('/plugins/alertify/css/alertify.min.css') }}

  <!-- Alertify JS -->
  {{ Html::script('/plugins/alertify/alertify.min.js') }}
  
  <!-- Invoice CSS -->
  {{ Html::style('/css/invoice.css', array('media' => 'all')) }}

  <!-- Invoice JS -->
  {{ Html::script('/js/invoice.js') }}
</head>

<body onload="WindowPrint()">

<div class="wrapper">
  <hr>

  <h3>{{$Shop->ShopName}}</h3>

  <hr>

  @if($Summary==0)
    <h3>Drawer Invoice</h3>
  @endif

  @if($Summary==1)
    <h3>Day Summary</h3>
  @endif 

  <hr>

  <table>
    @if($Summary==0)
      <tr>
        <td>Opening Time</td>
        <td>: {{ date('d/m/Y | h:i A',strtotime($CreateTime)) }}</td>
      </tr>

      <tr>
        <td>Closing Time</td>
        <td>: {{ date('d/m/Y | h:i A',strtotime($EndTime)) }}</td>
      </tr>

      <tr>
        <td>Printed</td>
        <td>: {{ date('d/m/Y | h:i A') }}</td>
      </tr>
    @endif

    @if($Summary==1)
      <tr>
        <td>Report of</td>
        <td>: <strong>
        @if($DailyReportDate == 0)
          {{ date('d/m/Y') }}
        @else
          {{ date('d/m/Y', strtotime($DailyReportDate)) }}
        @endif
        </strong></td>
      </tr>
      <tr>
        <td>Printed at</td>
        <td>: {{ date('d/m/Y h:i A') }}</td>
      </tr>
    @endif
  </table> 

  <hr>

  <table>
    <tr>
      <td>Closing Balance</td>
      <td>: <strong>{{ round($CashinHand,2) }}</strong></td>
    </tr>  

    <tr>
      <td colspan="2"><hr></td>
    </tr>
        
    <tr>
      <td>Opening Balance</td>
      <td>: <strong>{{ round($OpeningBalance,2) }}</strong></td>
    </tr>

    <tr>
      <td>TotalSale</td>
      <td>: <strong>{{ round($TotalSales,2) }}</strong></td>
    </tr>

    <tr>
      <td>Today's Advance</td>
      <td>: <strong>{{ round($TotalAdvanceAmount,2) }}</strong></td>
    </tr>

    <tr>
      <td>Previous Advance</td>
      <td>: <strong>{{ round($PreviousAdvance,2) }}</strong></td>
    </tr>

    <tr>
      <td>Refund</td>
      <td>: <strong>{{ round($TotalRefund, 2)}}</strong></td>
    </tr>

    
  </table>

  <hr>

  <table>
    <tr>
      <td>Total Expenses</td>
      <td>: <strong>{{ round($TotalExpense, 2)}}</strong></td>
      @for($i=0;$i<$ItemQty;$i++)
        @if($ExpenseCategoryAmount[$i])
          <tr>
            <td>{{$ExpenseCategoryName[$i]}}</td>
            <td>: {{$ExpenseCategoryAmount[$i]}}</td>
          </tr>
        @endif
      @endfor
    </tr>
  </table>

  <hr>

  <table>
    <tr>
      <td>Waste</td>
      <td>: <strong>{{ round($TotalWaste, 2)}}</strong></td>
    </tr>

    <tr>
      <td>Tax</td>
      <td>: <strong>{{ round($TotalTax, 2)}}</strong></td>
    </tr>

    <tr>
      <td>Discount</td>
      <td>: <strong>{{ round($TotalDiscount,2)}}</strong></td>
    </tr>
  </table>

  <hr>

  <table>
    <tr>
      <td>Cash Tender</td>
      <?php  $TotalCashTendered=$TotalSales-$TotalCardTendered ?>
      <td>: <strong>{{ round($TotalCashTendered, 2)}}</strong></td>

    </tr>
    <tr>
      <td>Card Tender</td>
      <td>: <strong>{{ round($TotalCardTendered, 2)}}</strong></td>

      @for($i=0;$i<$CardMethodType;$i++)
        @if($CardMethodAmount[$i]>0)
          <tr>
            <td>{{$CardMethodName[$i]}} </td>
            <td>: {{$CardMethodAmount[$i]}}</td>
          </tr>
        @endif
      @endfor
    </tr>
  </table>

  <hr>  
  
  <table>
    <tr>
      <td>Total Invoice</td>
      <td>: <strong>{{$TotalInvoice}}</strong></td>      
    </tr>

    <tr>
      <td>Total Item</td>
      <td>: <strong>{{$TotalItem}}</strong></td>      
    </tr>

    <tr>
      <td>Total Quantity</td>
      <td>: <strong>{{ $TotalQuantitySold }}</strong></td>
    </tr>

    <tr>
      <td>Refund Quantity</td>
      <td>: <strong>{{$TotalRefundQuantity}}</strong></td>
    </tr>

    <tr>
      <td>Waste Quantity</td>
      <td>: <strong>{{$TotalWasteQuantity}}</strong></td>
    </tr>        
  </table>

  <hr>

  <h3>Invoices</h3>
  <hr>

  <table class="table table-bordered">
    <tr>
      <th>InvoiceID</th>
      <th>| Time</th>
      <th>| Total</th>
    </tr>
    <tr>
      <td colspan="5"><hr></td>
    </tr>
    @foreach($Invoice as $data)
      <tr>
        <td>{{$data->InvoiceID}}</td>
        <td>{{ date(' h:i A',strtotime($data->created_at)) }} |</td>
        <td><strong>{{round($data->Total,2)}}</strong></td>
      </tr>
    @endforeach
  </table>
  <hr>

  <div class="company-info">
    Powered by : <span class="TechLab">{{ AuthorName() }} </span>  <!-- <span class="LabPOS">{{ AppName() }} </span> {{ AppVersion() }} |  <--><br>
      <!-- To Buy Software : 01614 777 555 -->
  </div>

  <hr>

</div>
</body>
</html>