<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Inventory Report</title>
  {{ Html::style('bootstrap/css/bootstrap.min.css') }}

  <!-- Theme style -->
  {{ Html::style('dist/css/AdminLTE.min.css') }}
</head>
<body >
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 align="center">Inventory Report : {{ $ShopName }}<br> <small>Print Time : {{ date('d-m-Y h:i A') }}</small></h3>
    </div>
    <div class="box-body">
      <table class="table table-responsive table-bordered">
        <tr>
          <td>ID</td>
          <td>Category</td>
          <td>Vendor</td>
          <td>Product</td>
          <td>Cost</td>
          <td>Sale</td>
          <td>Soft Qty</td>
          <td>Hard Qty</td>
          <td>Remark</td>
          <td>Checket at</td>
        </tr> 
        @foreach ($Report as $Data)
          <tr>
            <td>{{ $Data->ProductID }}</td>
            <td>{{ $Data->CategoryName }}</td>
            <td>{{ $Data->VendorName }}</td>
            <td>{{ $Data->ProductName }}</td>
            <td>{{ $Data->CostPrice }}</td>
            <td>{{ $Data->SalePrice }}</td>
            <td>{{ $Data->SoftQty }}</td>
            <td>{{ $Data->HardQty }}</td>
            <td>{{ $Data->Remark }}</td>
            <td>{{ date('d-m-Y h:i A', strtotime($Data->created_at)) }}</td>
          </tr> 
        @endforeach        
      </table>
    </div>

  </div>  
</body>
</html>