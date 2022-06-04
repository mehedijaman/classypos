@extends('layouts.admin')

@section('content')
  <!-- ======================= Content Wrapper ========================= -->
  <div class="content-wrapper">
    <!-- ======================= Content Header ========================= -->
    <section class="content-header">
      <h1>
        Bank List
        <small>View all Banks</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Bank List</li>
      </ol>
    </section>
    <!-- ======================= / Content Header ========================= -->


    <!-- ======================= Main Content ========================= -->
    <section class="content">
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-header">
          <button class="btn btn-flat bg-navy" data-toggle="modal" data-target="#NewBankModal">New Bank</button>
        </div>
        <div class="box-body">
          <table id="BankList" class="table table-bordered table-striped DataTable">
            <thead>
              <tr>
                <th> Bank Name</th>
                <th> Bank Balance</th>
                <th> Action</th>
              </tr>         
            </thead>

            <tbody>        
              @foreach ($BankList as $Bank)
                <tr>
                  <td>{{$Bank->BankName}}</td>        
                  <td>{{$Bank->Balance}}</td>        
                  <td>
                    <!-- <div class="btn-group"> -->
                      <a title="Bank Details" href="/Bank/Details/{{ $Bank->BankID }}" class="btn btn-info btn-flat"> <i class="fa fa-info"> </i></a> 

                      <a title="Bank Ledger" href="/Bank/Ledger/List/{{ $Bank->BankID }}" class="btn bg-olive btn-flat"> <i class="fa fa-book"> </i> </a> 

                      <a title="Edit Bank" href="/Bank/Edit/{{ $Bank->BankID }}" class="btn btn-flat bg-orange"><i class="fa fa-pencil-square-o"></i></a> 
                      
                      <a title="Delete Bank" href="/Bank/Delete/{{ $Bank->BankID }}" class="btn btn-flat bg-maroon delete"> <i class="fa fa-trash-o"></i></a>
                      
                    <!-- </div> -->
                  </td>
                </tr>
              @endforeach                     
            </tbody>                
          </table>
        </div>
      </div>

      <!-- =================== New Bank  Modal ===================-->
      <div class="modal" id="NewBankModal" role="dialog">
        <div class="modal-dialog">
          <!-- =================== Modal content =================== -->
            <div class="modal-content">

              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-primary">Add New Bank</p>
                </h1>
              </div>

              {{ Form::open(array('url' => '/Bank/New', 'class' => 'form-inline')) }}

              <div class="modal-body">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">                    
                      <div class="input-group">
                        <span class="input-group-addon"><strong>Bank Name</strong></span>
                        <input name="BankName" type="text" class="form-control" placeholder="Bank Name">
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><strong>Current Balance</strong></span>
                        <input name="Balance" type="number" class="form-control" placeholder="Balance" value="0" step=".0001">
                      </div>
                      
                    </div>
                  </div>    
                </div>            
              </div>

              <div class="modal-footer">
                <input class="btn bg-navy btn-flat" type="submit" name="Submit" value="Add Bank"> 
                <button type="button" class="btn bg-maroon btn-flat" data-dismiss="modal">Cancel</button>
              </div>
              {{ Form::close() }}
            </div>
        </div>
      </div>
      <!-- =================== New Bank Modal ===================-->
    </section>
    <!-- ======================= / Main Content ========================= -->

  </div>
  <!-- ======================= / Content Wrapper ========================= -->
  

  <script>
    $(".delete").on('click', function(e){
      e.preventDefault();
      var href = this.href;
      alertify.confirm("Are you sure?", function (e) {
        if (e) {
            window.location.href = href;
        }
      });
    }).set({transition:'zoom'}).show();;
    </script> 



@endsection