@extends ('layout.main')

@section ('content')

@section ('box-body')
  <table id="table1" class="table table-bordered table-hover dataTable">
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
      <th>#</th>
      <th>{{ trans('admin.EMAIL') }}</th>
      <th>{{ trans('admin.NAME') }}</th>
      <th>{{ trans('admin.ACTIVE') }}</th>
      <th>{{ trans('admin.PENDING') }}</th>
      <th>{{ trans('admin.CREATED') }}</th>
      <th>{{ trans('admin.UPDATED') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($users as $i => $user)
      <tr data-id="{{ $user->id }}">
        <td>
          <div class=c>{{ $i + 1 }}</div>
        </td>
        <td>
          <div class=c>{{ $user->email }}</div>
        </td>
        <td>
          <div class=c>{{ $user->name }}</div>
        </td>
        <td>
          <div class=c>{{ $user->active }}</div>
        </td>
        <td>
          <div class=c>{{ $user->pending }}</div>
        </td>
        <td>
          <div class=c>{{ $user->created_at }}</div>
        </td>
        <td>
          <div class=c>{{ $user->updated_at }}</div>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
@stop

@section ('box-footer')
  <div class="action-bar">
    <a href="admin/user/" class="btn btn-success">
      <i class="glyphicon glyphicon-plus-sign"></i>{{ trans('admin.BTN_NEW') }}</a>
  </div>
@stop

@include ('partial.box', ['title'=>trans('admin.USERS')])

@stop

@section ('scripts')
  @parent
  <script>
    $ (function () {
      $ ('#table1').dataTable ({
            paging:       true,
            lengthChange: true,
            searching:    true,
            ordering:     true,
            info:         true,
            autoWidth:    false,
            responsive:   true,
            pageLength:   10,
            lengthMenu:   [5, 10, 15, 20, 50, 100],
            pagingType:   'simple_numbers',
            serverSide:   false,
            {!! $lang != 'en' ? "language: { url: 'js/datatables/$lang-".strtoupper($lang).".json' }," : '' !!}
            initComplete: function () {
              $ ('#table1').show ();
            }
          })
          .on ('click', 'div', function (ev) {
            location.href = 'admin/user/' + ev.target.parentElement.parentElement.getAttribute ('data-id');
          });
    });
  </script>
@stop
