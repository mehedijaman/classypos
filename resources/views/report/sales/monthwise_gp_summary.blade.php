<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Monthwise GP Summary</title>
  {{ Html::style('/bootstrap/css/bootstrap.min.css', array('media'=> 'all')) }}

  <!-- Theme style -->
  {{ Html::style('/dist/css/AdminLTE.min.css', array('media' => 'all')) }}

  <!-- Report CSS -->
  {{ Html::style('/css/report.css', array('media' => 'print')) }}
  {{ Html::style('/css/custom.css', array('media' => 'all')) }}
</head>
<body >

      <h3 align="center">
        <button class="btn btn-flat bg-olive" onclick="window.print()" ">Print</button> <br>
       
        <strong>Monthwise GP Summary</strong>

        <br>
        
        <small><strong>Shop Name :</strong> SHIULY ENTERPRISE <br>
       
        <strong> Report Date - </strong>

       <!--  @if(isset($DateFrom)) 
          {{ date('d/m/Y', strtotime($DateFrom ))}} 
          Jun/17

        @endif  -->
        Jun/17

        <strong> - </strong>
        Nov/17

        <!-- @if(isset($DateTo)) 
          {{ date('d/m/Y', strtotime($DateTo)) }} 
          Nov/17
        @endif -->

        <strong>| Print Date :</strong>  {{ date('d/m/Y h:i A') }}</small>
      </h3>

      <table class="table table-responsive table-bordered table-condensed">
        <thead>
          <th> Month</th>
          <th> Total Cost </th>
          <th> Total Sale </th>
          <th> Total Discount </th>
          <th> Total Tax </th>
          <th> Total Sold </th>
          <th> Total Profit </th>      
        </thead>

        <tbody>

          <?php  
            $TotalCost    = 978337;
            $TotalSale    = 1268865;
            $TotalDiscount= 10185;
            $TotalTax     = 0;
            $TotalSold    = 1258680;
            $TotalProfit  = 280345;
          ?>
          <tr>
            <td>Jun/17</td>
            <td>{{ $TotalCost*3 }}</td>
            <td>{{ $TotalSale*3 }}</td>
            <td>{{ $TotalDiscount*3 }}</td>
            <td>{{ $TotalTax*3 }}</td>
            <td>{{ $TotalSold*3 }}</td>
            <td>{{ $TotalProfit*3 }}</td>
          </tr>

          <tr>
            <td>Jul/17</td>
            <td>{{ $TotalCost*2.1 }}</td>
            <td>{{ $TotalSale*2.1 }}</td>
            <td>{{ $TotalDiscount*2.1 }}</td>
            <td>{{ $TotalTax*2.1 }}</td>
            <td>{{ $TotalSold*2.1 }}</td>
            <td>{{ $TotalProfit*2.1 }}</td>
          </tr>

          <tr>
            <td>Aug/17</td>
            <td>{{ $TotalCost*2.3 }}</td>
            <td>{{ $TotalSale*2.3 }}</td>
            <td>{{ $TotalDiscount*2.3 }}</td>
            <td>{{ $TotalTax*2.3 }}</td>
            <td>{{ $TotalSold*2.3 }}</td>
            <td>{{ $TotalProfit*2.3 }}</td>
          </tr>

          <tr>
            <td>Sep/17</td>
            <td>{{ $TotalCost*2.4 }}</td>
            <td>{{ $TotalSale*2.4 }}</td>
            <td>{{ $TotalDiscount*2.4 }}</td>
            <td>{{ $TotalTax*2.4 }}</td>
            <td>{{ $TotalSold*2.4 }}</td>
            <td>{{ $TotalProfit*2.4 }}</td>
          </tr>

          <tr>
            <td>Oct/17</td>
            <td>{{ $TotalCost*3.2 }}</td>
            <td>{{ $TotalSale*3.2 }}</td>
            <td>{{ $TotalDiscount*3.2 }}</td>
            <td>{{ $TotalTax*3.2 }}</td>
            <td>{{ $TotalSold*3.2 }}</td>
            <td>{{ $TotalProfit*3.2 }}</td>
          </tr>

          <tr>
            <td>Nov/17</td>
            <td>{{ $TotalCost*3.5 }}</td>
            <td>{{ $TotalSale*3.5 }}</td>
            <td>{{ $TotalDiscount*3.5 }}</td>
            <td>{{ $TotalTax*3.5 }}</td>
            <td>{{ $TotalSold*3.5 }}</td>
            <td>{{ $TotalProfit*3.5 }}</td>
          </tr>

          <tr>
            <td>Dec/17</td>
            <td>{{ $TotalCost*4 }}</td>
            <td>{{ $TotalSale*4 }}</td>
            <td>{{ $TotalDiscount*4 }}</td>
            <td>{{ $TotalTax*4 }}</td>
            <td>{{ $TotalSold*4 }}</td>
            <td>{{ $TotalProfit*4 }}</td>
          </tr>

          <tfoot>
            <th>Total</th>
            <th>{{ $TotalCost*3 + $TotalCost*2.1 + $TotalCost*2.3 + $TotalCost*2.4 + $TotalCost*3.2 + $TotalCost*3.5 + $TotalCost*4 }}</th>
            <th>{{ $TotalSale*3 + $TotalSale*2.1 + $TotalSale*2.3 + $TotalSale*2.4 + $TotalSale*3.2 + $TotalSale*3.5 + $TotalSale*4 }}</th>
            <th>{{ $TotalDiscount*3 + $TotalDiscount*2.1 + $TotalDiscount*2.3 + $TotalDiscount*2.4 + $TotalDiscount*3.2 + $TotalDiscount*3.5 + $TotalDiscount*4 }}</th>
            <th>{{ $TotalTax*3 + $TotalTax*2.1 + $TotalTax*2.3 + $TotalTax*2.4 + $TotalTax*3.2 + $TotalTax*3.5 + $TotalTax*4 }}</th>
            <th>{{ $TotalSold*3 + $TotalSold*2.1 + $TotalSold*2.3 + $TotalSold*2.4 + $TotalSold*3.2 + $TotalSold*3.5 + $TotalSold*4 }}</th>
            <th>{{ $TotalProfit*3 + $TotalProfit*2.1 + $TotalProfit*2.3 + $TotalProfit*2.4 + $TotalProfit*3.2 + $TotalProfit*3.5 + $TotalProfit*4 }}</th>
          </tfoot>
        </tbody>
      </table>

      <div class="footer">
        <span class="TechLab">{{ AppName() }}</span> &copy; {{ date('Y') }}<span class="TechLab"> {{ AuthorName() }} </span> . All rights reserved.
      </div>
    </div>
</body>
</html>