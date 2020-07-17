    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->                
                <img src="{{asset('images/user.png')}}" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"> {{Auth::user()->firstName.' '.Auth::user()->secondName}} </span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="{{asset('images/user.png')}}" class="img-circle" alt="User Image">
  
                  <p>
                    {{Auth::user()->firstName.' '.Auth::user()->secondName}}
                    <small>Access Manager since  {{date('d-m-Y', strtotime(Auth::user()->created_at))}}</small>
                  </p>
                </li>
                
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">                  
                  <div class="pull-right">                    
                    <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                     {{ __('Logout') }}
                 </a>

                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     {{-- @csrf --}}
                     {{ csrf_field() }}
                 </form>
                  </div>
                  <div class="pull-left">
                    <a class="btn btn-default btn-flat" href="/changePassword">Change Password</a>                 
                  </div>
                </li>
              </ul>
            </li>           
          </ul>
        </div>
      </nav>