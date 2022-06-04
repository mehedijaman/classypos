@extends('layouts.admin')

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Distribute
        <small>Distribute product to shops</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Product"><i class="fa fa-product-hunt"></i> Product</a></li>
        <li><a href="/Product/List"><i class="fa fa-list"></i> List</a></li>
        <li><a href="/Product/Distribute"><i class="fa fa-share"></i> Distribution</a></li>
        <li class="active">Distribute</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><strong>{{ $ProductName }}</strong> have <strong>{{$ProductQuantity}}</strong> in main stock </h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">

          {{ Form::open(array('url' => '/Product/Distribute/'.$id, 'class' => 'form-horizontal')) }}

            <table id="ShopList" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ShopName</th>
                  <th>Quantity</th>
                </tr>           
              </thead>

              <tbody> 
                @foreach($all as $data)
                  <tr>  
                    <td>{{$data->ShopName}}</td>
                    <td>
                      <input type="number" step=".0001" value="0" name="Quantity[]" class="form-control">
                      <input type="hidden" name="Identity[]" value="{{$data->ShopID}}">
                    </td> 
                  </tr>
                @endforeach

                <tr>
                  <td>z</td>
                  <td>
                    <button type="submit" name="submit" class="btn btn-flat bg-maroon"><i class="fa fa-share"></i> Send to Shops</button>
                  </td>
                </tr>
              </tbody>
            </table>
          {{ Form::close() }}
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>

  <script>
    $(document).ready(function(){
      $('#ShopList').dataTable();
    });
  </script>
@endsection







