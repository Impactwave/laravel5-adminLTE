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
    $data = [];
    $i    = 0;
    try {
      while ($row = fgetcsv ($handle, null, ',', "'")) {
        ++$i;
        $data[] = array_combine ($columns, $row);
      }
      fclose ($handle);
    }
    catch (ErrorException $e) {
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

}
