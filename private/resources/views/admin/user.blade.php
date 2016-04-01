@extends ('layout.main')

@section ('content')

  @@c::panel (trans('admin.USER')):

    <form class="form-horizontal" role="form" method="POST">
      @@token

          <!-- disable browser's autofill and password-saving prompt -->
      <input type="text"
             name="prevent_autofill"
             id="prevent_autofill"
             value=""
             style="visibility:hidden;position:absolute">
      <input type="password"
             name="password_fake"
             id="password_fake"
             value=""
             style="visibility:hidden;position:absolute">

      <div class="form-group">
        <label class="col-sm-2 control-label">@lang('admin.NAME')</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="name" value="{{ $user->name }}" autofocus>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">@lang('admin.EMAIL')</label>
        <div class="col-sm-9">
          <input type="email" class="form-control" name="email" value="{{ $user->email }}">
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">@lang('admin.PASSWORD')</label>
        <div class="col-sm-9">
          <input type="password" class="form-control" name="password" value="{{ $user->password }}">
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-2">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="active" value="1" checked="@boolAttr ($user->active)">
              @lang('admin.ACTIVE')
            </label>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="active" value="1" checked="@boolAttr ($user->pending)">
              @lang('admin.PENDING')
            </label>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">@lang('admin.CREATED')</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="created" value="{{ $user->created_at }}">
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">@lang('admin.UPDATED')</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="updated" value="{{ $user->updated_at }}">
        </div>
      </div>

      @@c::panelFooter:
        <div class="action-bar">
          <button type="submit" class="btn btn-primary">
            <i class="glyphicon glyphicon-ok"></i>@lang('admin.BTN_SAVE')</button>
          <button onclick="history.back()" class="btn btn-default">
            <i class="glyphicon glyphicon-ban-circle"></i>@lang('admin.BTN_CANCEL')</button>
        </div>
      @@endc::panelFooter

    </form>

  @@endc::panel

@stop
