@include('layouts/header')

<script>
  function WindowPrint(){
    setTimeout(function () { window.print(); }, 0);
    window.onfocus = function () { setTimeout(function () { window.close(); }, 500); }
  }
</script>

<style>
  hr{
    margin-top: 5px;
    margin-bottom: 5px;
  }
  body, .content-wrapper, .KOTBody{
    margin: 0px;
    width: 295px;
  }
</style>

<body onload="WindowPrint()">
  <div class="KOTBody">
    @for($j=0;$j<count($RealKitchenID);$j++)
      <h4 align="center">
        {{$Shop->ShopName}} <br>
        <small>{{$RealKitchenName[$j]}}</small>
      </h4>
      <hr>

      <div class="row">
        <div class="content-wrapper">
          <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">   
            Order     
          </div>
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">   
            : <strong>{{ $TempOrderID }}</strong>    
          </div>
          <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">   
            Table     
          </div>
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">   
            @if($Order->Name!="")
              : <strong>{{ $Order->Name }}</strong>
            @endif
          </div>          
        </div>
      </div>

      <div class="row">
        <div class="content-wrapper">   
          <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">   
            Guest     
          </div>
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">   
            : @if(isset($Order->Guests)) {{ $Order->Guests }} @endif
          </div>       
          <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">   
            Waiter
          </div>
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">   
            : @if(isset($Order->FirstName)) {{ $Order->FirstName }}  @endif
          </div>
        </div>
      </div>

      <div class="row">
        <div class="content-wrapper">   
          <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">   
            Date     
          </div>
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">   
            @if(isset($Mapping))
              : {{ date('d/m/y', strtotime($Order->updated_at)) }}
            @endif

            @if(!isset($Mapping))
              : {{ date('d/m/y') }}
            @endif
          </div> 
          <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">   
            Time     
          </div>
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">   
            @if(isset($Mapping))
              : {{ date('h:i A', strtotime($Order->updated_at)) }}
            @endif

            @if(!isset($Mapping))
              : {{ date('h:i A') }}
            @endif
          </div> 
        </div>
      </div>

      <hr>
      <h4 align="center"><small>Items</small></h4>
      <hr> 

      @for($i=0;$i<$ItemQty;$i++)
        @if($KitchenID[$i]==$RealKitchenID[$j])
          @if($Qty[$i]>0)
            <div class="row">
              <div class="content-wrapper">
                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">{{ round($Qty[$i],2) }}</div>
                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10"> {{ $ProductName[$i] }}</div>
              </div>
            </div>
          @endif
        @endif
      @endfor

      <hr style="border:1px dotted black;"> 
    @endfor  

    @if($Order->Notes)      
      {{ $Order->Notes }}
    @endif      
  </div>   
</body>
</html>