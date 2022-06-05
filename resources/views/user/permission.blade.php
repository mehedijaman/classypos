@extends('layouts.admin')


@section('content')

<div class="content-wrapper">
    <!-- ======================= Content Header ========================= -->
    <section class="content-header">
      <h1>
        Role Assignment
        <small>Assign Roles to Users </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/User">User</a></li>
        <li><a href="/User/List">List</a></li>
        <li class="active">Category</li>
      </ol>
    </section>
    <!-- ======================= / Content Header ========================= -->

    <style>
      .checkbox{
        height: 20px;
        width: 20px;
        cursor: pointer;
      }
      
    </style>


    <!-- ======================= Main Content ========================= -->
    <section class="content">
      <div class="box box-info">
        <!-- /.box-header -->
        <div class="box-header">
          <button class="btn btn-flat bg-navy" data-toggle="modal" data-target="#NewRoleCategoryModal">New Role Category</button>
        </div>
        <div class="box-body">

        <div id="SelectAllArea">
          <div class="col-sm-2">
            <div id="HideTheCheckbox">
            <input type="checkbox" class="btn  " id="SelectAll" name="SelectAll">
            </div>
            <label class="btn btn-flat bg-blue" for="SelectAll">Select All</label>
          </div>          
          
        </div> 

        <form method="post" action={{URL::to('/User/Permission/'.$UserID)}}>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
          <table id="BankList" class="table table-bordered table-striped dataTable">
            <thead>
              <tr>
                <th>Select</th>
                <th>Role ID</th>
                <th>Role Route</th>
                <th> Role Name</th>
              </tr>         
            </thead>
            <tbody>
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

          <div class="col-md-3 col-md-offset-3">

          <input type="submit" class="btn btn-danger btn-lg btn-block" value="Assign Role">
          </form>
        </div>
      </div>

      <!-- =================== New Category  Modal ===================-->
      <div class="modal" id="NewRoleCategoryModal" role="dialog">
        <div class="modal-dialog">
          <!-- =================== Modal content =================== -->
            <div class="modal-content">

              <div class="modal-header">
                <h1 class="modal-title text-center">
                  <p class="label label-primary">Add New Role Category</p>
                </h1>
              </div>

              <div class="modal-body">
                {{ Form::open(array('url' => '/User/Role', 'class' => 'form-horizontal','enctype'=>'multipart/form-data','role'=>'form')) }}

                  <div class="input-group">
                    <input type="text" id="CategoryName" class="form-control" placeholder="Category Name" name="CategoryName">

                    <input type="text" id="RouteName" class="form-control" placeholder="Route Name" name="RouteName">



                    <span class="input-group-btn">
                      {{ Form::submit('Add New Role Category', array('class'=>'btn bg-navy btn-flat','name'=>'submit')) }}
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
      <!-- =================== New Bank Modal ===================-->
    </section>
    <!-- ======================= / Main Content ========================= -->

  </div>
  <!-- ======================= / Content Wrapper ========================= -->
  <script>
    $(document).ready(function() {
      //$('#BankList').DataTable();

        $('#HideTheCheckbox').hide();
        //$('#SelectAllArea').hide();

       $('#SelectAll').on('click',function()

        {
          var length=$('.checkbox').length;      
          if(this.checked)
          {

            for(i=0;i<length;i++)
            {
              $('input[name="checking[]"]').eq(i).val(1);
            }            
            $('.checkbox').prop('checked',true);          
          }

          else
          {
            $('.checkbox').prop('checked',false);


            for(i=0;i<length;i++)
            {
              $('input[name="checking[]"]').eq(i).val(0);
            } 
          }         
          
        });


      $('.checkbox').click(function()

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
        });


       


  } );
  </script>



@endsection