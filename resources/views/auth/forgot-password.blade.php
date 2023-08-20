<x-admin-layout single="true" class="d-flex flex-column" :title="__('Forgot your password?')">

    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="{{ route('admin.home') }}" class="navbar-brand navbar-brand-autodark">
                    <x-application-logo height="36" />
                </a>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-center text-success" :status="session('status')" />


            <form class="card card-md" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">@lang('Forgot password')</h2>
                    <p class="text-muted mb-4">
                        @lang('Enter your email address and your password will be reset and emailed to you.')
                    </p>


                    <!-- Email Address -->
                    <div class="mb-3">
                        <x-admin.input-label for="email" :value="__('Email address')" />
                        <x-admin.text-input id="email" type="email" name="email" :value="old('email')" autofocus
                            placeholder="{{ __('Enter email') }}" />
                        <x-admin.input-error :messages="$errors->get('email')" style="display: block" />
                    </div>

                    <div class="form-footer">
                        <x-admin.primary-button class="w-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                                <path d="M3 7l9 6l9 -6" />
                            </svg>
                            @lang('Send me new password')
                        </x-admin.primary-button>

                    </div>
                </div>
            </form>
            @if (Route::has('login'))
                <div class="text-center text-muted mt-3">
                    <a href="{{ route('login') }}">@lang('Log in')</a>
                </div>
            @endif

        </div>
    </div>

</x-admin-layout>
