<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Crypt;
use DB;
use Exception;
use Hash;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Impactwave\Razorblade\Form;
use Input;
use Lang;
use Mail;
use Redirect;
use Util;

class AuthController extends Controller
{

  /*
  |--------------------------------------------------------------------------
  | Registration & Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles the registration of new users, as well as the
  | authentication of existing users. By default, this controller uses
  | a simple trait to add these behaviors. Why don't you explore it?
  |
  */

  use AuthenticatesAndRegistersUsers;


  const HOME_ACTION = 'HomeController@index';

  /**
   * Create a new authentication controller instance.
   *
   * @param  \Illuminate\Contracts\Auth\Guard     $auth
   * @param  \Illuminate\Contracts\Auth\Registrar $registrar
   * @return void
   */
  public function __construct (Guard $auth, Registrar $registrar)
  {
    $this->auth      = $auth;
    $this->registrar = $registrar;

    $this->middleware ('guest', ['except' => 'getLogout']);
  }


  //============================================================
  // LOGIN
  //============================================================

  public function getConfirmEmail ($token)
  {
    try {
      $email     = Crypt::decrypt ($token);
      $userQuery = DB::table ('users')->where ('email', $email);
      $user      = $userQuery->first ();

      if (isset($user)) {
        switch (\Config::get ('app.registerMode')) {
          case 'auto':
            $userQuery->update (['active' => 1]);
            Form::flash (trans ('auth.confirmed'), '', Form::ALERT_SUCCESS); // Foi enviado um email.
            return view ('auth/login');
            break;
          case 'confirm':
            $userQuery->update (['pending' => 1]);
            return view ('auth.info',
              ['title' => trans ('auth.pending-approval_confirmation'), 'text' => trans ('auth.pending-approval')]);
            break;
        }

      }
      else Form::flash (trans ('auth.user'), '', Form::ALERT_ERROR); // Não existe o email.
    }
    catch (Exception $e) {
      Form::flash (trans ('auth.token'), '', Form::ALERT_ERROR); // Token inválido.
    }
    return Redirect::action (self::HOME_ACTION);
  }



  //============================================================
  // REGISTRATION
  //============================================================

  public function getRegister ()
  {
    return view ('auth.register');
  }

  /**
   * Handle a login request to the application.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function postLogin (Request $request)
  {
    $this->validate ($request, [
      'email' => 'required|email', 'password' => 'required',
    ]);

    $credentials = $request->only ('email', 'password');
    if ($this->auth->attempt ($credentials, $request->has ('remember'))) {
      $email = $request->email;
      $users = DB::table ('users')->where ('email', $email)->first ();

      if ($users && $users->active)
        return redirect ()->intended ($this->redirectPath ());
      else {
        $this->auth->logout ();
        return view ('auth.info',
          ['title' => trans ('auth.pending-approval_confirmation'), 'text' => trans ('auth.pending-approval')]);
      }
    }

    Form::flash (trans('admin.LOGIN_FAILED'),'', Form::ALERT_ERROR);

    return redirect ($this->loginPath ())
      ->withInput ($request->only ('email', 'remember'))
      ->withErrors ([
        'email' => $this->getFailedLoginMessage (),
      ]);

  }

  /**
   * @param Request $request
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function postRegister (Request $request)
  {

    $validator = $this->registrar->validator ($request->all ());

    if ($validator->fails ()) {
      $this->throwValidationException (
        $request, $validator
      );
    }

    $name     = Input::get ('name');
    $email    = Input::get ('email');
    $password = Hash::make (Input::get ('password'));

    // Delete existing non-activated user (if one exists).

    DB::table ('users')->where ('email', $email)->delete ();

    // Insert new user.

    $now = date ('Y-m-d H:i:s');

    $mailData = [
      'name'  => $name,
      'token' => Crypt::encrypt ($email),
    ];

    $id = DB::table ('users')->insertGetId ([
      'name'       => $name,
      'email'      => $email,
      'password'   => $password,
      'created_at' => $now,
      'updated_at' => $now,
    ]);

    Auth::loginUsingId ($id);

    switch (\Config::get ('app.registerMode')) {
      case 'auto':
        Mail::send ('emails.confirm', $mailData, function ($message) use ($email) {
          $message->to ($email)->subject (trans ('auth.confirm-subject')); // Registration confirmation.
        });
        return view ('auth.info', ['title' => trans ('auth.REGISTER'), 'text' => trans ('auth.sent')]);
        break;
      case 'confirm':
        $user = DB::table ('users')->where ('email', $email);
        $user->update (['pending' => 1]);
        return view ('auth.info',
          ['title' => trans ('auth.pending-approval_confirmation'), 'text' => trans ('auth.pending-approval')]);
        break;
    }


  }

}
