<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Socialite;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function redirectToProvider()
    {

        return Socialite::driver('github')->redirect();
    }


    public function handleProviderCallback()
    {


        $githubUser = Socialite::driver('github')->user();
        $user = User::where('provider_id', $githubUser->getId())->first();

        if(!$user){
            $user = User::create([
                'provider' => 'github',
                'provider_id' => $githubUser->getId(),
                'name' => $githubUser->getNickname(),
                'email' => $githubUser->getEmail(),
                'role_id' => 2,
                'created_at' =>  Carbon::now(),
            ]);    
        }
      
        Auth::login($user, true);
        return redirect($this->redirectTo);

        // DB::table('users')->insert([
        //     'name' => $gitHubUser->nickname(),
        //     'email' => $gitHubUser->getEmail(),
        //     'role_id' => 2,
        //     'created_at' => Carbon::now(),
        // ]);

        // // OAuth Two Providers
        // $token = $user->token;
        // $refreshToken = $user->refreshToken; // not always provided
        // $expiresIn = $user->expiresIn;

        // // OAuth One Providers
        // $token = $user->token;
        // $tokenSecret = $user->tokenSecret;

        // // All Providers
        // $user->getId();
        // $user->getNickname();
        // $user->getName();
        // $user->getEmail();

      
    }
}
