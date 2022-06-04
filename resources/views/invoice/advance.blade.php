<!DOCTYPE html>
<html>
<head>
  <title>Advance Invoice # {{ $Invoice->ID }}</title>
  
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
    
    @media print {
      .page-1 {page-break-after: always;}
    }
  </style>
</head>

<body onload="WindowPrint()">

  <div class="wrapper">
    <div class="page-1">
      <h4 align="center"><i class="fa fa-hand-lizard-o fa-lg"></i> Advance Invoice</h4>

      <hr>
      
      @if($Shop->ShopLogo!="")
        <img src="/uploads/image/shop/{{$Shop->ShopLogo}}" width=70 height=70 class="img img-responsive">
      @endif
      
      <h4 align="center"> {{$Shop->ShopName}} </h4>

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

      <hr>    

      <table>   

        <tr>
          <td>Invoice Date</td>
          <td>: {{ date('d/m/Y | h:i A', strtotime($Invoice->created_at)) }}</td>
        </tr>

        <tr>
          <td>Print Date</td>
          <td>: {{ date('d/m/Y | h:i A') }}</td>
        </tr>      
      </table>

      <hr>    

      <table >
        <tr>
          <th># |</th>
          <th>Item/Description |</th>
          <th>Sub Total</th>
        </tr>
        @for($i=0; $i<$ItemQty; $i++) 
          <tr>
            <td>{{ $i+1 }}.</td>          
            <td>
              {{ $ProductName[$i] }} [{{$ProductID[$i]}}S{{$ShopID[$i]}}] <br> 
              [{{ round($Qty[$i],2) }} X {{ round($Price[$i],2) }}] <br> 
            </td>
            <td>{{ $Price[$i]*$Qty[$i] }}</td>
          <tr>
        @endfor

      </table>

      <hr>

      <table >

      <tr>
          <td>SubTotal</td>
          <td>: <strong>{{ round($SubTotal,2) }}</strong></td>
      </tr>
        <tr>
          <td>Discount</td>
          <td>: <strong>{{ round($TotalDiscount,2) }}</strong></td>
        </tr>

        <tr>
          <td>Tax</td>
          <td>: <strong>{{ round($TotalTax,2) }}</strong></td>
        </tr> 

           

        <tr>
          <td>Total</td>
          <td>: <strong>{{ round($TotalPrice,2) }}</strong></td>
        </tr>

        <tr>
          <td>Adv. Paid</td>
          <td>: <strong>{{ round($AdvancePaid,2) }}</strong></td>
        </tr>

        <tr>
          <td>Due</td>
          <td>: <strong>{{ round($Due, 2)}}</strong></td>
        </tr>
      </table>

      <hr>

      <p class="InWords" style="text-transform: capitalize;"><strong>In Words: {{ $InWords }}  Taka Only</strong></p>

      <hr>   
      
      <table>
        <tr>
          <td>Customer Name </td>
          <td> : {{ $CustomerName }}</td>
        </tr>

        <tr>
          <td>Phone </td>
          <td> : {{$Phone}}</td>
        </tr>

        <tr>
          <td>Address </td>
          <td> : {{$Address}}</td>
        </tr>  

         <tr>
          <td>Delivery Date</td>
          <td> : {{ date('d/m/Y', strtotime($Invoice->DeliveryDate)) }}</td>
        </tr>    
      </table>
      <hr>
      
      @if(isset($ShopFooter))
        <div class="InvoiceFooter">
          {!! $ShopFooter->Footer !!}
        </div>

        <hr>
      @endif
      
      Have a nice Day ! | <span class="UserName">{{ $User->name }}</span>

      <hr>

      <table class="InvoiceID">
        <tr>
          <td>Invoice #</td>
          <td><h2 >{{ $Invoice->ID }}</h2></td>
        </tr>
      </table>

      <hr>

      <div class="company-info">
        Powered by : <span class="TechLab">{{ AuthorName() }} </span>  <!-- <span class="LabPOS">{{ AppName() }} </span> {{ AppVersion() }} |  <--><br>
        To Buy Software : 01614 777 555
      </div>

      <hr>
    </div>

    <div class="page-2">
      <h4 align="center"><i class="fa fa-hand-lizard-o fa-lg"></i> Advance Invoice</h4>

      <hr>
      
      @if($Shop->ShopLogo!="")
        <img src="/uploads/image/shop/{{$Shop->ShopLogo}}" width=70 height=70 class="img img-responsive">
      @endif
      
      <h4 align="center"> {{$Shop->ShopName}} </h4>

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

      <hr>    

      <table>   

        <tr>
          <td>Invoice Date</td>
          <td>: {{ date('d/m/Y | h:i A', strtotime($Invoice->created_at)) }}</td>
        </tr>

        <tr>
          <td>Print Date</td>
          <td>: {{ date('d/m/Y | h:i A') }}</td>
        </tr>      
      </table>

      <hr>    

      <table >
        <tr>
          <th># |</th>
          <th>Item/Description |</th>
          <th>Sub Total</th>
        </tr>
        @for($i=0; $i<$ItemQty; $i++) 
          <tr>
            <td>{{ $i+1 }}.</td>          
            <td>
              {{ $ProductName[$i] }} [{{$ProductID[$i]}}S{{$ShopID[$i]}}] <br> 
              [{{ round($Qty[$i],2) }} X {{ round($Price[$i],2) }}] <br> 
            </td>
            <td>{{ $Price[$i]*$Qty[$i] }}</td>
          <tr>
        @endfor

      </table>

      <hr>


      <table >
        <tr>
          <td>Discount</td>
          <td>: <strong>{{ round($TotalDiscount,2) }}</strong></td>
        </tr>

        <tr>
          <td>Tax</td>
          <td>: <strong>{{ round($TotalTax,2) }}</strong></td>
        </tr>  

        <tr>
          <td>Total</td>
          <td>: <strong>{{ round($TotalPrice,2) }}</strong></td>
        </tr>

        <tr>
          <td>Adv. Paid</td>
          <td>: <strong>{{ round($AdvancePaid,2) }}</strong></td>
        </tr>

        <tr>
          <td>Due</td>
          <td>: <strong>{{ round($Due, 2)}}</strong></td>
        </tr>
      </table>

      <hr>

      <p class="InWords" style="text-transform: capitalize;"><strong>In Words: {{ $InWords }}  Taka Only</strong></p>

      <hr>   
      
      <table>
        <tr>
          <td>Customer Name </td>
          <td> : {{ $CustomerName }}</td>
        </tr>

        <tr>
          <td>Phone </td>
          <td> : {{$Phone}}</td>
        </tr>

        <tr>
          <td>Address </td>
          <td> : {{$Address}}</td>
        </tr>  

         <tr>
          <td>Delivery Date</td>
          <td> : {{ date('d/m/Y', strtotime($Invoice->DeliveryDate)) }}</td>
        </tr>    
      </table>
      <hr>
      
      @if(isset($ShopFooter))
        <div class="InvoiceFooter">
          {!! $ShopFooter->Footer !!}
        </div>

        <hr>
      @endif
      
      Have a nice Day ! | <span class="UserName">{{ $User->name }}</span>

      <hr>

      <table class="InvoiceID">
        <tr>
          <td>Invoice #</td>
          <td><h2 >{{ $Invoice->ID }}</h2></td>
        </tr>
      </table>

      <hr>

      <div class="company-info">
        Powered by : <span class="TechLab">{{ AuthorName() }} </span>  <!-- <span class="LabPOS">{{ AppName() }} </span> {{ AppVersion() }} |  <--><br>
        To Buy Software : 01614 777 555
      </div>

      <hr>
    </div>
    
  </div>
</body>
</html>