<?php

use App\Http\Middleware\Language;

class c
{
  static public function dataTable ($indentSpace, $html, $href = '', $id = 'table1')
  {
    $lang = Language::get ();
    View::startSection ('scripts');
    ?>@parent
    <script>
      $ (function () {
        $ ('#<?=$id ?>').dataTable ({
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
            <?= $lang != 'en' ? "language: { url: 'js/datatables/$lang-" . strtoupper ($lang) . ".json' }," : '' ?>
            initComplete: function () {
              $ ('#<?=$id ?>').show ();
            },
            drawCallback: function() {
              var p = $('#<?=$id ?>_wrapper .pagination');
              p.css ('display', p.children(':visible').length == 1 ? 'none' : '');
            }
          })<?php if ($href):?>
          .on ('click', 'div', function (ev) {
            location.href = 'admin/user/' + ev.target.parentElement.parentElement.getAttribute ('data-id');
          })<?php
        endif ?>;
      });
    </script>
    <?php
    View::stopSection ();
    $html = str_replace ('<table ', "<table id='$id' ", $html);
    echo $html;
  }

  static public function panel ($indentSpace, $html, $title = null, $options = [])
  {
    $footer = array_Get (View::getSections (), 'panel-footer');
    $close = array_get ($options, 'close',false);
    $collapse = array_get ($options, 'collapse',false);
    ?>
    <div class="box">
      <?php if (isset($title)): ?>
        <div class="box-header with-border">
          <h3 class="box-title"><?= $title ?></h3>
          <div class="box-tools pull-right">
            <?php if ($collapse): ?>
              <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
            <?php endif ?>
            <?php if ($close): ?>
              <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            <?php endif ?>
          </div>
        </div>
      <?php endif ?>
    <div class="box-body">
      <?= $html ?>
    </div>
    <?php if (isset($footer)): ?>
    <div class="box-footer">
      <?= $footer ?>
    </div>
    <?php endif;
  }

  static public function panelFooter ($indentSpace, $html)
  {
    View::startSection ('panel-footer', $html);
  }

}
