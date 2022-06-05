<!DOCTYPE html>
<html>
<head>
  <title>Purchase Invoice#</title>
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
<body onload="WindowPrint()" >









<div class="top">

{{$vid}}
</div>



<script type="text/javascript">


//onload="window.print();"
  
var today = new Date();
document.getElementById('demo').append(' '+today);



</script>

<table id="tt" width="297px" >


<tr id="sas">

<th>ProductID</th>

<th>Qty</th>

<th>Unit Price</th>
<th>Sub Total</th>



</tr>





@for($i=0;$i<$tata;$i++)
<tr>

<td>{{$productid[$i]}}</td>
<td>{{$quantity[$i]}}</td>

<td>{{$unitprice[$i]}}</td>

<td>{{$subtotal[$i]}}</td>







</tr>




@endfor


</table>

















<div class="company-info">
    <span class="LabPOS">{{ AppName() }} </span> {{ AppVersion() }} | <span class="TechLab">{{ AuthorName() }}</span>
  </div>









</body>
</html>