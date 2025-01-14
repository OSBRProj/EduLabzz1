<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/catalogo';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     *
     * My custom authentication
     *
     */

    //Import defautl libraries
    // use RedirectsUsers, ThrottlesLogins;

    public function showLoginForm()
    {
        // echo bcrypt('123456');
        // dd($this->guard()->attempt(
        //     ['name' => 'othon.neto.1', 'password' => '123456'], true
        // ));

        //My own login terms if inside attempt was everything ok
        // if (Auth::attempt(['name' => 'othon.neto.1', 'password' => '123456', 'terms' => 1]))
        // {
        //     return redirect()->intended($this->redirectPath());
        // }
        // else
        // {
        //     return view('auth.login');
        // }

        // session(['url.intended' => url()->previous()]);

        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string|min:6',
        ]);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        // dd($request->all());

        if(!$this->guard()->attempt( $this->credentials($request), $request->filled('remember') ))
        // Usar username
        if(strrpos($request->get('email'), "@") === false)
        {
            //Usou username
            return $this->guard()->attempt(
                ['ra' => $request->get('email'), 'password' => $request->get('password')], $request->filled('remember')
            );
        }
        else
        {
            //Usou email ou esta incorreto
            return $this->guard()->attempt(
                $this->credentials($request), $request->filled('remember')
            );
        }

        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        //

        \App\Services\GamificacaoService::loginIncrement();

        $user->update(['ultima_atividade' => date("Y-m-d H:i:s")]);

        \App\Metrica::create([
            'user_id' => $user->id,
            'titulo' => 'Acesso na plataforma'
        ]);

        if(session('url.intended') == env('APP_URL') || session('url.intended') == null)
        {
            if(Auth::user()->permissao != "A")
            {
                return redirect()->route('gestao.relatorios');
            }
            // else if(Auth::user()->permissao == "P")
            // {
            //     return redirect()->route('gestao.relatorios');
            // }
            // else if(Auth::user()->permissao == "G")
            // {
            //     return redirect()->route('gestao.relatorios');
            // }
            // else if(Auth::user()->permissao == "Z")
            // {
            //     return redirect()->route('gestao.relatorios');
            // }
            // else
            // {

            // }
        }

        // return redirect(session('url.intended'));
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        if(strpos(request()->path(), "/catalogo") !== false)
        {
            return redirect( env('APP_LOCAL') . substr(request()->path(), 0, strpos(request()->path(), "/catalogo")) . "/catalogo" );
        }

        return redirect( env('APP_LOCAL') . '/catalogo' );
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

}
