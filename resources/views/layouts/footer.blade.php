  <!-- Bootstrap 3.3.6 -->
  {{ Html::script('/plugins/bootstrap/dist/js/bootstrap.min.js')}}
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

  <!-- jQuery Session -->
  {{ Html::script('/plugins/jQuery/jQuerySession.js') }}

  <!-- DataTables -->
  {{ Html::script('/plugins/datatables/jquery.dataTables.min.js') }}   
  {{ Html::script('/plugins/datatables/dataTables.bootstrap.min.js') }}   
 <!--  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs/jq-3.2.1/jq-3.2.1/jszip-2.5.0/dt-1.10.16/b-1.4.2/b-colvis-1.4.2/b-flash-1.4.2/b-html5-1.4.2/b-print-1.4.2/cr-1.4.1/fh-3.1.3/r-2.2.0/sc-1.4.3/datatables.min.js"></script> -->
  
  <!-- Select2 -->
  {{ Html::script('/plugins/select2/select2.min.js') }}
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script> -->

  <!-- Datepicker -->
  {{ Html::script('/plugins/datepicker/js/bootstrap-datepicker.min.js') }}  
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script> -->

  <!-- Alertify JS -->
  {{ Html::script('/plugins/alertifyJS/alertify.min.js') }}  
  <!-- <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>   -->

  <!-- SlimScroll -->
  {{ Html::script('/plugins/slimScroll/jquery.slimscroll.min.js')}}

  <!-- Sly -->
  <!-- {{ Html::script('/plugins/sly/sly.min.js')}} -->

  <!-- iCheck -->
  {{ Html::script('/plugins/iCheck/icheck.min.js') }}

  <!-- ChartJS 1.0.1 -->
  {{ Html::script('/plugins/chartjs/Chart.min.js')}}

  <!-- Dashboard JS -->
  {{ Html::script('/js/dashboard.js')}}
  
  <!-- Calculator JS -->
  {{ Html::script('/js/calculator.js') }}

  <!-- AdminLTE App -->
  {{ Html::script('/dist/js/adminlte.min.js')}} 
  {{ Html::script('/dist/js/demo.js')}} 

  <!-- <script>
    $(document).ready(function () {
      $('.sidebar-menu').tree()
    })
  </script> -->

  <script>
    // Remove active for all items.
    $('.page-sidebar-menu li').removeClass('active');

    // highlight submenu item
    $('li a[href="' + this.location.pathname + '"]').parent().addClass('active');

    // Highlight parent menu item.
    $('ul a[href="' + this.location.pathname + '"]').parents('li').addClass('active');
  </script>
  
  <script>
    @if(session('status'))
        alertify.alert("You Cannot Access This Page");
    @endif

    @if(session('status'))
        alertify.alert("STOP :: You are not authorized to access this feature !!!");
    @endif

    @if(session('ProductEdit'))
        alertify.success("Product is Successfully Updated");
    @endif     

    @if(session('ProductInsert'))
        alertify.success("Product is Successfully Added");
    @endif

    @if(session('ProductInsertwithExcel'))
      <?php $a=session('ProductInsertwithExcel')?>
             var x ="<?php echo $a;?>";
       alertify.success(""+x);
    @endif

  </script>  



</body>
</html>
