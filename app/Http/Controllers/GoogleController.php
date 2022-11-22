<?php

namespace App\Http\Controllers;

use App\Services\UserServices;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * GoogleController constructor.
     *
     * @param UserServices $services
     */
    public function __construct(
        protected UserServices $services,
    ) {
    }

    /**
     * For redirect to google sign in page.
     *
     */
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * For google callback method.
     *
     * @return mixed
     */
    public function googleCallback()
    {
        $user = Socialite::driver('google')->user();
        $data = $this->services->createUser($user->user);
        Auth::login($data);

        return redirect('/home');
    }
}
