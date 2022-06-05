<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Product Report</title>
  {{ Html::style('/bootstrap/css/bootstrap.min.css', array('media'=> 'all')) }}

  <!-- Theme style -->
  {{ Html::style('/dist/css/AdminLTE.min.css', array('media' => 'all')) }}

  <!-- Report CSS -->
  {{ Html::style('/css/report.css', array('media' => 'print')) }}
</head>
<body >

      <h3 align="center">
        <button class="btn btn-flat bg-olive" onclick="window.print()" ">Print</button> <br>
       
        <strong>{{$ReportName}}</strong>

        <br>
        
        <small><strong>Shop Name :</strong> {{ $ShopName }} <br>
       
        <strong> Report Date - </strong>

        @if(isset($DateFrom)) 
          {{ date('d/m/Y', strtotime($DateFrom ))}} 
        @endif 

        <strong> - </strong>

        @if(isset($DateTo)) 
          {{ date('d/m/Y', strtotime($DateTo)) }} 
        @endif

        <strong>| Print Date :</strong>  {{ date('d/m/Y h:i A') }}</small>
      </h3>

      <table class="table table-responsive table-bordered table-condensed">
        <thead>
          <th> ID    </th>
          <th> Product Name </th>
          <th> Category Name </th>
          <th> Vendor Name   </th>
          <th> CP</th>
          <th> SP</th>
          <th> Purchase </th>
          <th> Sale     </th>
          <th> Refund     </th>
          <th> Waste    </th>
          <th> Stock</th>          
        </thead>

        <tbody>
          @for($i=0;$i<$Total;$i++)
            <tr>
              <td>{{ round($TotalProductID[$i],2) }}</td>
              <td>{{ $TotalProductName[$i] }}</td>    
              <td>{{ $TotalCategoryName[$i] }} </td>    
              <td>{{ $TotalVendorName[$i] }}</td> 
              <td>{{ round($TotalCostPrice[$i],2) }}</td>   
              <td>{{ round($TotalSalePrice[$i],2) }}</td>  
              <td>{{ round($Purchase[$i],2) }}</td>   
              <td>{{ round($Sold[$i],2) }}</td>   
              <td>{{ round($Refunded[$i],2) }}</td>   
              <td>{{ round($Wasted[$i],2) }}</td>   
              <td>{{ round($TotalStock[$i],2) }}</td>             
            </tr>
          @endfor  
        </tbody>

        <tfoot>
          <th colspan="4" class="text-center"><strong>TOTAL</strong></th>
          <th><strong> {{ $TotalCostPriceValue }}</strong></th>
          <th><strong> {{ $TotalSalePriceValue }}</strong></th>
          <th><strong> {{ $TotalPurchasedQuantity }} </strong></th>
          <th><strong> {{ $TotalSoldQuantity }} </strong></th>
          <th><strong> {{ $TotalRefundedQuantity }} </strong></th>
          <th><strong> {{ $TotalWastedQuantity }} </strong></th>
          <th><strong> {{ $TotalStockQuantity }}</strong></th>
        </tfoot>            
      </table>

      <div class="footer">
        &copy; {{ date('Y') }}<strong> TechLab</strong> . All rights reserved.
      </div>
    </div>
</body>
</html>