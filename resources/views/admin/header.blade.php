<header class="main-header">

  <!-- Logo -->
  <a href="#" class="logo">
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Book</b> Keeping</span>
  </a>

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
            <img src="{{ url('bower_components/admin-lte/dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
            <!-- hidden-xs hides the username on small devices so only the image appears. -->
            <span class="hidden-xs">{{ \Auth::user()->first_name.' '.\Auth::user()->last_name }}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- The user image in the menu -->
            <li class="user-header">
              <img src="{{ url('bower_components/admin-lte/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">

              <p>
                {{ \Auth::user()->first_name.' '.\Auth::user()->last_name }}
                <small>@if(\Auth::user()->user_type_id == 0) {{ 'Admin User' }} @elseif(\Auth::user()->user_type_id == 1) {{ 'Company Owner' }} @else  {{ 'Normal User' }} @endif </small>
              </p>
            </li>
            <!-- Menu Body -->
            <li class="user-body">
              <div class="row">
                <div class="col-xs-4 text-center">
                  <a href="#">Facebook</a>
                </div>
                <div class="col-xs-4 text-center">
                  <a href="#">Twitter</a>
                </div>
                <div class="col-xs-4 text-center">
                  <a href="#">LinkedIn</a>
                </div>
              </div>
              <!-- /.row -->
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="{{ url('/user/profile') }}" class="btn btn-default btn-flat">Profile</a>
              </div>
              <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                  <input type="hidden" name="redirect" id="redirect">
              </form>
              <div class="pull-right">
                  <a id="logoutBtn" href="{{ url('/logout') }}" class="btn btn-default btn-flat">
                      Logout
                  </a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>

<script type="text/javascript">
  $('#logoutBtn').on('click', function(e){
    e.preventDefault();
    $('#logout-form').submit();
  });

</script>