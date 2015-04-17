<?php
/**
 * Copyright 2013 Impactwave Lda, all rights reserved.
 */

/**
 * Generic Utility Functions
 */
class Util
{

  const ALERT_SUCCESS = 'success';
  const ALERT_INFO = 'info';
  const ALERT_WARNING = 'warning';
  const ALERT_ERROR = 'danger';

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
  public static function validate (array $rules, array $messages = array(), array $customAttributes = array())
  {
    $validator = Validator::make (Input::all (), $rules, $messages, $customAttributes);
    if ($validator->fails ()) {
      self::flash (Lang::get ('app.formValidationFailed'));
      return Redirect::refresh ()
          ->withErrors ($validator)
          ->withInput ();
    }
    return false;
  }

  public static function validationMessageFor ($field, $label = null, $related = null, $relatedLabel = null)
  {
    $errors  = View::shared ('errors');
    $message = $errors->first ($field, '<div class="help-block">:message</div>');
    if (!$message) return '';
    $fieldEsc = preg_quote ($field);
    $message  = $label ? preg_replace ("/\\b$fieldEsc\\b/", $label, $message) : $message;
    if (isset($related)) {
      $fieldEsc = preg_quote ($related);
      $message  = preg_replace ("/\\b$fieldEsc\\b/", $relatedLabel, $message);
    }
    return $message;
  }

  public static function currentRouteTagged ($tag) {
    $route = Route::current();
    return $route ? (array_get($route->getAction(), 'tag') == $tag) : false;
  }

  public static function activeIfRouteTagged ($tag, $activeClass = 'active') {
    return self::currentRouteTagged ($tag) ? $activeClass : '';
  }


}