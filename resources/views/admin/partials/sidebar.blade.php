<!-- Topbar Start -->
  <div class="navbar-custom">
      <ul class="list-unstyled topnav-menu float-right mb-0">
         
          <li class="dropdown notification-list">
              <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                  <img src="{{ asset('/images/default.jpg') }}" alt="user-image" class="rounded-circle">
                  <span class="ml-1">{{ auth()->guard('admin')->user()->name; }} <i class="mdi mdi-chevron-down"></i> </span>
              </a>
              <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                  <!-- item-->
                  <div class="dropdown-header noti-title">
                      <h6 class="text-overflow m-0">Welcome !</h6>
                  </div>

                  <!-- item-->
                  <a href="javascript:void(0);" class="dropdown-item notify-item">
                      <i class="fe-user"></i>
                      <span>Profile</span>
                  </a>

                  <!-- item-->
                  <a href="javascript:void(0);" class="dropdown-item notify-item">
                      <i class="fe-settings"></i>
                      <span>Settings</span>
                  </a>

                  <!-- item-->
                  <a href="javascript:void(0);" class="dropdown-item notify-item">
                      <i class="fe-lock"></i>
                      <span>Lock Screen</span>
                  </a>

                  <div class="dropdown-divider"></div>

                  <!-- item-->
                  <a href="{{ route('logout') }}" class="dropdown-item notify-item">
                      <i class="fe-log-out"></i>
                      <span>Logout</span>
                  </a>

              </div>
          </li>

      </ul>

      <!-- LOGO -->
      <div class="logo-box">
          <a href="index-2.html" class="logo text-center">
              <span class="logo-lg">
                  <img src="{{ asset('/images/logo-light.png') }}" alt="" height="16">
                  <!-- <span class="logo-lg-text-light">UBold</span> -->
              </span>
              <span class="logo-sm">
                  <!-- <span class="logo-sm-text-dark">U</span> -->
                  <img src="{{ asset('/images/logo-sm.png') }}" alt="" height="28">
              </span>
          </a>
      </div>

      <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
          <li>
              <button class="button-menu-mobile waves-effect waves-light">
                  <i class="fe-menu"></i>
              </button>
          </li>

         <!--  <li class="d-none d-sm-block">
              <form class="app-search">
                  <div class="app-search-box">
                      <div class="input-group">
                          <input type="text" class="form-control" placeholder="Search...">
                          <div class="input-group-append">
                              <button class="btn" type="submit">
                                  <i class="fe-search"></i>
                              </button>
                          </div>
                      </div>
                  </div>
              </form>
          </li> -->

      </ul>
  </div>
  <!-- end Topbar -->

  
  <!-- ========== Left Sidebar Start ========== -->
  <div class="left-side-menu">

      <div class="slimscroll-menu">

          <!--- Sidemenu -->
          <div id="sidebar-menu">

              <ul class="metismenu" id="side-menu">

                  <li class="menu-title">Navigation</li>
                  <li>
                      <a href="{{ url('/admin/dashboard') }}">
                          <i class="fe-airplay"></i><span> Dashboard </span>
                      </a>
                  </li>
                  @if (Auth::guard('admin')->user()->can('deal-list'))
                  <li>
                      <a href="#"><i class="fa fa-gift"></i> <span> Deals </span> <span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="{{ route('deals') }}">Manage Deals</a></li>
                          <li><a href="{{ route('stages') }}">Manage Stages</a></li>
                          <li><a href="{{ route('pipelines') }}">Manage Pipelines</a></li>
                      </ul>
                  </li>
                  @endif
                  <!-- <li>
                      <a href="{{ route('companies') }}">
                          <i class="fe-briefcase"></i><span> Companies </span>
                      </a>
                  </li> -->
                  @if (Auth::guard('admin')->user()->can('contact-list'))
                  <li>
                      <a href="{{ route('contacts') }}"><i class="fa fa-phone"></i> <span> Contacts </span></a>
                      <!-- <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="{{ route('contacts') }}">Manage Contacts</a></li>
                          <li><a href="{{ url('/admin/contacts/sources') }}">Manage Sources</a></li>
                      </ul> -->
                  </li>
                  @endif

                  @if (Auth::guard('admin')->user()->can('product-list'))
                  <li>
                      <a href="{{ url('/admin/products') }}">
                          <i class="fe-box"></i></i><span> Products </span>
                      </a>
                  </li>
                  @endif

                  @if (Auth::guard('admin')->user()->can('calendar-list'))
                  <li>
                      <a href="{{ url('/admin/calendar') }}">
                          <i class="fe-clock"></i><span> Calendar </span>
                      </a>
                  </li>
                  @endif

                  @if (Auth::guard('admin')->user()->can('user-list'))
                  <li>
                      <a href="#"><i class="fa fa-users"></i> <span> Users </span> <span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="{{ route('users') }}">Manage Users</a></li>
                          <li><a href="{{ route('roles') }}">Manage Roles</a></li>
                      </ul>
                  </li>
                  @endif
              </ul>

          </div>
          <!-- End Sidebar -->

          <div class="clearfix"></div>

      </div>
      <!-- Sidebar -left -->

  </div>
  <!-- Left Sidebar End -->