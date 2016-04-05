<?php

class c
{
  static public function panel ($indentSpace, $html, $title = null, $options = [])
  {
    $footer = array_Get (View::getSections (), 'panel-footer');
    $close = array_get ($options, 'close', false);
    $collapse = array_get ($options, 'collapse', false);
    $class = array_get ($options, 'class', '');
    ?>
    <div class="box <?=$class ?>">
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
