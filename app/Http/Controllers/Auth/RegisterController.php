<?php

namespace App\Http\Controllers\Auth;

use App\Models\Config;
use App\Models\User;
use App\Http\Controllers\Controller;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param \SocialiteProviders\Manager\OAuth2\User $user
     * @return \App\Models\User
     */
    protected function create(\SocialiteProviders\Manager\OAuth2\User $user)
    {
        return User::create([
            'name' => $user->getNickname(),
            'battlenet_id' => $user->getId(),
            'avatar' => $user->getAvatar() ?: null,
        ]);
    }

    /**
     * Returns first record or create
     * @param \SocialiteProviders\Manager\OAuth2\User $user
     * @return mixed
     */
    public function loginOrCreate(\SocialiteProviders\Manager\OAuth2\User $user)
    {
        $this->isAllowedToRegister($user);

        return User::firstOrCreate(
            ['battlenet_id' => $user->getId()],
            [
                'name' => $user->getNickname(),
                'avatar' => $user->getAvatar() ?: null,
                'profile_data' => []
            ]
        );
    }

    /**
     * Whitelisting
     */
    public function isAllowedToRegister(\SocialiteProviders\Manager\OAuth2\User $user)
    {
        $whitelist = Config::where('key', Config::KEY_WHITELISTED_UIDS)->firstOrFail()->value;
        if (!in_array($user->getId(), $whitelist)) {
            return abort('403', 'Not whitelisted - #'.$user->getId());
        };
    }

    /**
     * Redirect the user to the authentication page for the provider.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectAuthenticationPage()
    {
        return Socialite::driver('battlenet')->redirect();
    }

    /** Battlenet callback
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function callback(Request $request)
    {
        try {
            $user = Socialite::with('battlenet')->user();
        }
        catch (InvalidStateException $exception){
            return redirect('/');
        }
        Auth::login($this->loginOrCreate($user), true);
        return redirect('/')->with(['logged_in' => true]);
    }

}
