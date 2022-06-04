<aside class="main-sidebar" >
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree"">
      <li class="header">QUICK ACCESS</li>
      @if(Cookie::get('IsOrder')==1)
      <li class="treeview">
        <a href="#"  id="OrderList" ><i class="fa fa-th"></i> <span>Order List</span></a>
      </li>
      @endif
      <hr style="margin: 0px; border-color: grey; border: 1px solid;">
      <li class="treeview">
        <a href="#" class="" id="InvoiceList"><i class="fa fa-th-list"></i> <span>Invoice List</span></a>
      </li> 
      <hr style="margin: 0px; border-color: grey; border: 1px solid;">
      @if(Cookie::get('IsHold')==1)
      <li class="treeview">
        <a href="#" id="HoldList" ><i class="fa fa-hand-stop-o"></i> <span>Hold List</span></a>
      </li>
      @endif
      <hr style="margin: 0px; border-color: grey; border: 1px solid;">
      @if(Cookie::get('IsAdvance')==1)
      <li class="treeview">
        <a href="#" class="" id="AdvanceList"><i class="fa fa-hand-lizard-o"></i> <span>Advance List</span></a>
      </li>
      @endif 
      <hr style="margin: 0px; border-color: grey; border: 1px solid;">
      <li class="treeview">
        <a href="#" class="" id="RefundList"><i class="fa fa-hand-o-left
        "></i> <span>Refund List</span></a>
      </li> 
      <hr style="margin: 0px; border-color: grey; border: 1px solid;">
      <li class="treeview inner-content hidden">
        <a href="#" class="" data-toggle="modal" data-target="#NewExpense" id="AddExpense"><i class="fa fa-pencil fa-lg"></i> <span>Add Expense</span></a>
      </li>
      <hr style="margin: 0px; border-color: grey; border: 1px solid;">
      <li class="treeview">
        <a href="#" class="" id="DailyReport"><i class="fa fa-print fa-lg"></i> <span>Daily Report</span></a>
      </li>
      <hr style="margin: 0px; border-color: grey; border: 1px solid;">
      <li class="treeview">
        <a href="#" id="Calculator"><i class="fa fa-calculator fa-lg"></i> <span>Calculator</span></a>
      </li> 
      <hr style="margin: 0px; border-color: grey; border: 1px solid;">
      <li class="treeview">
        <a href="#" class="bg-purple" data-toggle="modal" data-target="#{{ AuthorName() }}InfoModal" ><i class="fa fa-copyright"></i><span class="TechLab"> Help </span></a>
      </li>
    </ul>
  </section>    
</aside>