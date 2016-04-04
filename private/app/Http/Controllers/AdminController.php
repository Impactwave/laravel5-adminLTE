<?php namespace App\Http\Controllers;

use App\User;
use Impactwave\Razorblade\Form;
use Redirect;
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
   * @param string|null $id
   * @return View
   */
  public function getUser ($id = null)
  {
    $user = User::findOrNew ($id)->attributesToArray ();
    Form::setModel ($user);
    return view ('admin.user', ['user' => $user]);
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


  public function postUser ($id = null)
  {
    $err = Form::validate ([
      'name'       => 'required',
      // if submitting a new user, the email must not exist on the users table or active can be 0
      'email'      => 'required|email' . ($id ? '' : '|unique:users,email,null,null,active,1'),
      'password'   => 'required|min:8',
      'created_at' => 'required',
      'updated_at' => 'required',
    ]);

    if ($err) return $err;

    Form::flash ('Cool!');
    return Redirect::to ('admin/users');
  }
}
