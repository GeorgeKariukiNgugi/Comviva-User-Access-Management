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
        {{-- <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Trends</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li> --}}
        <li class="header">TRENDS.</li>

        <li class=""><a href="/trends"><i class="fa fa-bar-chart"></i> <span>Weekly Trends.</span></a></li>

        <li class="header">REPORTS.</li>
        <li class=""><a href="/home"><i class="fa fa-book"></i> <span>Weekly Reports.</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>