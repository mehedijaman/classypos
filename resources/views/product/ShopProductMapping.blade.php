@extends('layouts.admin')


@section('content')

    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <i class="fa fa-share"></i> Products in a Shop
          <small> | Add products to shop</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li><a href="/Product"><i class="fa fa-product-hunt"></i> Product</a></li>
          <li><a href="/Product/List"><i class="fa fa-list"></i> List</a></li>
          <li class="active">Distribute</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="box box-primary ">
          <div class="box-header with-border"> <h3 class="box-title"><i class="fa fa-share"></i> Add Products To Shop</h3> </div>
          
          <div class="box-body">
            <div class="row">
              <div class="form-group">
                <div class="col-sm-3">
                  <div class="input-group">
                    <span class="input-group-addon bg-blue">Shop :</span>
                    <select name="Shop" class="form-control select2" id="Shop" data-live-search="true">
                      <option selected value="0" >Select Shop</option>
                      @foreach($shop as $data)
                        <option value="{{$data->ShopID}}">{{$data->ShopName}} </option>
                      @endforeach 
                    </select>
                  </div>
                </div>

                

                <div class="col-sm-2">
                  <button class="btn btn-primary" id="ShowAllBtn">Show All</button>
                </div>
              </div>
            </div>

            <br>

            <div class="row">
              <div class="col-md-6">
                <div id="SelectAllArea">
                  <div id="HideTheCheckbox">
                    <input type="checkbox" class="btn  " id="SelectAll" name="SelectAll">
                  </div>                  
                  <label class="btn bg-olive btn-flat" for="SelectAll">Select All</label>

                                    
                </div>
              </div>
            </div>

            <br>
            
            <div class="row">
              <div class="col-md-12">
                

                

                  <!-- <input type="hidden" name="ShopID" value="0" id="ShopID"> -->
                  <!-- <input type="hidden" name="ShopName" value="0" id="ShopName"> -->
                  <!-- <input type="hidden" name="Change" value="Send" id="Change"> -->

                  <table class="table table-bordered table-striped" id="Example">
                    <thead>
                      <tr>
                        <th> Select        </th>
                        <th> Product ID    </th>
                        <th> Product Name  </th>
                        <th> Entry Date </th>
                        <!-- <th> Update Date </th> -->
                        <th> Qty </th>
                      </tr> 
                    </thead>

                    <tbody id="ProductList"> </tbody>
                  </table>              

                  <div id="fad"> </div>
                <!-- {{ Form::close() }} -->
                

                <form id="FormforDistributeController" method="post" action="{{URL::to('/Product/Distribute')}}">

                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <input type="hidden" name="ShopID" value="0" id="ShopID">
                  <input type="hidden" name="ShopName" value="0" id="ShopName">
                  <input type="hidden" name="Change" value="Send" id="Change">


                </form>
              </div>
            </div>
                   
          </div>
        </div>
      </section>

      <!--=================== Shop Select Modal ===================-->
      <div class="modal" id="shopselect" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="col-md-6 col-sm-6 col-lg-5 col-xs-10 col-md-offset-3 col-sm-offset-3 col-lg-offset-3 col-xs-offset-1 ">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-info">Select Shop</p>
                </h1>
              </div>

              <div class="modal-body">

                <div class="btn-group-vertical">
                  @foreach ($shop as $data)
                  <input type="hidden" name="shopnam[]" value="{{$data->ShopID}}" class="shopnam">

                  <button class="btn bg-purple btn-lg btn-flat shopselect btn-block" name="shopselect[]" type="button">{{$data->ShopName}}</button><br> @endforeach
                </div>
              </div>
              <!-- <div class="modal-footer"></div> -->
            </div>
          </div>
        </div>
      </div>
      <!--=================== / Shop Select Modal ===================-->
    </div>

    {{ Html::script('/js/shopproductmapping.js') }}

@endsection