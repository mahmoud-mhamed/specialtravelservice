<?php

namespace App\Actions\User;

use App\Classes\BaseAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLogoutAction extends BaseAction
{
    public function handle(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect()->route('dashboard.login.view-form');
    }
}
