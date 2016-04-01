<!-- User Account: style can be found in dropdown.less -->
<li class="dropdown user user-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <img src="img/user.jpg" class="user-image" alt="User Image"/> <span class="hidden-xs">{{ $name }}</span></a>
  <ul class="dropdown-menu">
    <!-- User image -->
    <li class="user-header">
      <img src="img/user.jpg" class="img-circle" alt="User Image"/>
      <p>{{ $name }}
        <small>{{ $email }}</small>
      </p>
    </li>
    <!-- Menu Footer-->
    <li class="user-footer">
      <div class="pull-left">
        <a href="admin/user/{{ Auth::id() }}" class="btn btn-default btn-flat">@lang('admin.PROFILE')</a>
      </div>
      <div class="pull-right">
        <a href="auth/logout" class="btn btn-default btn-flat">@lang('admin.LOGOUT')</a>
      </div>
    </li>
  </ul>
</li><!-- / User Account -->
