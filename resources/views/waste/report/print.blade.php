<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Product Report</title>
  {{ Html::style('bootstrap/css/bootstrap.min.css') }}

  <!-- Theme style -->
  {{ Html::style('dist/css/AdminLTE.min.css') }}

  <!-- Report CSS -->
  {{ Html::style('css/report.css', array('media' => 'print')) }}
</head>
<body >

      <h3 align="center">
        <button class="btn btn-flat bg-olive" onclick="window.print()" ">Print</button> <br>
       
        <strong>{{$ReportName}}</strong>

        <br>
        
        <small>Shop Name :<strong> {{ $ShopName }} </strong>  <br>
       
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
          <th> Product ID    </th>
          <th> Product Name </th>
          <th> Shop Name </th>
          <th> Qty</th>
          <th> Unit Cost</th>
          <th> Total Cost </th>
          <th> Wasted By </th>
          <th> Note </th>
          <th> Date</th>
          
        </thead>
        <tbody>
          @foreach($Report as $Report)
            <tr>
              <td>{{ $Report->ProductID}}</td>          
              <td>{{ $Report->ProductName}}</td>    
              <td>
                @if($Report->ShopName)
                  {{ $Report->ShopName }}
                @else
                  Main Stock
                @endif
              </td>    
              <td>{{ $Report->Qty }}</td>     
              <td>{{ $Report->UnitCost }}</td>     
              <td>{{ $Report->TotalPrice }}</td>     
              <td>{{ $Report->WastedBy }}</td>     
              <td>{{ $Report->Note }}</td>     
              <td>{{ date('d/m/Y h:i A', strtotime($Report->created_at)) }}</td>     
            </tr>
          @endforeach
        </tbody>            
      </table>

      <div class="footer">
        &copy; {{ date('Y') }}<strong> {{ AuthorName() }}</strong> . All rights reserved.
      </div>
    </div>
</body>
</html>