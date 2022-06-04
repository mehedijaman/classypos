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
        <strong>{{ $ReportName }}</strong>
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
          <th> User Name</th>
          <th> Shop Name </th>
          <th> Activity Details </th>
          <th> Activity Time   </th>
          
        </thead>
        <tbody>
          @foreach ($Report as $Report)
            <tr>
              <td>{{ $Report->FirstName." ".$Report->LastName }}</td>            
              <td>{{ $Report->ShopName }}</td>            
              <td>{{ $Report->ActivityName }}</td>            
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