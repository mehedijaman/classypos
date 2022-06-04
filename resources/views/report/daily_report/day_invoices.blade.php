<!DOCTYPE html>
<html>
<head>
    <title>Day Invoices</title>

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
  <h3>Invoices</h3>

  <hr>

  <table>
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
  </table> 
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