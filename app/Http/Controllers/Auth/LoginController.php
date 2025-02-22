<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Services\AuthService;
use App\Utils\MessagesUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    // get view for login
    public function getLogin()
    {
        if (Auth::check()) {
            // if logged in successfully
            return redirect()->route('user.index');
        } else {
            // set session save previous url
            if (!session()->has('url.intended')) {
                session(['url.intended' => url()->previous()]);
            }
            return view('pages.auth.login');
        }

    }

    /**
     * @param LoginRequest $request
     * @return
     */
    // check auth is logged in
    public function postLogin(LoginRequest $request)
    {
        // check login to redirect
        if ($this->authService->login($request)) {
            return redirect()->intended(session()->get('url.intended')); // redirect to previous page
            // return redirect()->route('user.index');
        } else {
            return redirect()->back()->withInput()->with('error', MessagesUtil::getMessage('ECL016'));
        }
    }

    public function checkEmailExists(Request $request)
    {
        $user = User::where('email', $request->email)
                ->whereNull('deleted_date')->first();
        return $this->authService->emailExists($user);
    }

    /**
     * action admincp/logout
     * @return RedirectResponse
     */
    public function getLogout()
    {
        // logout current logged in user
        Auth::logout();
        return redirect()->route('login');
    }
}
