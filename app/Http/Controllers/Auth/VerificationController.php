<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Show the verification status.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function showVerificationStatus(Request $request)
    {
        $user = $request->user(); // Get the authenticated user

        return view('auth.verification-status', [
            'isVerified' => $user->hasVerifiedEmail(), // Pass verification status to the view
        ]);
    }
}
