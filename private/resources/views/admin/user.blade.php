@extends ('layout.main')

@section ('content')

  @@c::panel (trans('admin.USER'),['class'=>'formPanel box-primary']):

  <form id="mainForm" class="form-horizontal" role="form" method="POST">
    @@token

        <!-- disable browser's autofill and password-saving prompt -->
    <input type="text"
           name="prevent_autofill"
           id="prevent_autofill"
           value=""
           style="visibility:hidden;position:absolute">
    <input type="password" name="password_fake" id="password_fake" value="" style="visibility:hidden;position:absolute">

    @@field('name',trans('admin.NAME')):
      <input type="text" autofocus>
    @@endfield

    @@field('email',trans('admin.EMAIL')):
      <input type="text">
    @@endfield

    @@field('password',trans('admin.PASSWORD')):
      <input type="password">
    @@endfield

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-2">
        <div class="checkbox">
          <label>
            <input type="checkbox" name="active" value="1" checked="@boolAttr (Impactwave\Razorblade\Form::fieldWas('active',true))">
            @lang('admin.ACTIVE')
          </label>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="checkbox">
          <label>
            <input type="checkbox" name="pending" value="1" checked="@boolAttr (Impactwave\Razorblade\Form::fieldWas('pending',true))">
            @lang('admin.PENDING')
          </label>
        </div>
      </div>
    </div>

    @@field('created_at',trans('admin.CREATED'),['innerClass'=>'col-sm-3']):
    <input type="text">
    @@endfield

    @@field('updated_at',trans('admin.UPDATED'),['innerClass'=>'col-sm-3']):
    <input type="text">
    @@endfield

    @@c::panelFooter:
    <div class="action-bar">
      <button type="submit" class="btn btn-primary" form="mainForm">
        <i class="glyphicon glyphicon-ok"></i>@lang('admin.BTN_SAVE')</button>
      <a href="{{ URL::route('users') }}" class="btn btn-default">
        <i class="glyphicon glyphicon-ban-circle"></i>@lang('admin.BTN_CANCEL')</a>
    </div>
    @@endc::panelFooter

  </form>

  @@endc::panel

@stop
