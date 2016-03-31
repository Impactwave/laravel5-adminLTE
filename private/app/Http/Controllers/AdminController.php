<?php namespace App\Http\Controllers;

use App\User;
use View;

class AdminController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Home Controller
  |--------------------------------------------------------------------------
  |
  | This controller renders your application's "dashboard" for users that
  | are authenticated. Of course, you are free to change or remove the
  | controller as you wish. It is just here to get your app started!
  |
  */

  /**
   * Create a new controller instance.
   */
  public function __construct ()
  {
    $this->middleware ('auth');
  }

  /**
   * The user detail form.
   *
   * @return View
   */
  public function getUser ($id = null)
  {
    return view ('admin.user', ['user' => User::findOrNew ($id)]);
  }

  /**
   * The user list page.
   *
   * @return View
   */
  public function getUsers ()
  {
    return view ('admin.users', ['users' => User::all ()]);
  }

}
