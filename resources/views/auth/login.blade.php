<x-admin-layout single="true" title="{{ __('Log in') }}" class="d-flex flex-column">

    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="{{ route('admin.home') }}" class="navbar-brand navbar-brand-autodark">
                    <x-application-logo height="36" />
                </a>
            </div>
            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">@lang('Login to your account')</h2>
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4 text-center text-success" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-3">
                            <x-admin.input-label for="email_or_username" :value="__('Email or Username')" />
                            <x-admin.text-input id="email_or_username" type="text" name="email_or_username"
                                placeholder="your@email.com" autofocus autocomplete="off" :value="old('email_or_username','admin@admin.com')"
                                :invalid="$errors->has('email_or_username')" />
                            <x-admin.input-error :messages="$errors->get('email_or_username')" />
                        </div>

                        <!-- Password -->
                        <div class="mb-2">
                            <x-admin.input-label for="password" :value="__('Password')">

                                @if (Route::has('password.request'))
                                    <span class="form-label-description">
                                        <a href="{{ route('password.request') }}"> {{ __('Forgot your password?') }}</a>
                                    </span>
                                @endif
                            </x-admin.input-label>

                            <x-admin.text-input id="password" type="password" name="password" autocomplete="off"
                                placeholder="{{ __('Your password') }}" :value="old('password','password')" :invalid="$errors->has('password')" />

                            <x-admin.input-error :messages="$errors->get('password')" />

                        </div>


                        <!-- Remember Me -->

                        <div class="mb-2">
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" name="remember" />
                                <span class="form-check-label">{{ __('Remember me') }}</span>
                            </label>
                        </div>


                        <div class="form-footer">
                            <x-admin.primary-button class="w-100">
                                {{ __('Log in') }}
                            </x-admin.primary-button>
                        </div>

                    </form>

                </div>
                <div class="hr-text">@lang('or')</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col"><a href="{{ route('provider.redirect', 'github') }}" class="btn w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-github" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M9 19c-4.3 1.4 -4.3 -2.5 -6 -3m12 5v-3.5c0 -1 .1 -1.4 -.5 -2c2.8 -.3 5.5 -1.4 5.5 -6a4.6 4.6 0 0 0 -1.3 -3.2a4.2 4.2 0 0 0 -.1 -3.2s-1.1 -.3 -3.5 1.3a12.3 12.3 0 0 0 -6.2 0c-2.4 -1.6 -3.5 -1.3 -3.5 -1.3a4.2 4.2 0 0 0 -.1 3.2a4.6 4.6 0 0 0 -1.3 3.2c0 4.6 2.7 5.7 5.5 6c-.6 .6 -.6 1.2 -.5 2v3.5" />
                                </svg>
                                @lang('Login with Github')
                            </a></div>
                        <div class="col"><a href="{{ route('provider.redirect', 'google') }}"class="btn w-100">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-brand-google" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M17.788 5.108a9 9 0 1 0 3.212 6.892h-8"></path>
                                </svg>

                                @lang('Login with Google')
                            </a></div>
                    </div>
                </div>
            </div>

            @if (Route::has('register'))
                <div class="text-center text-muted mt-3">
                    @lang("Don't have account yet?") <a href="{{ route('register') }}" tabindex="-1">@lang('Register')</a>
                </div>
            @endif


        </div>
    </div>
</x-admin-layout>
