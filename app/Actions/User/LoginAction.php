<?php

namespace App\Actions\User;

use App\Classes\BaseAction;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginAction extends BaseAction
{
    public function handle(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password') + ['is_active' => true])) {
            $request->session()->regenerate();
            return Redirect::route('dashboard.home');
        }
        return back()->withErrors([
            'email' => trans('auth.failed'),
        ])->onlyInput('email');
    }

    public function viewForm(): \Inertia\Response|\Inertia\ResponseFactory
    {
        $this->pageTitle(__('message.login'));
        return inertia('Users/Login');
    }
}
