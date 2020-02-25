<header class="main-header">

  <!-- Logo -->
  <a href="/home" class="logo">
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
            <img src="/uploads/avatars/{{ Auth::user()->avatar }}" class="user-image" alt="User Image">
          <span class="hidden-xs">{{ \Auth::user()->first_name.' '.\Auth::user()->last_name}}</span>
          </a>
          
          
          <ul class="dropdown-menu">
            <!-- The user image in the menu -->
            <li class="user-header">
              <img src="/uploads/avatars/{{ Auth::user()->avatar }}" class="img-circle"  alt="User Image">
              <p>
                
                <h4 style="color:white">@if(\Auth::user()->user_type_id == 0) {{  \Auth::user()->first_name.' '.\Auth::user()->last_name}} @elseif(\Auth::user()->user_type_id == 1) {{ 'Company Owner' }} @else  {{ 'Normal User' }} @endif </h4>
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
                <a id="Btn" href="{{ url('/profile') }}" class="btn btn-default btn-flat">Profile</a>
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