<?php
namespace App\Http\Middleware;

use App;
use Closure;
use Config;
use Illuminate\Contracts\Routing\Middleware;
use Lang;
use Request;
use Session;
use View;

/**
 * Transforms an hyperlink URL to include the locale specifier if the locale' selection mode requires it.
 *
 * @param string $url
 *
 * @return string
 */
function href ($url)
{
  if (Config::get ('app.locale_use_url'))
    return Language::get () . ($url && $url != '/' ? '/' . $url : '');
  return $url == '/' ? '' : $url;
}

/**
 * Higher level functions for working with the application's language selection.
 */
class Language implements Middleware
{
  /*
    public function __construct(Application $app, Redirector $redirector, Request $request) {
      $this->app = $app;
      $this->redirector = $redirector;
      $this->request = $request;
    }
  */
  public static function autoDetect ()
  {
    $browser_lang =
      !empty($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? strtok (strip_tags ($_SERVER['HTTP_ACCEPT_LANGUAGE']), ',') : '';
    $browser_lang = substr ($browser_lang, 0, 2);
    $userLang     = (in_array ($browser_lang, self::getAvailable ())) ? $browser_lang : self::getDefault ();
    App::setLocale ($userLang);
    // $userLang is not returned because the locale that will be actually selected by the framework may be different.
  }

  public static function get ()
  {
    $locale = App::getLocale ();
    return self::isAvailable ($locale) ? $locale : self::getDefault ();
  }

  public static function getAll ()
  {
    return Config::get ('app.locales');
  }

  public static function getAvailable ()
  {
    return array_keys (self::getAll ());
  }

  public static function getDefault ()
  {
    return Config::get ('app.fallback_locale', 'en');
  }

  public static function getName ()
  {
    return self::nameOf (self::get ());
  }

  public static function getRouteGroup ()
  {
    $locale = self::getLocaleFromURI ();
    return isset($locale) ? ['prefix' => $locale] : [];
  }

  public static function isAvailable ($locale)
  {
    return isset(self::getAll ()[$locale]);
  }

  public static function nameOf ($locale)
  {
    return array_get (self::getAll (), $locale);
  }

  /**
   * Sets the current locale and redirects the browser appropriately.
   *
   * @param string $locale
   */
  public function changeTo ($locale)
  {
    return redirect ()->back ()->with ('setLocale', $locale);
  }

  public function getLocaleFromURI ()
  {
    $locale = Request::segment (1);
    return self::isAvailable ($locale) ? $locale : null;
  }

  /**
   * @param Request $request
   * @param Closure $next
   * @return mixed
   */
  public function handle ($request, Closure $next)
  {
    Lang::setFallback (self::getDefault ());
    $setLocale = Session::get ('setLocale'); //flash data

    if (Config::get ('app.locale_use_cookie')) {
      if ($setLocale)
        Session::set ('locale', $setLocale);
      if (Session::has ('locale'))
        App::setLocale (Session::get ('locale'));
      else self::autoDetect ();
    }
    else if (Config::get ('app.locale_use_url')) {
      if ($setLocale)
        self::setLocaleURLSegment ($setLocale);
      else {
        $lang = self::getLocaleFromURL ();
        if ($lang)
          App::setLocale ($lang);
        else if ($request->segment (1) != 'locale') { //ignore set-locale URL
          self::autoDetect ();
          self::setLocaleURLSegment (self::get ());
        }
      }
    }

    if ($request->segment (1) == 'locale')
      return self::changeTo (($request->segment (2)));

    View::share ('lang', self::get ());
    return $next($request);
  }

  public function set ($locale)
  {
    Session::set ('locale', $locale);
    App::setLocale ($locale);

  }

  /**
   * Checks if the first virtual URL segment is a language identifier and returns it if so.
   *
   * @return string|bool
   */
  private function getLocaleFromURL ()
  {
    $lang = Request::segment (1);
    return $lang && preg_match ('/^[a-z]{2}$/', $lang) ? $lang : false;
  }

  /**
   * @param $locale
   */
  private function setLocaleURLSegment ($locale)
  {
    $path      = Request::segments ();
    $oldLocale = self::getLocaleFromURL ();
    if ($oldLocale)
      $path[0] = $locale;
    else array_unshift ($path, $locale);
    redirect ()->to (implode ('/', $path));
  }

}
