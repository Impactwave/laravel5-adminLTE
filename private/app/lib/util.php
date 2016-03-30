<?php
/**
 * Copyright 2013 Impactwave Lda, all rights reserved.
 */

use Illuminate\Database\Query\Builder;

/**
 * Generic Utility Functions
 */
class Util
{

  const ALERT_ERROR   = 'error';
  const ALERT_INFO    = 'info';
  const ALERT_SUCCESS = 'success';
  const ALERT_WARNING = 'warning';

  public static function activeIfRouteTagged ($tag, $activeClass = 'active')
  {
    return self::currentRouteTagged ($tag) ? $activeClass : '';
  }

  public static function currentRouteTagged ($tag)
  {
    $route = Route::current ();
    return $route ? (array_get ($route->getAction (), 'tag') == $tag) : false;
  }

  /**
   * Allows sending flash messages to be viewed on the next request.
   * Has support for 4 types of message and allows setting a title.
   *
   * @param string $message
   * @param string $title
   * @param string $type
   *
   * @return Illuminate\Routing\Redirector
   */
  public static function flash ($message, $title = '', $type = self::ALERT_WARNING)
  {
    Session::flash ('message', "$type|$message|$title");
  }

  /**
   * @param Builder      $b       The result of running <kbd>DB::table ('table_name')</kbd>.
   * @param array|string $columns An array of column names, or a string of comma-delimited column names.
   * @param string       $csv     The CSV data.
   * @return Builder The builder, for chaining.
   */
  static function importCSV (Builder $b, $columns, $csv)
  {
    if (is_string ($columns)) $columns = explode (',', $columns);
// Use an I/O stream instead of an actual file.
    $handle = fopen ('php://temp/myCSV', 'w+b');

// Write all the data to it
    fwrite ($handle, $csv);

// Rewind for reading
    rewind ($handle);

// use fgetcsv which tends to work better than str_getcsv in some cases
    $data= [];
    $i    = 0;
    try {
      while ($row = fgetcsv ($handle, null, ',', "'")) {
        ++$i;
        $data[] = array_combine ($columns, $row);
      }
      fclose ($handle);
    } catch (ErrorException $e) {
      echo "\nInvalid row #$i\n\nColumns:\n";
      var_export ($columns);
      echo "\n\nRow:\n";
      var_export ($row);
      echo "\n";
      exit (1);
    }

    $b->insert ($data);
    return $b;
  }

  /**
   * Shortcut for request data validation.
   *
   * Ex:
   * <code>
   *  $err = Util::validate(...);
   *  if ($err) return $err;
   * </code>
   *
   * @param array $rules
   * @param array $messages
   * @param array $customAttributes
   *
   * @return bool|\Illuminate\Http\RedirectResponse
   */
  public static function validate (array $rules, array $messages = [], array $customAttributes = [])
  {
    $validator = Validator::make (Input::all (), $rules, $messages, $customAttributes);
    if ($validator->fails ()) {
      self::flash (Lang::get ('app.form_validation_failed'));
      return Redirect::refresh ()
                     ->withErrors ($validator)
                     ->withInput ();
    }
    return false;
  }
}
