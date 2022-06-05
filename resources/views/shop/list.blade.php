@extends('layouts.admin')

@section('content')

<style>
  input[type=checkbox]
  {
    width:20px;
    height:20px;
  }



</style>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Shop List
        <small>All Shops List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Shop">Shop</a></li>
        <li><a href="/Shop/New">New</a></li>
        <li class="active">List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-info">
        <div class="box-header">
        </div>
        <!-- /.box-header -->

        <div class="box-body">
          <table id="ShopList" class="table table-bordered table-striped dataTable">
            <thead>
              <tr>
                <th> ShopName</th>
                <th> Shop Address</th>
                <th> Phone</th>
                <th> Email</th>
                <th> Action</th>
              </tr>
            </thead>

            <tbody> 
              @foreach($ShopList as $Shop)
              <tr>  
                <td>{{ $Shop->ShopName }}</td>
                <td>{{ $Shop->ShopAddress }}</td> 
                <td>{{ $Shop->Phone }}</td> 
                <td>{{ $Shop->Email }}</td> 
                <td>
                <input type="hidden" name="ShopNameforSettings[]" value="{{$Shop->ShopName}}">
                  <div class="btn-group">
                  <a href="/Shop/Details/{{ $Shop->ShopID }}" title="Details" class="btn btn-info btn-flat"><i class="fa fa-info "></i> </a>

                  <a title="Edit" href="/Shop/Edit/{{ $Shop->ShopID }}" class="btn btn-flat bg-orange"><i class="fa fa-pencil-square-o "></i></a>

                  <a title=" Category Mapping" href="/Shop/Category/Mapping/{{ $Shop->ShopID }}" class="btn btn-flat bg-olive"><i class="fa fa-share"></i></a>
                  <a title="Product Mapping" href="/Shop/Product/Mapping/{{ $Shop->ShopID }}" class="btn btn-flat bg-maroon"><i class="fa fa-cart-plus"></i></a>
                  <input type="hidden" name="ShopIDforSettings[]" value="{{$Shop->ShopID}}">
                  <button title="Shop Settings" name="ShopSettings[]" class="btn btn-flat btn-primary ShopSettings"><i class="fa fa-cog"></i></button>
                  </div>
                </td>         
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>        
      </div>
    </section>
  </div>
  <!-- /.content -->
  <script>
    $(document).ready(function(){
      $('#ShopList').DataTable();

      
    });

    $('.ShopSettings').on('click',function()
    {
      var index=$('[name="ShopSettings[]"]').index(this);
      var ID=$('[name="ShopIDforSettings[]"]').eq(index).val();
      var Name=$('[name="ShopNameforSettings[]"]').eq(index).val();
      $('#ShopName').empty();
      $('#ShopName').append('<p class="label label-success">'+Name+'</p>');
      //alert(Name);

      $.get('/Shop/Setting/List/'+ID,function(data)
      {

        if(data=="NoSetting")
        {
          var Restaurant           =0;
          var ServiceCharge        =0;
          var ServiceChargeValue   =0;
          var Order                =0;
          var Tips                 =0;
          var Tax                  =0;
          var Hold                 =0;
          var Advance              =0;
        //alert(Advance);
          var BarCode              =0;
          var Refund               =0;
          var Discount             =0;
          var InvoiceSize          ="Mini";

        }
        else
        {
          var Settings          =JSON.parse(data);
          var Restaurant        =Settings.IsRestaurant;
          var ServiceCharge     =Settings.IsServiceCharge;
          var ServiceChargeValue=Settings.ServiceCharge;
          var Order             =Settings.IsOrder;
          var Tips              =Settings.IsTips;
          var Tax               =Settings.IsTax;
          var Hold              =Settings.IsHold;
          var Advance           =Settings.IsAdvance;
          var BarCode           =Settings.IsBarcode;
          var Refund            =Settings.IsRefund;
          var Discount          =Settings.IsDiscount;
          var InvoiceSize       =Settings.InvoiceSize;

        }
        
        

        $('#ShopSettingsBody').empty();
        if(Restaurant==0)
        $('#ShopSettingsBody').append('<tr><td>Restaurant</td> <input type="hidden" id="text" name="checking[]" class="checking" value="0"><td><select class="form-control ShopSettingCheck" name="ShopSettingCheck[]"><option value="1">Enable</option><option value="0" selected>Disable</option></select></td></tr>');

        else
          $('#ShopSettingsBody').append('<tr><td>Restaurant</td><input type="hidden" id="text" name="checking[]" class="checking" value="0"><td><select class="form-control ShopSettingCheck" name="ShopSettingCheck[]"><option value="1" selected>Enable</option><option value="0">Disable</option></select></td></tr>');

        if(ServiceCharge==0)

        $('#ShopSettingsBody').append('<tr><td>ServiceCharge</td><input type="hidden" id="text" name="checking[]" class="checking" value="0"><td><select class="form-control ShopSettingCheck" name="ShopSettingCheck[]"><option value="1">Enable</option><option value="0" selected>Disable</option></select></td><td><input type="number" min="0" class="form-control" value="'+ServiceChargeValue+'" id="ServiceChargeValue"></td></tr>');

        else
          $('#ShopSettingsBody').append('<tr><td>ServiceCharge</td><input type="hidden" id="text" name="checking[]" class="checking" value="1"><td> <select class="form-control ShopSettingCheck" name="ShopSettingCheck[]"><option value="1" selected>Enable</option><option value="0">Disable</option></select></td><td><input type="number" min="0" value="'+ServiceChargeValue+'" class="form-control" id="ServiceChargeValue"></tr>');

        if(Tax==0)
        $('#ShopSettingsBody').append('<tr><td>Tax</td><input type="hidden" id="text" name="checking[]" class="checking" value=0><td> <select class="form-control ShopSettingCheck" name="ShopSettingCheck[]"><option value="1">Enable</option><option value="0" selected>Disable</option></select></td></tr>');
        else
          $('#ShopSettingsBody').append('<tr><td>Tax</td><input type="hidden" id="text" name="checking[]" class="checking" value="1"><td> <select class="form-control ShopSettingCheck" name="ShopSettingCheck[]"><option value="1" selected>Enable</option><option value="0">Disable</option></select></td></tr>');

        if(Order==0)
        $('#ShopSettingsBody').append('<tr><td>Order</td><input type="hidden" id="text" name="checking[]" class="checking" value="0"><td> <select class="form-control ShopSettingCheck" name="ShopSettingCheck[]"><option value="1">Enable</option><option value="0" selected>Disable</option></select></td></tr>');

        else
        $('#ShopSettingsBody').append('<tr><td>Order</td><input type="hidden" id="text" name="checking[]" class="checking" value="1"><td> <select class="form-control ShopSettingCheck" name="ShopSettingCheck[]"><option value="1" selected>Enable</option><option value="0">Disable</option></select></td></tr>');

        if(Hold==0)       

        $('#ShopSettingsBody').append('<tr><td>Hold</td><input type="hidden" id="text" name="checking[]" class="checking" value="0"><td> <select class="form-control ShopSettingCheck" name="ShopSettingCheck[]"><option value="1">Enable</option><option value="0" selected>Disable</option></select></td></tr>');
        else
        $('#ShopSettingsBody').append('<tr><td>Hold</td><input type="hidden" id="text" name="checking[]" class="checking" value="1"><td> <select class="form-control ShopSettingCheck" name="ShopSettingCheck[]">><option value="1" selected>Enable</option><option value="0" >Disable</option></select></td></tr>');

        if(Tips==0)        
        $('#ShopSettingsBody').append('<tr><td>Tips</td><input type="hidden" id="text" name="checking[]" class="checking" value="0"><td><select class="form-control ShopSettingCheck" name="ShopSettingCheck[]"><option value="1">Enable</option><option value="0" selected>Disable</option></select></td></tr>');

        else
        $('#ShopSettingsBody').append('<tr><td>Tips</td><input type="hidden" id="text" name="checking[]" class="checking" value="1"><td><select class="form-control ShopSettingCheck" name="ShopSettingCheck[]"><option value="1" selected>Enable</option><option value="0">Disable</option></select></td></tr>');


        if(Advance==0)
        $('#ShopSettingsBody').append('<tr><td>Advance</td><input type="hidden" id="text" name="checking[]" class="checking" value="0"><td><select class="form-control ShopSettingCheck" name="ShopSettingCheck[]"><option value="1">Enable</option><option value="0" selected>Disable</option></select></td></tr>');
        else
        $('#ShopSettingsBody').append('<tr><td>Advance</td><input type="hidden" id="text" name="checking[]" class="checking" value="1"><td><select class="form-control ShopSettingCheck" name="ShopSettingCheck[]"><option value="1" selected>Enable</option><option value="0">Disable</option></select></td></tr>');

        if(BarCode==0)
        $('#ShopSettingsBody').append('<tr><td>BarCode</td><input type="hidden" id="text" name="checking[]" class="checking" value="0"><td><select class="form-control ShopSettingCheck" name="ShopSettingCheck[]"><option value="1">Enable</option><option value="0" selected>Disable</option></select></td></tr>');
        else
        $('#ShopSettingsBody').append('<tr><td>BarCode</td><input type="hidden" id="text" name="checking[]" class="checking" value="1"><td><select class="form-control ShopSettingCheck" name="ShopSettingCheck[]"><option value="1" selected>Enable</option><option value="0">Disable</option></select></td></tr>');

      if(Refund==0)
        $('#ShopSettingsBody').append('<tr><td>Refund</td><input type="hidden" id="text" name="checking[]" class="checking" value="0"><td><select class="form-control ShopSettingCheck" name="ShopSettingCheck[]"><option value="1">Enable</option><option value="0" selected>Disable</option></select></td></tr>');
        else
        $('#ShopSettingsBody').append('<tr><td>Refund</td><input type="hidden" id="text" name="checking[]" class="checking" value="1"><td><select class="form-control ShopSettingCheck" name="ShopSettingCheck[]"><option value="1" selected>Enable</option><option value="0">Disable</option></select></td></tr>');

      if(Discount==0)
        $('#ShopSettingsBody').append('<tr><td>Discount</td><input type="hidden" id="text" name="checking[]" class="checking" value="0"><td><select class="form-control ShopSettingCheck" name="ShopSettingCheck[]"><option value="1">Enable</option><option value="0" selected>Disable</option></select></td></tr>');
        else
        $('#ShopSettingsBody').append('<tr><td>Discount</td><input type="hidden" id="text" name="checking[]" class="checking" value="1"><td><select class="form-control ShopSettingCheck" name="ShopSettingCheck[]"><option value="1" selected>Enable</option><option value="0">Disable</option></select></td></tr>');

        if(InvoiceSize=="Mini")
        $('#ShopSettingsBody').append('<tr><td>Invoice Format</td><td><select class="form-control ShopSettingCheck" name="ShopSettingCheck[]"><option value="Mini" selected>Mini</option><option value="A4">A4</option><option value="A5">A5</option></select></td></tr>');


      if(InvoiceSize=="A4")
        $('#ShopSettingsBody').append('<tr><td>Invoice Format</td><td><select class="form-control ShopSettingCheck" name="ShopSettingCheck[]"><option value="Mini">Mini</option><option value="A4" selected>A4</option><option value="A5">A5</option></select></td></tr>');

      if(InvoiceSize=="A5")
        $('#ShopSettingsBody').append('<tr><td>Invoice Format</td><td><select class="form-control ShopSettingCheck" name="ShopSettingCheck[]"><option value="Mini" selected>Mini</option><option value="A4">A4</option><option value="A5" selected>A5</option></select></td></tr>');


      if(ServiceCharge==0)
        $('#ServiceChargeValue').hide();
        $('#ShopSettingsModal').modal('show');

        $('#ServiceChargeValue').on('click keyup',function(e)
        {
          e.preventDefault();
          var Index=1;
          var ShopID=ID;
          var ServiceCharge=$('#ServiceChargeValue').val();
          var Value=1;
          $.get('/Shop/Setting/Update/'+ShopID+'/'+Index+'/'+Value+"/"+ServiceCharge,function(data)
          {
            //alert(data);

          });

        });


        $('.ShopSettingCheck').on('change',function()
        {
          var Index=$('[name="ShopSettingCheck[]"]').index(this);
          var Value=$('[name="ShopSettingCheck[]"]').eq(Index).val();
          if(Index==1)
          {
            if(Value==1)
            {
              $('#ServiceChargeValue').show();
            }
            if(Value==0)
            {
              $('#ServiceChargeValue').hide();
              //$('#ServiceChargeValue').val(0);
            }

          }

          var ShopID=ID;
          var ServiceCharge=$('#ServiceChargeValue').val();
          //alert(Index);
          //alert(Value);
          //alert(ShopID);

          //ShopSettingUpdate(ShopID,Index,Value);

          $.get('/Shop/Setting/Update/'+ShopID+'/'+Index+'/'+Value+"/"+ServiceCharge,function(data)
          {
            //alert(data);

          });

          //alert(Index);
          //alert(Value);

        });

        $('#ConfirmSettings').click(function(e)
        {
          e.preventDefault();
          $('#ShopSettingsModal').modal('hide');


        });





       /* $('.checkbox').click(function()

        {
            $(".checkbox").each(function(i)            
            {
              if(this.checked)
                {
                  $('input[name="checking[]"]').eq(i).val(1);               
                }


            if(!this.checked)
            {
              $('input[name="checking[]"]').eq(i).val(0);

              //alert($('input[name="checking[]"]').eq(i).val());               
            }



            });
        });*/
        

      });

     


    });


  </script>


  <!-- =============== ShopSetting Modal ====================== -->
      <div class="modal" id="ShopSettingsModal" role="dialog">
        <div class="modal-dialog ">

          <!--=============== Modal content ===============-->
          <div class="col-md-12  col-sm-12  col-xs-12  col-lg-12 ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h1 class="modal-title text-center">
                  <p class="label label-primary"><i class="fa fa-hand-stop-o"></i> Shop Settings</p>
                  <p id="ShopName"></p>
                </h1>
              </div>

              <div class="modal-body">
                <form id="SaleHoldForm">
                  <table id="BankList" class="table table-bordered table-striped dataTable">
                    <thead>
                      <tr>
                        <th>Settings Name</th>
                        <th>Select</th>
                        
                      </tr>         
                    </thead>
                    <tbody id="ShopSettingsBody">
                      @for($i=0;$i<$TotalCategory;$i++)

                        <?php    $k=0;             ?>

                        @for($j=0;$j<$TotalRole;$j++)
                          
                          @if($RoleID[$i]==$SingleUserRole[$j])

                          <?php   $k=1;    ?>

                          @endif
                        @endfor
                        
                        <tr>
                        <td>

                        @if($k==1)
                          <input type="checkbox" name="checkbox[]" class="checkbox" checked>
                          <input type="hidden" id="text" name="checking[]" class="checking" value="1" ">
                        @else
                          <input type="checkbox" name="checkbox[]" class="checkbox">
                          <input type="hidden" id="text" name="checking[]" class="checking" value="0" ">

                        @endif
                        </td>
                        <td>
                        <input type="text"  name="RoleID[]" class="RoleID" value="{{$RoleID[$i]}}" style="background: transparent;border:0px;">


                        </td>
                          <td><input type="hidden" name="RoleRouteName[]" class="RoleRouteName" style="background: transparent; border:0px;" value="{{$RoleRouteName[$i]}}" readonly>
                          {{$RoleRouteName[$i]}}
                          </td>

                          <td><input type="hidden" name="RoleCategoryName[]" class="RoleCategoryName" style="background: transparent; border:0px;" value="{{$RoleCategoryName[$i]}}" readonly>{{$RoleCategoryName[$i]}}</td>                  
                        </tr>
                      @endfor
                    </tbody>

                  </table>

                  <button type="submit" class="btn bg-purple btn-flat btn-lg btn-block" id="ConfirmSettings" value="Confirm Settings"><i class="fa fa-paper-plane"></i> <br><strong>Shop Settings</strong></button>
                </form>
              </div>
                

              <!-- <div class="modal-footer">                
                <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Cancel</button>
              </div> -->
            </div>
          </div>
          <!--=============== / Modal content ===============-->
        </div>
      </div>


@endsection





