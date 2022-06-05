<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>{{$ReportName}}</title>
  {{ Html::style('/bootstrap/css/bootstrap.min.css', array('media'=> 'all')) }}

  <!-- Theme style -->
  {{ Html::style('/dist/css/AdminLTE.min.css', array('media' => 'all')) }}

  <!-- Report CSS -->
  {{ Html::style('/css/custom.css', array('media' => 'all')) }}
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
          <th> Shop Name</th>
          <th> Total Cost </th>
          <th> Total Sale </th>
          <th> Total Discount </th>
          <th> Total Sold </th>
          <th> Total Tax </th>
          <th> Total Profit </th>      
        </thead>

        <tbody>
          @foreach($Report as $Report)          
            <tr>
              <td>{{ $Report->ShopName }} </td>
              <td>{{ round($Report->GrossTotalCost,2) }}</td>
              <td>{{ round($Report->GrossTotalSale,2) }}</td>
              <td>{{ round($Report->GrossTotalDiscount,2) }}</td>
              <td>{{ round($Report->GrossTotalSoldPrice,2) }}</td>
              <td>{{ round($Report->GrossTotalTax,2) }}</td>
              <td>{{ round($Report->GrossTotalProfitAmount,2) }}</td>
            </tr>
          @endforeach
        </tbody>

        <tfoot>
          <tr>
            <th class="text-center" >Total</th> 
            <th>{{ round($NetTotalCost,2) }}</th>
            <th>{{ round($NetTotalSale,2) }}</th>
            <th>{{ round($NetTotalDiscount,2) }}</th>
            <th>{{ round($NetTotalSoldPrice,2) }}</th>
            <th>{{ round($NetTotalTax,2) }}</th>
            <td>{{ round($NetTotalProfitAmount, 2)}}</td>
          </tr>
        </tfoot>
      </table>

      <div class="footer">
        <span class="TechLab">{{ AppName() }}</span> &copy; {{ date('Y') }}<span class="TechLab"> {{ AuthorName() }} </span> . All rights reserved.
      </div>
    </div>
</body>
</html>