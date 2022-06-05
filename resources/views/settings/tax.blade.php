@extends('layouts.admin')

@section('content')
  <!-- ======================= Content Wrapper ========================= -->
  <div class="content-wrapper">
    <!-- ======================= Content Header ========================= -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user"></i>Tax Settings
        <small> Add, edit , remove Tax Codes </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/Settings"><i class="fa fa-cogs"></i> Settings</a></li>
        <li class="active">Tax</li>
      </ol>
    </section>
    <!-- ======================= / Content Header ========================= -->


    <!-- ======================= Main Content ========================= -->
    <section class="content">
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-header with-border">
          <button class="btn btn-flat bg-navy" data-toggle="modal" data-target="#NewTaxModal">Add New Tax Code</button>
        </div>
        <div class="box-body">
          <table class="table table-reponsive table-stripped">
            <thead>
              <th>TaxCode</th>
              <th>Percent</th>
              <th>Status</th>
              <th>Added At</th>
              <th>Action</th>
            </thead>

            
              @foreach ($TaxList as $Tax)
              <tbody>
                <td>{{ $Tax->TaxCode }}</td>
                <td>{{ round($Tax->TaxPercent,2) }} %</td>
                <td>
                  @if ($Tax->Inactive == 0)
                    <p class="label label-success">Active</p>
                  @else
                    <p class="label label-danger">Deactive</p>
                  @endif
                </td>
                <td>{{ date('d/m/Y h:i A', strtotime($Tax->created_at)) }}</td>
                <td>
                <button class="btn btn-flat bg-orange TaxCodeEdit" name="TaxCodeEdit[]"><i class="fa fa-pencil-square-o"></i></button>

                <input type="hidden" name="TaxCodeValue[]" value="{{$Tax->TaxCode}}">
                <input type="hidden" name="TaxPercent[]"   value="{{$Tax->TaxPercent}}">
                <input type="hidden" name="TaxID[]"        value="{{$Tax->TaxCodeID}}">

                <button class="btn btn-flat btn-danger TaxDelete" name="TaxDelete[]"><i class="fa fa-trash"></i></button>
                  
                  
                </td>
              </tbody>
              @endforeach

              <input type="hidden" name="TaxCodeDeleteIndex" id="TaxCodeDeleteIndex" value="0">
            
          </table> 

          <!-- =================== New Tax  Modal ===================-->
          <div class="modal" id="NewTaxModal" role="dialog">
            <div class="modal-dialog">
              <!-- =================== Modal content =================== -->
                <div class="modal-content">

                  <div class="modal-header">
                    <h1 class="modal-title text-center">
                      <p class="label label-primary">Add New TaxCode</p>
                    </h1>
                  </div>

                  <div class="modal-body">
                    {{ Form::open(array('url' => '/Tax/New', 'class' => 'form-inline')) }}

                      <div class="form-group">



                        <input type="text" id="TaxCode" class="form-control" id="inputSuccess" placeholder="TaxCode" name="TaxCode" required>

                        <input type="number" step=".0001" id="Parcent" class="form-control" id="inputSuccess" placeholder="%" name="Parcent" required>
                        
                        {{ Form::submit('Add New Method', array('class'=>'btn bg-navy btn-flat','name'=>'submit')) }}

                                     
                      </div>

                    {{ Form::close() }}
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn bg-maroon btn-flat" data-dismiss="modal">Cancel</button>
                  </div>
                </div>
            </div>
          </div>
          <!-- =================== New Tax Modal ===================-->


           <!-- =================== Edit Tax  Modal ===================-->
          <div class="modal" id="EditTaxModal" role="dialog">
            <div class="modal-dialog">
              <!-- =================== Modal content =================== -->
                <div class="modal-content">

                  <div class="modal-header">
                    <h1 class="modal-title text-center">
                      <p class="label label-primary">Edit TaxCode</p>
                    </h1>
                  </div>

                  <div class="modal-body">
                    {{ Form::open(array('url' => '/Tax/Edit', 'class' => 'form-inline')) }}

                      <div class="form-group">
                        
                        <input type="hidden" id="EditTaxID" name="editTaxID"  class="form-control">
                        <input type="text" id="EditTaxCode" class="form-control" placeholder="TaxCode" name="editTaxCode" required>

                        <input type="number" step=".0001" id="EditPercent" class="form-control" placeholder="%" name="editPercent" required>
                        
                        {{ Form::submit('Edit Tax Method', array('class'=>'btn bg-navy btn-flat','name'=>'submit')) }}

                                     
                      </div>

                    {{ Form::close() }}
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn bg-maroon btn-flat" data-dismiss="modal">Cancel</button>
                  </div>
                </div>
            </div>
          </div>
          <!-- =================== Edit Tax Modal ===================-->
        </div>
      </div>
    </section>
    <!-- ======================= / Main Content ========================= -->

  </div>

  <script>


  $(document).ready(function()
  {
   $('.TaxCodeEdit').click(function()
   {
    var Index=$('[name="TaxCodeEdit[]"]').index(this);
    var Taxcodevalue=$('input[name="TaxCodeValue[]"]').eq(Index).val();
    var Taxpercentvalue=$('input[name="TaxPercent[]"]').eq(Index).val();
    var TaxIDvalue=$('input[name="TaxID[]"]').eq(Index).val();
    $('#EditTaxCode').val(Taxcodevalue);
    $('#EditPercent').val(Taxpercentvalue);
    $('#EditTaxID').val(TaxIDvalue);


    $('#EditTaxModal').modal('show');
   });


   

   $('.TaxDelete').on('click',function()
   {

    var index=$('[name="TaxDelete[]"]').index(this);
    $('#TaxCodeDeleteIndex').val(index);

    alertify.confirm('Tax Code Delete','Are You Sure You Want to Delete This taxCode?',function()
    {

      var Index=$('#TaxCodeDeleteIndex').val();
      var value=$('input[name="TaxID[]"]').eq(Index).val();
      $.get('/Tax/Delete/'+value,function(data)
      {
       location.reload(true);

      });
      

    },function(){alertify.error('Cancel')});
    
    


   });

  });
    


  </script>
  <!-- ======================= / Content Wrapper ========================= -->
@endsection