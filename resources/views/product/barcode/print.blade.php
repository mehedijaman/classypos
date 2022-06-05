<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>{{ AppName() }} | Product Barcode</title>
  {{ Html::style('/plugins/bootstrap/dist/css/bootstrap.min.css', array('media'=> 'all')) }}

  <!-- Font Awesome -->
  {{ Html::style('/plugins/font-awesome/css/font-awesome.min.css') }}

  <!-- Theme style -->
  {{ Html::style('/dist/css/AdminLTE.min.css', array('media' => 'all')) }}
  
  <!-- Barcode CSS -->
  <style media="all">
    body
    {
      font-size: 1.3em;
    }

    .page
    {
      position: relative;
      margin-top: 0px;
    }

    .second
    {    
      position: absolute;
      top:0%;
      left:20%; 
    } 

    .third
    {
      position: absolute;
      top:0%;
      left:40%;
      padding:1px;
    }

    .fourth
    {
      position: absolute;
      top:0%;
      left:60%;
      padding:1px;
    }

    .fifth
    {
      position: absolute;
      top:0%;
      left:80%;
      padding:1px;
    }

    /*.sixth
    {
      position: absolute;
      top:0%;
      left:96%;
      padding:1px;    
    }*/
  </style>

  <style media="print">
    .PrintBtn, .btn{
      display: none;
    }
    
  </style>
</head>

<body onload="window.print()"> 

  
 
  <?php
    $totalpage = $totalquantity/55;
    $totalpage = intval($totalpage);
    $total = 0;
  ?>

  @for($m=0;$m<=$totalpage;$m++)   
    <div class="page">
      <div class="first">
        <table>
          @for($i = $total,$j = 1; $i < $totalquantity && $j <= 11; $i++, $j++)
            <tr>        
              <td>
                <?php $barcodevalue = $megaproductid[$i]."S".$ShopID ?>
                {{ $megashopname[$i] }} <br>
                {{ $megaproductname[$i] }}-{{$megavendorid[$i]}} <br>
                <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($barcodevalue, 'C128')}}" alt="barcode" width=120px height=20px /> <br>
                {{ $barcodevalue }} <br>
                Price: BDT {{ round($megaproductsaleprice[$i],2) }} 
              </td>
            </tr>          
            <?php $total = $total + 1; ?>
          @endfor        
        </table>
      </div>
      <div class="second">
        <table>
          @for($i = $total,$j = 1; $i < $totalquantity && $j <= 11; $i++, $j++)
            <tr>        
              <td>
                <?php $barcodevalue = $megaproductid[$i]."S".$ShopID ?>

                {{ $megashopname[$i] }} <br>

                {{ $megaproductname[$i] }}-{{$megavendorid[$i]}} <br>

                <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($barcodevalue, 'C128')}}" alt="barcode" width=120px height=20px /> <br>

                {{ $barcodevalue }} <br>

                Price: BDT {{ round($megaproductsaleprice[$i],2) }} 
              </td>
            </tr>          
            <?php $total = $total + 1; ?>
          @endfor        
        </table>
      </div>

      <div class="third">
        <table>
          @for($i = $total,$j = 1; $i < $totalquantity && $j <= 11; $i++, $j++)
            <tr>        
              <td>
                <?php $barcodevalue = $megaproductid[$i]."S".$ShopID ?>

                {{ $megashopname[$i] }} <br>

                {{ $megaproductname[$i] }}-{{$megavendorid[$i]}} <br>

                <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($barcodevalue, 'C128')}}" alt="barcode" width=120px height=20px /> <br>

                {{ $barcodevalue }} <br>

                Price: BDT {{ round($megaproductsaleprice[$i],2) }} 
              </td>
            </tr>          
            <?php $total = $total + 1; ?>
          @endfor        
        </table>
      </div>

      <div class="fourth">
        <table>
          @for($i = $total,$j = 1; $i < $totalquantity && $j <= 11; $i++, $j++)
            <tr>        
              <td>
                <?php $barcodevalue = $megaproductid[$i]."S".$ShopID ?>

                {{ $megashopname[$i] }} <br>

                {{ $megaproductname[$i] }} -{{$megavendorid[$i]}} <br>

                <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($barcodevalue, 'C128')}}" alt="barcode" width=120px height=20px /> <br>

                {{ $barcodevalue }} <br>

                Price: BDT {{ round($megaproductsaleprice[$i],2) }} 
              </td>
            </tr>          
            <?php $total = $total + 1; ?>
          @endfor        
        </table>
      </div>

      <div class="fifth">
        <table>
          @for($i = $total,$j = 1; $i < $totalquantity && $j <= 11; $i++, $j++)
            <tr>        
              <td>
                <?php $barcodevalue = $megaproductid[$i]."S".$ShopID ?>

                {{ $megashopname[$i] }} <br>

                {{ $megaproductname[$i] }}-{{$megavendorid[$i]}} <br>

                <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($barcodevalue, 'C128')}}" alt="barcode" width=120px height=20px /> <br>

                {{ $barcodevalue }} <br>

                Price: BDT {{ round($megaproductsaleprice[$i],2) }} 
              </td>
            </tr>          
            <?php $total = $total + 1; ?>
          @endfor        
        </table>
      </div>

    </div>
  @endfor   
</body>
</html>



