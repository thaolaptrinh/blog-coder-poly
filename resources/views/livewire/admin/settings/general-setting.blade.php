<form wire:submit.prevent="save">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <x-admin.input-label for="site_name" :value="__('Site Name')" />
                <x-admin.text-input id="site_name" type="text" wire:model="site_name" placeholder="{{ __('Site Name') }}"
                    :invalid="$errors->has('site_name')" autofocus autocomplete="off" />
                <x-admin.input-error :messages="$errors->get('site_name')" class="mt-2" />
            </div>
        </div>


        <div class="col-md-6">
            <div class="mb-3">
                <x-admin.input-label for="site_status" :value="__('Site Status')" />
                <x-admin.select-options id="site_status" wire:model="site_status">
                    @foreach (\App\Enums\BlogStatus::cases() as $case)
                        <option value="{{ $case->value }}">{{ __($case->getLabelText()) }}</option>
                    @endforeach

                </x-admin.select-options>
                <x-admin.input-error :messages="$errors->get('site_status')" class="mt-2" />
            </div>
        </div>


        <div class="mb-3">
            <x-admin.input-label for="site_description" :value="__('Site Description')" />
            <x-admin.textarea id="site_description" wire:model="site_description" id="site_description"
                :invalid="$errors->has('site_description')" autofocus autocomplete="off"></x-admin.textarea>
            <x-admin.input-error :messages="$errors->get('site_description')" class="mt-2" />
        </div>

        <div class="mb-3">
            <x-admin.input-label for="site_keywords" :value="__('Site Keywords')" />
            <x-admin.textarea id="site_keywords" wire:model="site_keywords" id="site_keywords" :invalid="$errors->has('site_keywords')"
                autofocus autocomplete="off"></x-admin.textarea>
            <x-admin.input-error :messages="$errors->get('site_keywords')" class="mt-2" />
        </div>

        <x-admin.primary-button class="w-auto">
            {{ __('Save') }}
        </x-admin.primary-button>
        @if (session('status') === 'general-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-success">
                {{ __('Saved.') }}
            </p>
        @endif
    </div>
</form>
