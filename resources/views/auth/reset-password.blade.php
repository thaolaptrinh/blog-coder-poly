<x-admin-layout single="true" title="{{ __('Reset Password') }}" class="d-flex flex-column">

    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="{{ route('admin.home') }}" class="navbar-brand navbar-brand-autodark">
                    <x-admin.application-logo height="36" />
                </a>
            </div>
            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">@lang('Reset Password')</h2>


                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf

                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Email Address -->
                        <input type="hidden" name="email" value="{{ $request->email }}">



                        <!-- Password -->
                        <div class="mb-3">
                            <x-admin.input-label for="password" :value="__('Password')" />
                            <x-admin.text-input id="password" type="password" name="password"
                                autocomplete="new-password" />
                            <x-admin.input-error :messages="$errors->get('password')" style="display: block" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">

                            <x-admin.input-label for="password_confirmation" :value="__('Confirm Password')" />

                            <x-admin.text-input id="password_confirmation" type="password" name="password_confirmation"
                                autocomplete="new-password" />

                            <x-admin.input-error :messages="$errors->get('password_confirmation')" style="display: block" />
                        </div>

                        <div class="form-footer">
                            <x-admin.primary-button class="w-100">
                                {{ __('Reset Password') }}
                                </x-primary-button>
                        </div>
                    </form>
                </div>

            </div>




        </div>
    </div>
</x-admin-layout>
