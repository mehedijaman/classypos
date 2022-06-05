<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Product Report</title>
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
          <th> Inv.ID </th>
          <th> P.ID </th>
          <th> Product Name</th>
          <th> Category </th>
          <th> Vendor </th>
          <th> Shop </th>
          <th> Qty </th>
          <th> CP </th>
          <th> SP </th>
          <th> DP </th>
          <th> Dis </th>
          <th> Date </th>  
          <th> User </th> 
          <th> Reason</th>       
        </thead>

        <tbody>
          @foreach($Report as $Report)
            <tr>
              <td>{{ $Report->InvoiceID }}</td>
              <td>{{ $Report->ProductID }}S{{ $Report->ShopID }}</td>
              <td>{{ $Report->ProductName }}</td>
              <td>{{ $Report->CategoryName }}</td>
              <td>{{ $Report->VendorName }}</td>
              <td>{{ $Report->ShopName }}</td>
              <td>{{ round($Report->Qty,2) }}</td>
              <td>{{ round($Report->CostPrice * $Report->Qty,2) }}</td>
              <td>{{ round($Report->Price * $Report->Qty,2) }}</td>
              <td>{{ round($Report->TotalPrice,2) }}</td>
              <td>{{ round($Report->Discount * $Report->Qty,2) }}</td>
              <td>{{ date('d/m/y h:ia', strtotime($Report->created_at)) }}</td>
              <td>{{ $Report->FirstName }} </td>
              <td>{{ $Report->RefundReason }}</td>
            </tr>
          @endforeach
        </tbody>

        <tfoot>
          <tr>
            <th class="text-center" colspan="6">Total</th>
            <th>{{ $TotalQty }}</th>
            <th>{{ $TotalCostPrice }}</th>
            <th>{{ $TotalSalePrice }}</th>
            <th></th>
            <th>{{ $TotalDiscount }}</th>
            <th colspan="3"></th>
            
          </tr>
        </tfoot>
      </table>

      <div class="footer">
        <span class="TechLab">{{ AppName() }}</span> &copy; {{ date('Y') }}<span class="TechLab"> {{ AuthorName() }} </span> . All rights reserved.
      </div>
    </div>
</body>
</html>