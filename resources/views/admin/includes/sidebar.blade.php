<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('admin/images/logo.png')}}" alt="AdminLTE Logo" class="brand-image"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{env('APP_NAME')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if(!empty(Auth::guard('admin')->user()->image))
            <img class="img-circle elevation-2" src="{{url('admin/images/photos/'.Auth::guard('admin')->user()->image)}}" alt="profile"/>
            @else
            <img class="img-circle elevation-2" src="{{url('admin/images/photos/no-image.png')}}" alt="profile"/>
            @endif
        </div>
        <div class="info">
          <a href="#" class="d-block">Hi, {{Auth::guard('admin')->user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a @if (Session::get('page')=="dashboard") style="background-color:#ffffff !important; 
            color:black !important;"
            @endif href="{{route('dashboard')}}" class="nav-link">
              <i class="icon-nav fas fa-home"></i>
              &numsp;
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a @if (Session::get('page')=="update-admin-password" || Session::get('page')=="update-admin-details") style="background-color:#ffffff !important; 
            color:black !important;"
               @endif href="#ui-admins" class="nav-link">
               <img @if (Session::get('page')=="update-admin-password" || Session::get('page')=="update-admin-details") src="{{asset('admin/icons/admin-dark.png')}}"  @else src="{{asset('admin/icons/admin-light.png')}}"
               @endif  height="20px" width="20px">
              &numsp;
              <p>
                Admins
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" id="ui-admins">
              <li class="nav-item">
                <a @if (Session::get('page')=="update-admin-password") style="background-color:#ffffff !important; 
                color:black !important;" @else style="background-color:#343a40 !important; 
                color:#c2c7d0 !important;"
                    @endif href="{{ route('update-admin-password') }}" class="nav-link">
                  <p>Update Admin Password</p>
                </a>
              </li>
              <li class="nav-item">
                <a @if (Session::get('page')=="update-admin-details") style="background-color:#ffffff !important; 
                color:black !important;" @else style="background-color:#343a40 !important; 
                color:#c2c7d0 !important;"
                    @endif href="{{ route('update-admin-details') }}" class="nav-link">
                  <p>Update Admin Details</p>
                </a>
              </li>
            </ul>
          </li>

              <li class="nav-item">
                <a @if (Session::get('page')=="sections") style="background-color:#ffffff !important; 
                color:black !important;" @else style="background-color:#343a40 !important; 
                color:#c2c7d0 !important;"
                  @endif href="{{ url('admin/sections') }}" class="nav-link">
                  <img @if (Session::get('page')=="sections") src="{{asset('admin/icons/section-dark.png')}}"  @else src="{{asset('admin/icons/section-light.png')}}"
                    @endif  height="20px" width="20px">
                  &numsp;
                  <p>
                    Sections
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a @if (Session::get('page')=="movies") style="background-color:#ffffff !important; 
                color:black !important;" @else style="background-color:#343a40 !important; 
                color:#c2c7d0 !important;"
                    @endif href="{{ url('admin/movies') }}" class="nav-link">
                    <img @if (Session::get('page')=="movies") src="{{asset('admin/icons/movie-dark.png')}}"  @else src="{{asset('admin/icons/movie-light.png')}}"
                    @endif  height="20px" width="20px">
                  &numsp;
                  <p>
                    Movies
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a @if (Session::get('page')=="episodes") style="background-color:#ffffff !important; 
                color:black !important;" @else style="background-color:#343a40 !important; 
                color:#c2c7d0 !important;"
                    @endif href="{{ url('admin/episodes') }}" class="nav-link">
                    <img @if (Session::get('page')=="episodes") src="{{asset('admin/icons/episode-dark.png')}}"  @else src="{{asset('admin/icons/episode-light.png')}}"
                    @endif  height="20px" width="20px">
                  &numsp;
                  <p>
                    Episodes
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a @if (Session::get('page')=="actors") style="background-color:#ffffff !important; 
                color:black !important;" @else style="background-color:#343a40 !important; 
                color:#c2c7d0 !important;"
                    @endif href="{{ url('admin/actors') }}" class="nav-link">
                    <img @if (Session::get('page')=="actors") src="{{asset('admin/icons/actor-dark.png')}}"  @else src="{{asset('admin/icons/actor-light.png')}}"
                    @endif  height="25px" width="25px">
                  &numsp;
                  <p>
                    Actors
                  </p>
                </a>
              </li>


          <li class="nav-item has-treeview">
            <a @if (Session::get('page')=="about-and-help") style="background-color:#ffffff !important; 
            color:black !important;"
               @endif href="#ui-settings" class="nav-link">
              <i class="nav-icon fas fa-wrench"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" id="ui-settings">
              <li class="nav-item">
                <a @if (Session::get('page')=="about-and-help") style="background-color:#ffffff !important; 
                color:black !important;" @else style="background-color:#343a40 !important; 
                color:#c2c7d0 !important;"
                    @endif href="{{ route('about-and-help') }}" class="nav-link">
                    <img @if (Session::get('page')=="about-and-help") src="{{asset('admin/icons/about-dark.png')}}"  @else src="{{asset('admin/icons/about-light.png')}}"
                    @endif  height="20px" width="20px">
                  &numsp;
                  <p>
                    About And Help
                  </p>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a @if (Session::get('page')=="update-admin-details") style="background-color:#ffffff !important; 
                color:black !important;" @else style="background-color:#343a40 !important; 
                color:#c2c7d0 !important;"
                    @endif href="{{ route('update-admin-details') }}" class="nav-link">
                  <p>Update Admin Details</p>
                </a>
              </li> --}}
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>