<!DOCTYPE html>
<html>
<head>

  <title>Refund Invoice @if(isset($Invoice)) # {{ $Invoice->InvoiceID }}@endif</title>

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

<body onload="WindowPrint()" >

  <div class="wrapper">
    <h4 align="center"><i class="fa fa-hand-o-left fa-lg"></i> Refund Invoice</h4>

    <hr>  

    @if($Shop->ShopLogo != "")
      <img src="/uploads/image/shop/{{$Shop->ShopLogo}}" width=70 height=70 class="img img-reponsive">
    @endif

    <h4 align="center">{{$Shop->ShopName}}</h4>

    <hr>
    
    <table>
      @if (isset($Shop->ShopAddress))
        <tr>
          <td>Address</td>
          <td>: {{ $Shop->ShopAddress }}</td>
        </tr>
      @endif

      @if (isset($Shop->Phone))
        <tr>
          <td>Phone</td>
          <td>: {{ $Shop->Phone }}</td>
        </tr>
      @endif

      @if (isset($Shop->Email))
        <tr>
          <td>Email</td>
          <td>: {{ $Shop->Email }}</td>
        </tr>
      @endif

      @if (isset($Shop->WebSite))
        <tr>
          <td>Website</td>
          <td>: {{ $Shop->WebSite }}</td>
        </tr>
      @endif

      @if($Shop->VatRegNo)
        <tr>
          <td>VAT Reg</td>
          <td>: {{ $Shop->VatRegNo }}</td>
        </tr>
      @endif
    </table>

    <hr>    

    <table>
      @if(isset($Invoice))
        <tr>
          <td>Invoice Date</td>
          <td>: {{ date('d/m/y | h:i A', strtotime($Invoice->created_at)) }}</td>
        </tr>
      @endif

      <tr>
        <td>Refund Date</td>
        <td>: {{ date('d/m/y | h:i A') }}</td>
      </tr>
    </table>

    <hr>    

    <table>
      <tr>
        <th>#</th>
        <th>Item/Description</th>
        <th>Amount</th>
        
      </tr>

      @for($i=0; $i < $ItemQty; $i++) 
        <tr>
          <td>{{ $i+1 }}.</td>
          <td>
            {{ $ProductName[$i] }} [{{$ProductID[$i]}}S{{$ShopID[$i]}}] <br> 
            [{{ round($Qty[$i],2) }} X {{ round($Price[$i],2) }}]
          </td>
          
          <td>{{ round($FinalPrice[$i],2) }}</td>
        </tr>
      @endfor
    </table>

    <hr>  

    <table>
      <tr>
        <td><strong>SubTotal</strong></td>
        <td>: {{ round($SubTotalPrice,2) }}</td>
      </tr> 

      <tr>
        <td><strong>Tax</strong></td>
        <td>: {{ round($totalTax,2) }}</td>
      </tr>

      @if($totalDiscount>0)
        <tr>
          <td><strong>Discount</strong></td>
          <td>: {{ round($totalDiscount,2) }}</td>
        </tr>
      @endif

      <tr>
        <td><strong>Total</strong></td>
        <td>: {{ round($totalPrice,2) }}</td>
      </tr>
    </table>

    @if(isset($CustomerPaymentByRefund))
      <table> 
        <tr>
          <td><strong>Due Payment</strong></td>
          <td>: {{ round($CustomerPaymentByRefund,2) }}</td>
        </tr>
      </table>

      <table> 
        <tr>
          <td><strong>Change</strong></td>
          <td>: {{ round($totalPrice-$CustomerPaymentByRefund,2) }}</td>
        </tr>
      </table>     
    @endif

    <hr>

    <p style="text-transform: capitalize;"><strong>In Words:</strong> {{ $InWords }}  Taka Only</p>

    <hr>
    
    @if ($cusname != 'Anonymous')
      <table>
        <tr>
          <td>Customer</td>
          <td>: {{ $cusname }}</td>
        </tr>
      </table>
      <hr>
    @endif

    Have a nice Day ! | <span class="UserName">{{ $User->name }}</span>

    <hr>

    @if(isset($Invoice))
      <table>
        <tr>
          <td>Invoice #</td>
          <td><h1>{{ $Invoice->InvoiceID }}</h1></td>
        </tr>
      </table>

      <hr>
    @endif
    

    <div class="company-info">
      Powered by : <span class="TechLab">{{ AuthorName() }} </span>  <!-- <span class="LabPOS">{{ AppName() }} </span> {{ AppVersion() }} |  <--><br>
      To Buy Software : 01614 777 555
    </div>

    <hr>    
  </div>
</body>
</html>