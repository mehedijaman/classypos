<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Drawer Report</title>
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
        
        <small>
       
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
          <th> Shop Name </th>
          <th> User Name </th>
          <th> Opening Balance </th>
          <th> Closing Balance </th>
          <th> Status </th>
          <th> Opening Time </th>
          <th> Closing Time </th>
          
        </thead>
        <tbody>
          @foreach($Report as $Report)
            <tr>
              <td> {{ $Report->ShopName}}</td>
              <td> {{ $Report->FirstName." ". $Report->LastName }}</td>
              <td> {{ round($Report->OpeningBalance,2) }}</td>
              <td> 
                @if ($Report->ClosingBalance)
                {{ round($Report->ClosingBalance,2) }}
                @endif
              </td>
              <td> 
                @if($Report->IsClosed == 0)
                  Open
                @else
                  Closed
                @endif
              </td>
              <td> {{ date('d/m/Y h:i A', strtotime($Report->created_at)) }} </td>
              <td> {{ date('d/m/Y h:i A', strtotime($Report->updated_at)) }} </td>
                
              </td>
          @endforeach
        </tbody>            
      </table>

      <div class="footer">
        &copy; {{ date('Y') }}<strong> {{ AuthorName() }}</strong> . All rights reserved.
      </div>
    </div>
</body>
</html>