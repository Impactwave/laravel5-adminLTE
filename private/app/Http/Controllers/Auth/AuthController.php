<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use League\Flysystem\Util;

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

    public function getConfirmEmail($token)
    {
        try {
            $email = Crypt::decrypt($token);
            $userQuery = DB::table('users')->where('email', $email);
                $user = $userQuery->first();

            if (isset($user))
            {
                switch (\Config::get('app.registerMode')) {
                    case 'auto':
                        $userQuery->update(['active' => 1]);
                        Util::flash (trans ('auth.confirmed'), '', Util::ALERT_SUCCESS); // Foi enviado um email.
                        return view ('auth/login');
                        break;
                    case 'confirm':
                        $userQuery->update(['pending' => 1]);
                        return view ('info', ['title' => trans('auth.pending-approval_confirmation') , 'text' => trans('auth.pending-approval')]);
                        break;
                }

            } else Util::flash(trans('auth.user'), '', Util::ALERT_ERROR); // Não existe o email.
        } catch (Exception $e) {
            Util::flash(trans('auth.token'), '', Util::ALERT_ERROR); // Token inválido.
        }
        return Redirect::action(self::HOME_ACTION);
    }


    //============================================================
    // LOGIN
    //============================================================
    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $email = $request->email;
        $users = DB::table('users')->where('email', $email)->first();

        if ($users->active){

            if ($this->auth->attempt($credentials, $request->has('remember'))) {
                return redirect()->intended($this->redirectPath());
            }

            return redirect($this->loginPath())
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    'email' => $this->getFailedLoginMessage(),
                ]);

        }
        else
        {
            return view ('info', ['title' => trans('auth.pending-approval_confirmation') , 'text' => trans('auth.pending-approval')]);
        }





    }



    //============================================================
    // REGISTRATION
    //============================================================

    public function getRegister()
    {
        return view('auth.register');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postRegister(Request $request)
    {

        $validator = $this->registrar->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        /*
        $validator = $this->registrar->validator([
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email,null,null,active,1',
            // email must not exist on users or active=0
            'password'  => 'required|min:8',
            'password2' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            $this->throwValidationException("", $validator);
        }*/

        $name = Input::get('name');
        $email = Input::get('email');
        $password = Hash::make(Input::get('password'));

        // Delete existing non-activated user (if one exists).

        DB::table('users')->where('email', $email)->delete();

        // Insert new user.

        $now = date('Y-m-d H:i:s');

        $mailData = [
            'name' => $name,
            'token' => Crypt::encrypt($email)
        ];



        $id = DB::table('users')->insertGetId([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'created_at' => $now,
            'updated_at' => $now
        ]);

        Auth::loginUsingId($id);



        switch (\Config::get('app.registerMode')) {
            case 'auto':
                Mail::send ('emails.confirm', $mailData, function ($message) use ($email) {
                    $message->to ($email)->subject (trans ('auth.confirm-subject')); // Confirmação do registo.
                });
                return view ('info', ['title' => trans('auth.REGISTER') , 'text' => trans('auth.sent')]);
                break;
            case 'confirm':
                $user = DB::table('users')->where('email', $email);
                $user->update(['pending' => 1]);
                return view ('info', ['title' => trans('auth.pending-approval_confirmation') , 'text' => trans('auth.pending-approval')]);
                break;
        }



    }




    /**
     * Create a new authentication controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard $auth
     * @param  \Illuminate\Contracts\Auth\Registrar $registrar
     * @return void
     */
    public function __construct(Guard $auth, Registrar $registrar)
    {
        $this->auth = $auth;
        $this->registrar = $registrar;

        $this->middleware('guest', ['except' => 'getLogout']);
    }

}
