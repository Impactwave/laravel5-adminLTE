@extends ('layout.main')

@section ('content')

  @@c::panel (trans('admin.USERS'),['class'=>'gridPanel box-primary']):

  <table id="table1" data-detail-url="{{ URL::route('user') }}/" class="table table-bordered table-hover dataTable">
    <colgroup>
      <col width="40">
      <col width="50%">
      <col width="50%">
      <col width="70">
      <col width="90">
      <col width="130">
      <col width="130">
    </colgroup>
    <thead>
    <tr>
      <th>#
      <th>@lang('admin.EMAIL')
      <th>@lang('admin.NAME')
      <th>@lang('admin.ACTIVE')
      <th>@lang('admin.PENDING')
      <th>@lang('admin.CREATED')
      <th>@lang('admin.UPDATED')
    </tr>
    </thead>
    <tbody>
    @foreach ($users as $i => $user)
      <tr data-id="{{ $user->id }}">
        <td>
          <div class=c>{{ $i + 1 }}</div>
        <td>
          <div class=c>{{ $user->email }}</div>
        <td>
          <div class=c>{{ $user->name }}</div>
        <td>
          <div class=c>{{ $user->active }}</div>
        <td>
          <div class=c>{{ $user->pending }}</div>
        <td>
          <div class=c>{{ $user->created_at }}</div>
        <td>
          <div class=c>{{ $user->updated_at }}</div>
      </tr>
    @endforeach
    </tbody>
  </table>

  @@c::panelFooter:
  <div class="action-bar">
    <a href="{{ URL::route('user') }}/" class="btn btn-success">
      <i class="glyphicon glyphicon-plus-sign"></i>@lang('admin.BTN_NEW')</a>
  </div>
  @@endc::panelFooter

  @@endc::panel

@stop
