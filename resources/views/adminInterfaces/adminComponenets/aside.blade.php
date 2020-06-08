<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{Auth::user()->firstName.' '.Auth::user()->secondName}}</p>                    
      </div>
    </div>
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MENU</li>
      <!-- Optionally, you can add icons to the links -->
      <li class="active"><a href="/home"><i class="fa fa-home"></i> <span>Home</span></a></li>
      <li ><a href="/checkingOutUsers"><i class="fa fa-user-plus"></i> <span>Check Out Visitors.</span></a></li>
      <li><a href="/regularVisitor"><i class="fa fa-search"></i> <span>Search For Visitors</span></a></li>
      <li class="header">TRENDS.</li>

      <li class=""><a href="/trends"><i class="fa fa-bar-chart"></i> <span> Trends.</span></a></li>

      <li class="header">REPORTS.</li>
      <li class=""><a href="/reports"><i class="fa fa-book"></i> <span> Reports.</span></a></li>

      <li class="header">MANAGE USERS.</li>
      <li class=""><a href="/manageUsers"><i class="fa fa-users"></i> <span> Manage Users.</span></a></li>
      

      <li class="header">MANAGE COMPANIES.</li>
      <li class=""><a href="/manageCompanies"><i class="fa fa-building"></i> <span> Manage Companies.</span></a></li>
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>