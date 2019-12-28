<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ url('bower_components/admin-lte/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="Deals User">
      </div>
      <div class="pull-left info">
        <p>{{ \Auth::user()->first_name.' '.\Auth::user()->last_name }}</p>
        <!-- Status -->
        <a href="{{ url('/admin') }}"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">ADMIN MENU</li>
      @if(\Auth::user()->id == '1')
        <li class="@if(Request::is('*/types*')) {{ 'active' }} @endif"><a href="{{ url('/admin/types') }}"><i class="fa fa-database"></i> <span>Types</span></a></li>
        <li class="@if(Request::is('*/companies*')) {{ 'active' }} @endif"><a href="{{ url('/admin/companies') }}"><i class="fa fa-table"></i> <span>Ledger</span></a></li>
        <li class="@if(Request::is('*/users*')) {{ 'active' }} @endif"><a href="{{ url('/admin/users') }}"><i class="fa fa-user"></i> <span>Users</span></a></li>
      @endif
      {{-- <li class="@if(Request::is('*/posts*')) {{ 'active' }} @endif"><a href="{{ url('/admin/posts') }}"><i class="fa fa-address-book"></i> <span>Posts</span></a></li> --}}

      @if(\Auth::user()->id == '1')
        <li class="treeview @if(Request::is('*/trialbalance*') || Request::is('*/trading*')) {{ 'active' }} @endif">
          <a href="{{ url('/admin/trialbalance') }}"><i class="fa fa-link"></i><span>Accounts</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/admin/trialbalance') }}">Trial Balance</a></li>
             <li><a href="{{ url('/admin/trading') }}">Trading / Profit & Loss</a></li>
           {{--  <li><a href="{{ url('/admi/settings/seo') }}">SEO</a></li> --}}
          </ul>
        </li>
      @endif

      @if(\Auth::user()->id == '1')
        <li class="treeview @if(Request::is('*/settings*')) {{ 'active' }} @endif">
          <a href="{{ url('/admin/settings') }}"><i class="fa fa-link"></i><span>Settings</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/admin/settings/fiscalyears') }}">Fiscal Years</a></li>
          </ul>
        </li>
      @endif

      @if(\Auth::user()->id == '1')
        <li class="treeview @if(Request::is('*/print*')) {{ 'active' }} @endif">
          <a href="{{ url('/admin/pdf') }}"><i class="fa fa-link"></i><span>Prints</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/admin/pdf/print') }}">Pdf</a></li>
          </ul>
          
        </li>
      @endif
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>