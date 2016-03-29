<?php
use Illuminate\Support\Str;

/**
 * Copyright 2014 Impactwave Lda, all rights reserved.
 */
class Form
{
  static function boolAttr ($space, $attr, $bool)
  {
    return $bool ? "$space$attr" : '';
  }

  static function embedTemplate ($id, $path)
  {
    echo "<script type='text/template' id='$id'>";
    include app_path () . "/views/$path";
    echo '</script>';
  }

  /*
   * Embeds a script to display flash messages using the toastr Javascript library.
   */

  static function errorPopup ($errors)
  {
    if (count ($errors) > 0): ?>
      <div class="alert alert-danger">
        <h4><?= Lang::get ('auth.PROBLEMS 1') ?></h4><?= Lang::get ('auth.PROBLEMS') ?><br><br>
        <ul>
          <?php foreach ($errors->all () as $error)
            echo "<li>$error</li>" ?>
        </ul>
      </div>
      <?php
    endif;
  }

  static function field ($space, $html, $name, $label = null, $options = [])
  {
    // Remove [] suffix, if present.
    $field    = substr ($name, -1) == ']' ? substr ($name, 0, strlen ($name) - 2) : $name;
    $id       = array_get ($options, 'id', "input-$field");
    $forId    = $id ? " for=\"$id\"" : '';
    $idAttr   = $id ? " id=\"$id\"" : '';
    $errors   = View::shared ('errors');
    $outClass = array_get ($options, 'outerClass', 'form-group') . ($errors->has ($field) ? ' has-error' : ' ');
    $message  = Form::validationMessageFor ($field, $label, get ($options, 'related'), get ($options, 'relatedLabel'));
    $lblClass = array_get ($options, 'lblClass', 'control-label');
    $label    = isset($label) && !get ($options, 'noLabel') ? "<label$forId class=\"$lblClass\">$label</label>" : '';
    $old      = Input::old ($field);
    $value    = is_array ($old) || is_null ($old) ? '' : $old;
    $html     = Str::contains ($html, '<textarea')
      ?
      preg_replace ('/<(textarea)( .*)?>/s', "<$1 name=\"$name\"$idAttr class=\"form-control\">$value</$1$2>", $html)
      :
      preg_replace ('/<(input|select)( .*)?>/s', "<$1 name=\"$name\"$idAttr class=\"form-control\"value=\"$value\"$2>",
        $html);
    $innClass = array_get ($options, 'innerClass', 'controls');
    if ($message)
      $message = "$space  $message\n$space";
    $outId = isset($options['outerId']) ? ' id="' . $options['outerId'] . '"' : '';
    $innId = isset($options['innerId']) ? ' id="' . $options['innerId'] . '"' : '';
    return <<<HTML
$space<div class="$outClass"$outId>
$space  $label
$space  <div class="$innClass"$innId>
$space    $html$message$space</div>
$space</div>
HTML;
  }

  static function fieldIs ($field, $value)
  {
    $old = Input::get ($field);
    if (is_array ($old)) {
      foreach ($old as $v)
        if ($value == $v)
          return true;
      return '';
    }
    else return $value == $old;
  }

  /**
   * @param string $field
   * @param        $value
   * @return bool|string
   *
   * @property     $name
   */
  static function fieldWas ($field, $value)
  {
    $old = Input::old ($field);
    if (is_array ($old)) {
      foreach ($old as $v)
        if ($value == $v)
          return true;
      return '';
    }
    else return $value == $old;
  }

  static function flashMessage ()
  {
    if (Session::has ('message')) {
      list ($flashType, $msg, $title) = explode ('|', Session::get ('message')) + [''] + [''];
      $msg   = str_replace ("'", "\\'", $msg);
      $title = str_replace ("'", "\\'", $title);
      return <<<HTML
<script>
  setTimeout(function () {
    toastr.options = {
      closeButton:   false,
      positionClass: 'toast-top-full-width'
    };
    toastr.$flashType('$msg','$title');
  },0);
</script>
HTML;
    }
    return '';
  }

  static function groupClass ($field)
  {
    $errors = View::shared ('errors');
    return 'form-group' . ($errors->has ($field) ? ' has-error' : ' ');
  }

  static function token ()
  {
    echo '<input type="hidden" name="_token" value="' . csrf_token () . '">';
  }

  /*
   * Bootstrap-compatible form field macro.
   *
   *   Syntax example for PHP call:
   *     Form::field ('', '<input type="text">', 'name', 'Your name', ['id'=>'idField'])
   *
   *   Syntax of Blade macro:
   *     @macro:field ('name', 'Your name')
   *     <input type="text">
   *     @end:field
   *
   * If label argument is ommited, no label will be generated. If it's empty, an empty label will be output.
   * For array fields (ex: select multiple), append [] to the field name.
   * The options array may specify:
   *  - id: if this is ommited, an id="input-fieldName" attribute is generated. If it's empty, no id attribute will be output.
   *  - related: the field name of a related field (ex. password confirmation field) for field name translation.
   *  - relatedLabel: the related field's human-friendly name.
   *  - noLabel: true to hide the label, allowing you to still set its name.
   *  - outerClass: classe(s) a aplicar ao div mais exterior. Por omissão: 'form-group'.
   *  - innerClass: classe(s) a aplicar ao div mais interior, que envolve o(s) input(s). Por omissão: 'controls'.
   *  - lblClass: classe(s) a aplicar na label do(s) input(s). Por omissão: 'control-label'.
   *  - outerId: id a aplicar ao div exterior.
   *  - innerId: id a aplicar ao div interior.
   */

  static function validationMessageFor ($field, $label = null, $related = null, $relatedLabel = null)
  {
    $errors  = View::shared ('errors');
    $message = $errors->first ($field, '<span class="help-block">:message</span>');
    if (!$message) return '';
    $fieldEsc = preg_quote ($field);
    $message  = $label ? preg_replace ("/\\b$fieldEsc\\b/", $label, $message) : $message;
    if (isset($related)) {
      $fieldEsc = preg_quote ($related);
      $message  = preg_replace ("/\\b$fieldEsc\\b/", $relatedLabel, $message);
    }
    return $message;
  }

}
