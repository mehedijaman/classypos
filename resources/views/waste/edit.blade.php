@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Waste
        <small>Edit Waste</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Income"> Waste</a></li>
        <li class="active">Edit Waste</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="col-md-8 col-lg-8 col-xs-8 col-sm-12 col-xs-12 col-md-offset-2 col-lg-offset-2 col-xs-offset-2">
        <div class="box box-primary">
          <div class="box-header"></div>
          <div class="box-body">
            {{ Form::open(array('url' => '/Waste/Edit/'.$WasteEdit->WasteID, 'class' => 'form-horizontal')) }}

              <div class="form-group">
                

                <label for="Shop" class="col-sm-2 control-label">Shop :</label>
                <div class="col-md-4">
                  <select id="ShopID" name="ShopID" class="form-control">
                    <option value="0">Main Stock</option>
                    @foreach($Shop as $data)
                      @if($data->ShopID==$WasteEdit->ShopID)
                        <option value="{{$data->ShopID}}" selected>{{$data->ShopName}}</option>                      
                      @else
                      <option value="{{$data->ShopID}}">{{$data->ShopName}}</option>
                      @endif
                    @endforeach
                  </select>
                </div>

                 <label for="Product" class="col-sm-2 control-label">Product:</label>
                <div class="col-md-4">
                  <select id="ProductID" name="ProductID" class="form-control">
                    @foreach($Product as $data)
                      @if($data->ProductID==$WasteEdit->ProductID)
                        <option value="{{$data->ProductID}}" selected>{{$data->ProductName}}</option>
                      @endif
                      <option value="{{$data->ProductID}}">{{$data->ProductName}}</option>
                    @endforeach
                  </select>
                </div>


                                
              </div>

              <div class="form-group">
                <label for="Amount" class="col-sm-2 control-label">Quantity :</label>
                <div class="col-sm-4">
                  <input name="Quantity" type="number" class="form-control" id="Quantity" placeholder="Quantity" value="{{$WasteEdit->Qty}}">
                </div>

                <label for="Wasted By" class="col-sm-2 control-label">Wasted by :</label>
                <div class="col-sm-4">
                  <input name="WastedBy" type="text" class="form-control" id="WastedBy" placeholder="WastedBy" value="{{$WasteEdit->WastedBy}}">
                </div>
              </div>

              <div class="form-group">                

                <label for="Notes" class="col-sm-2 control-label">Notes :</label>
                <div class="col-sm-4">
                  <input name="Notes" type="text" class="form-control" id="Notes" placeholder="Notes" value="{{$WasteEdit->Note}}">
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" name="submit" class="btn btn-primary btn-flat" value="Edit Waste">
                  <button type="button" class="btn btn-danger btn-flat">Cancel</button>
                </div>
              </div>
            {{ Form::close() }}
          </div>
        </div>
      </div>

       
    </section>
    <!-- /.content -->
  </div>
@endsection