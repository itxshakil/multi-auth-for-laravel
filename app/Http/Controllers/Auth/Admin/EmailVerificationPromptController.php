<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|Response
    {
        return $request->user('admin')->hasVerifiedEmail()
                    ? redirect()->intended(RouteServiceProvider::ADMIN_HOME)
                    : Inertia::render('Auth/Admin/VerifyEmail', ['status' => session('status')]);
    }
}
