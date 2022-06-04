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
          
        </div>
        <div class="box-body">
          <table id="PurchaseList" class="table table-reponsive table-stripped">
            <thead> 
              <th>Memo #</th>
              <th>Vendor</th>
              <th>TotalPrice</th>
              <th>CashPayment</th>
              <th>BankPayment</th>
              <th>Due</th>
              <th>Purchase Date</th>
              <th>Action</th>
            </thead>
            @foreach ($List as $Data)
            <tr>
              <td>{{ $Data->MemoID }}</td>
              <td>{{ $Data->VendorName }}</td>
              <td>{{ round($Data->TotalPrice,2) }}</td>
              <td>{{ round($Data->CashPayment,2) }}</td>
              <td>{{ round($Data->BankPayment,2) }}</td>
              <td>{{ round($Data->Due,2) }}</td>
              <td>{{ date('d/m/Y h:i A', strtotime($Data->created_at)) }}</td>
              <td>
                <a href="/Product/Purchase/Edit/{{ $Data->PurchaseInvoiceID }}" class="btn btn-flat bg-orange"><i class="fa fa-pencil-square-o"></i></a>

                <a href="/Product/Purchase/Delete/{{ $Data->PurchaseInvoiceID }}" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></a>
              </td>
            </tr>
            @endforeach
          </table>

          <script>
            $(document).ready(function(){
              $('#PurchaseList').dataTable();
            });
          </script>
        </div>
      </div>
    </section>
    <!-- ======================= / Main Content ========================= -->

  </div>
  <!-- ======================= / Content Wrapper ========================= -->
@endsection