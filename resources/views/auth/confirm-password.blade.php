<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-admin.input-label for="password" :value="__('Password')" />

            <x-admin.text-input id="password" type="password" name="password" required autocomplete="current-password" />

            <x-admin.input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="form-footer">
            <x-admin.primary-button class="w-100">
                {{ __('Confirm') }}
            </x-admin.primary-button>
        </div>

    </form>
</x-guest-layout>
