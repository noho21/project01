<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\AuthenticatedSessionController as BaseAuthenticatedSessionController;
use Illuminate\Http\Request;

class CustomAuthenticatedSessionController extends BaseAuthenticatedSessionController
{
    protected function authenticated(Request $request, $user)
    {
        return redirect()->route('product.index');
    }
}
