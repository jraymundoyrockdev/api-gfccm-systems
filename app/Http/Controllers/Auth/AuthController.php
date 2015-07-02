<?php

namespace ApiGfccm\Http\Controllers\Auth;

use ApiGfccm\Models\User;
use Validator;
use ApiGfccm\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use ApiGfccm\Services\Validation\AuthValidator;
use Illuminate\Routing\Redirector;
use Illuminate\Auth\AuthManager;
use Illuminate\Session\SessionManager;

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

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Redirector
     */
    protected $redirect;

    /**
     * @var AuthValidator
     */
    protected $validator;

    /**
     * @var AuthManager
     */
    protected $auth;

    /**
     * @var SessionManager
     */
    protected $session;

    use AuthenticatesAndRegistersUsers;

    /**
     * @param AuthValidator $validator
     * @param AuthManager $auth
     * @param Request $request
     * @param Redirector $redirect
     * @param SessionManager $session
     */
    public function __construct(
        AuthValidator $validator,
        AuthManager $auth,
        Request $request,
        Redirector $redirect,
        SessionManager $session
    ){
        //$this->middleware('guest', ['except' => 'getLogout']);

        $this->validator = $validator;
        $this->request = $request;
        $this->redirect = $redirect;
        $this->auth = $auth;
        $this->session = $session;
    }


    /**
     * Show the login form
     *
     * @return mixed
     */
    public function getIndex()
    {
        if ($this->request->ajax()) {
            $this->session->forget('url.intended');
        }

        return View::make('auth.login');
    }


    /**
     * Show the login form
     *
     * @return mixed
     */
    public function postIndex()
    {
        // Pick up the honeypot field to stop bots, return to the login screen, no message
        if ($this->request->get('potter')) {
            return $this->redirect->to('auth/login')->withInput();
        }

        if (!$this->validator->with($this->request->all())->passes()) {
            return $this->redirect->to('auth/login')->withErrors($this->validator->errors());
        }

        if ($this->auth->attempt([
            'username' => $this->request->get('username'),
            'password' => $this->request->get('password')
        ])
        ) {
            return $this->redirect->intended('/');
        }

        $this->session->flash('failed', trans('auth.incorrect_username_or_password'));
        return $this->redirect->to('auth/login')->withInput();
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'firstname' => $data['name'],
            'lastname' => $data['email'],
        ]);
    }

    /**
     * Log the user out
     *
     * @return mixed
     */
    public function getLogout()
    {
        $this->auth->logout();
        return View::make('auth.logout');
    }
}
