<?php namespace App\Providers;

use Auth;
use Illuminate\Contracts\View\View as ViewInstance;
use Illuminate\Support\ServiceProvider;
use View;

class ComposerServiceProvider extends ServiceProvider
{
  /**
   * Register bindings in the container.
   *
   * @return void
   */
  public function boot ()
  {
    // Using class based composers...

//    View::composer ('profile', 'App\Http\ViewComposers\ProfileComposer');

    // Using Closure based composers...

    View::composer ('*', function (ViewInstance $view) {
      $view->with (['skin' => 'skin-blue']);
    });

    View::composer ('layout.main', function (ViewInstance $view) {
      $user = Auth::user ();

      if ($user) {
        $name  = $user->name;
        $email = $user->email;
      }

      $view->with ([
        'email' => $email,
        'name'  => $name,
      ]);
    });
  }

  /**
   * Register the service provider.
   *
   * @return void
   */
  public function register ()
  {
    //
  }

}
