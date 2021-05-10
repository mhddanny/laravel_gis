<nav class="navbar navbar-static-top">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>

  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- Messages: style can be found in dropdown.less-->

      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="{{ asset ('img/userlogo.png')}}" class="user-image" alt="User Image">
          @if (Auth::check())
            <span class="hidden-xs">{{ Auth::user()->name }}</span>
          @endif
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            <img src="{{ asset ('img/userlogo.png')}}" class="img-circle" alt="User Image">

            <p>
              @if (Auth::check())
                {{ Auth::user()->name }}
                <small>{{ Auth::user()->level }}</small>
              @endif
            </p>
          </li>
          <!-- Menu Body -->

          {{-- <li class="user-body">
            <div class="row">
              <div class="col-xs-4 text-center">
                <a href="#">Followers</a>
              </div>
              <div class="col-xs-4 text-center">
                <a href="#">Sales</a>
              </div>
              <div class="col-xs-4 text-center">
                <a href="#">Friends</a>
              </div>
            </div>
            <!-- /.row -->
          </li> --}}
          <!-- Menu Footer-->

          <li class="user-footer">
            <div class="pull-left">
              <a href="#" class="btn btn-default btn-flat">Profile</a>
            </div>
            <div class="pull-right">
              <form class="" action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" name="button" class="btn btn-default btn-flat">Sign Out</button>
              </form>
            </div>
          </li>
        </ul>
      </li>
      <!-- Control Sidebar Toggle Button -->
      {{-- <li>
        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
      </li> --}}
    </ul>
  </div>
</nav>
