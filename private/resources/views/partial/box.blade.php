<!-- Default box -->
<div class="box">
  @if(isset($title))
  <div class="box-header with-border">
    <h3 class="box-title">{{ $title }}</h3>
    <div class="box-tools pull-right">
      <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
      <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
  @endif
  <div class="box-body">
    @yield ('box-body')
  </div><!-- /.box-body -->
  @if (isset($__env->getSections()['box-footer']))
  <div class="box-footer">
    @yield ('box-footer')
  </div><!-- /.box-footer-->
  @endif
</div><!-- /.box -->