@extends('layouts.admin')

@section('content')
  <!-- ======================= Content Wrapper ========================= -->
  <div class="content-wrapper">
    <!-- ======================= Content Header ========================= -->
    <section class="content-header">
      <h1>
        <i class="fa fa-list"></i> Purchase List
        <small>Product Purchase List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Product"><i class="fa fa-product-hunt"></i> Product</a></li>
        <li><a href="/Product/Purchase"><i class="fa fa-truck"></i> Purchase</a></li>
        <li>List</li>
      </ol>
    </section>
    <!-- ======================= / Content Header ========================= -->


    <!-- ======================= Main Content ========================= -->
    <section class="content">
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-header with-border">
          <button class="btn btn-flat bg-navy" data-toggle="modal" data-target="#NewPaymentMethod">Add New Payment Method</button>
        </div>
        <div class="box-body">
          <table id="PurchaseList" class="table table-reponsive table-stripped">
            <thead> 
              <th>Payment Method Name</th>
              <th>Action</th>
            </thead>
            
            @foreach ($MethodList as $List)
            <tr>
              <td>{{ $List->MethodName }}</td>
              <td>

              <button class="btn btn-flat bg-orange PaymentMethodEdit" type="button" name="PaymentMethodEdit[]"><i class="fa fa-pencil-square-o"></i></button>

              <input type="hidden" name="PaymentMethodID[]" class="PaymentMethodID" value="{{$List->ID}}">
              <input type="hidden" name="PaymentMethodName[]" class="PaymentMethodName" value="{{$List->MethodName}}">
                                
              </td>
            </tr>
            @endforeach
          </table>

          <!-- =================== New Payment Method  Modal ===================-->
          <div class="modal" id="NewPaymentMethod" role="dialog">
            <div class="modal-dialog">
              <!-- =================== Modal content =================== -->
                <div class="modal-content">

                  <div class="modal-header">
                    <h1 class="modal-title text-center">
                      <p class="label label-primary">Add Payment method</p>
                    </h1>
                  </div>

                  <div class="modal-body">
                    {{ Form::open(array('url' => '/PaymentMethod/New', 'class' => 'form-horizontal' )) }}

                      <div class="input-group">
                        <input type="text" id="MethodName" class="form-control" id="inputSuccess" placeholder="Method Name" name="MethodName">

                        <span class="input-group-btn">
                          {{ Form::submit('Add New Method', array('class'=>'btn bg-navy btn-flat','name'=>'submit')) }}
                        </span>               
                      </div>

                    {{ Form::close() }}
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn bg-maroon btn-flat" data-dismiss="modal">Cancel</button>
                  </div>
                </div>
            </div>
          </div>
          <!-- =================== New Payment Method Modal ===================-->


          <!-- =================== Payment Method Edit Modal ===================-->
          <div class="modal" id="EditPaymentMethodModal" role="dialog">
            <div class="modal-dialog">
              <!-- =================== Modal content =================== -->
                <div class="modal-content">

                  <div class="modal-header">
                    <h1 class="modal-title text-center">
                      <p class="label label-primary">Edit Payment Method</p>
                    </h1>
                  </div>

                  <div class="modal-body">
                    {{ Form::open(array('url' => '/PaymentMethod/Update', 'class' => 'form-horizontal')) }}

                      <div class="input-group">
                        <input type="text" id="EditMethodName" class="form-control" placeholder="Method Name" name="MethodName">
                        <input type="hidden" id="EditMethodID" class="form-control" placeholder="Method ID" name="MethodID">

                        <span class="input-group-btn">
                          {{ Form::submit('Update', array('class'=>'btn bg-navy btn-flat','name'=>'submit')) }}
                        </span>               
                      </div>

                    {{ Form::close() }}
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn bg-maroon btn-flat" data-dismiss="modal">Cancel</button>
                  </div>
                </div>
            </div>
          </div>
          <!-- =================== Payment Method Edit Modal ===================-->

          <script>
            $(document).ready(function(){
              $('#PurchaseList').dataTable();
            });

            
            $('.PaymentMethodEdit').on('click',function()
            {
              var Index=$('[name="PaymentMethodEdit[]"]').index(this);
              var ID=$('input[name="PaymentMethodID[]"]').eq(Index).val();
              var Name=$('input[name="PaymentMethodName[]"]').eq(Index).val();
              //alert(ID);
              $('#EditMethodName').val(Name);
              $('#EditMethodID').val(ID);
              $('#EditPaymentMethodModal').modal('show');             

            });

            /*function EditMethod(MethodID){
              $.get('/PaymentMethod/Edit/' + MethodID, function(Data){
                // $('#MethodName').innerHTML = Data[0][MethodName];
                var Data = JSON.parase(Data);
                alert(Data[0].ID);
              });
            }*/
          </script>
        </div>
      </div>
    </section>
    <!-- ======================= / Main Content ========================= -->

  </div>
  <!-- ======================= / Content Wrapper ========================= -->
@endsection