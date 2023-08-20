<x-admin-layout single="true" title="{{ __('Log in') }}" class="d-flex flex-column">

    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="{{ route('admin.home') }}" class="navbar-brand navbar-brand-autodark">
                    <x-application-logo height="36" />
                </a>
            </div>

            <form class="card card-md" method="POST" action="{{ route('register') }}" autocomplete="off" novalidate>
                @csrf
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">@lang('Create new account')</h2>


                    <!-- Name -->
                    <div class="mb-3">
                        <x-admin.input-label for="name" :value="__('Name')" />
                        <x-admin.text-input id="name" type="text" name="name" :value="old('name')"
                            :invalid="$errors->has('name')" autofocus autocomplete="name" placeholder="{{ __('Enter name') }}" />
                        <x-admin.input-error :messages="$errors->get('name')" />
                    </div>



                    <!-- Username -->
                    <div class="mb-3">
                        <x-admin.input-label for="username" :value="__('Username')" />
                        <x-admin.text-input id="username" type="text" name="username" :value="old('username')"
                            :invalid="$errors->has('email')" autofocus autocomplete="username" placeholder="{{ __('Enter username') }}"  />
                        <x-admin.input-error :messages="$errors->get('username')" />
                    </div>


                    <!-- Email Address -->
                    <div class="mb-3">
                        <x-admin.input-label for="email" :value="__('Email')" />
                        <x-admin.text-input id="email" type="email" name="email" :value="old('email')"
                            :invalid="$errors->has('email')" autocomplete="email" placeholder="{{ __('Enter email') }}"  />
                        <x-admin.input-error :messages="$errors->get('email')" />
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <x-admin.input-label for="password" :value="__('Password')" />

                        <x-admin.text-input id="password" type="password" name="password" autocomplete="new-password" placeholder="{{ __('Password') }}" 
                            :invalid="$errors->has('password')" />

                        <x-admin.input-error :messages="$errors->get('password')" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <x-admin.input-label for="password_confirmation" :value="__('Confirm Password')" />

                        <x-admin.text-input id="password_confirmation" type="password" name="password_confirmation"
                            autocomplete="new-password" :invalid="$errors->has('password_confirmation')" placeholder="{{ __('Confirm Password') }}" />

                        <x-admin.input-error :messages="$errors->get('password_confirmation')" />
                    </div>

                    <div class="form-footer">
                        <x-admin.primary-button class="w-100">
                            {{ __('Register') }}
                        </x-admin.primary-button>
                    </div>
                </div>
            </form>
            @if (Route::has('login'))
                <div class="text-center text-muted mt-3">
                    @lang(' Already have account?') <a href="{{ route('login') }}" tabindex="-1">@lang('Log in')</a>
                </div>
            @endif
        </div>
    </div>




</x-admin-layout>
