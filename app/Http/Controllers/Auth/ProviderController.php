<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    //

    public const GITHUB = 'github';
    public const GOOGLE = 'google';

    public function redirect($provider)
    {


        $previousUrl = session()->get('_previous')['url'] ?? null;

        if ($previousUrl) {
            $parsedUrl = parse_url($previousUrl);

            parse_str($parsedUrl['query'] ?? null, $urlParams);

            $continueUrl = isset($urlParams['continue']) ? $urlParams['continue'] : route('admin.home');

            session()->put('continue', $continueUrl);
        }

        if ($provider == self::GOOGLE) {
            return Socialite::driver($provider)->with(['prompt' => 'select_account'])->redirect();
        }

        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {


        try {
            $providerUser = Socialite::driver($provider)->user();

            if (User::where('email', $providerUser->getEmail())->where('provider_name', '<>', $provider)->exists()) {
                return to_route('login')->withErrors(['email' => 'This email uses different method to login.']);
            }

            $user = User::where([
                'provider_id' => $providerUser->id,
                'provider_name' => $provider,
            ])->first();


            if (!$user) {

                $user = User::create([
                    'name' => $providerUser->getName(),
                    'email' => $providerUser->getEmail(),
                    'username' => User::generateUserName($providerUser->getNickname() ?? $providerUser->getName()),
                    'email_verified_at' => now(),
                    'provider_token' => $providerUser->token,
                    'provider_id' => $providerUser->getId(),
                    'provider_name' => $provider,
                ])->assignRole('author');

                $userInfo = new UserInfo();
                $userInfo->user_id = $user->id;
                $userInfo->photo = $providerUser->avatar;


                if ($provider == self::GITHUB) {
                    $userInfo->bio = $providerUser->user['bio'];
                    $userInfo->github = $providerUser->user['html_url'];
                    $userInfo->website = $providerUser->user['blog'];
                    $userInfo->company = $providerUser->user['company'];
                }

                $userInfo->save();
            }

            Auth::login($user);

            $continueUrl = session()->get('continue', route('admin.index'));
            return redirect()->to($continueUrl);
        } catch (\Exception $e) {
            return to_route('login');
        }
    }
}
