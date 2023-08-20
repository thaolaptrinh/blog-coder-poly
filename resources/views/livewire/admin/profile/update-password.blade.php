<form wire:submit.prevent="save">

    <div class="mb-3">
        <x-admin.input-label for="current_password" :value="__('Current Password')" />
        <x-admin.text-input id="current_password" wire:model="current_password" type="password"
            autocomplete="current-password" :invalid="$errors->has('current_password')" />
        <x-admin.input-error :messages="$errors->get('current_password')" class="mt-2" />
    </div>

    <div class="mb-3">

        <x-admin.input-label for="password" :value="__('New Password')" />
        <x-admin.text-input id="password" wire:model="password" type="password" autocomplete="new-password"
            :invalid="$errors->has('password')" />
        <x-admin.input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <div class="mb-3">

        <x-admin.input-label for="password_confirmation" :value="__('Confirm Password')" />
        <x-admin.text-input id="password_confirmation" wire:model="password_confirmation" type="password"
            autocomplete="new-password" :invalid="$errors->has('password_confirmation')" />
        <x-admin.input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>

    <div class="flex items-center gap-4">
        <x-admin.primary-button class="btn btn-primary">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-success">
                    {{ __('Saved.') }}
                </p>
            @endif
    </div>
</form>
