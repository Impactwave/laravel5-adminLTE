<?php namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{

  /**
   * The application's global HTTP middleware stack.
   *
   * @var array
   */
  protected $middleware = [
    //'App\Http\Middleware\Language',
    'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
    'Illuminate\Cookie\Middleware\EncryptCookies',
    'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
    'Illuminate\Session\Middleware\StartSession',
    'Illuminate\View\Middleware\ShareErrorsFromSession',
    'App\Http\Middleware\VerifyCsrfToken',

    'App\Http\Middleware\Language',
  ];

  /**
   * The application's route middleware.
   *
   * @var array
   */
  protected $routeMiddleware = [
    'auth'       => 'App\Http\Middleware\Authenticate',
    'auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
    'guest'      => 'App\Http\Middleware\RedirectIfAuthenticated',
  ];

  public function addMiddleware ($className)
  {
    $this->middleware[] = $className;
  }
}
