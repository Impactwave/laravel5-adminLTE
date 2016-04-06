<?php namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Impactwave\Razorblade\Form;
use Input;
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

  const DUMMY_PASS = 'dummypassword';

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
    if ($id) $user['password'] = self::DUMMY_PASS;
    else {
      $user['created_at'] = Carbon::now();
      $user['updated_at'] = Carbon::now();
    }
    Form::setModel ($user);
    return view ('admin.user');
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



    $this->var = [
      'name'       => 'required',
      // if submitting a new user, the email must not exist on the users table or active can be 0
      'email'      => 'required|email' . ($id ? '' : '|unique:users,email,null,null,active,1'),
      'password'   => 'required|min:8',
      'created_at' => 'required',
      'updated_at' => 'required',
    ];

    if ($err) return $err;

    $user = User::findOrNew ($id);
    $form = Input::all ();
    if ($form['password'] == self::DUMMY_PASS)
      unset ($form['password']);
    $user->fill($form);
    $user->save ($form);

    Form::flash (trans('admin.USER_SAVED'));
    return Redirect::route ('users');
  }
}
