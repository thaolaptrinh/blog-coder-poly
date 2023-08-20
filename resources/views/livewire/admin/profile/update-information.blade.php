<form wire:submit.prevent='save'>



    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-3">
            @if ($newPhoto?->temporaryUrl())
                <img class="avatar avatar-xl" src="{{ $newPhoto->temporaryUrl() }}" alt="{{ __('User profile picture') }}"
                    class="profile-user-img img-fluid img-circle" />
            @else
                <img class="avatar avatar-xl" src="{{ auth()->user()->info->photo }}"
                    alt="{{ __('User profile picture') }}" class="profile-user-img img-fluid img-circle" />
            @endif
        </div>
        <div class="col-9">
            <div class="mb-3">
                <input type="file" class="form-control" wire:model="newPhoto">
            </div>

        </div>

    </div>


    <div class="row mt-3">

        <div class="col-md-6">
            <div class="mb-3">
                <x-admin.input-label for="name" :value="__('Name')" />
                <x-admin.text-input id="name" wire:model="name" type="text" :invalid="$errors->has('name')" autofocus
                    autocomplete="name" />
                <x-admin.input-error :messages="$errors->get('name')" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <x-admin.input-label for="username" :value="__('Username')" />
                <x-admin.text-input id="username" wire:model="username" type="text" :invalid="$errors->has('username')" autofocus
                    autocomplete="name" />
                <x-admin.input-error :messages="$errors->get('username')" />
            </div>
        </div>

        <div class="col-12">
            <div class="mb-3">
                <x-admin.input-label for="bio" :value="__('Bio')" />
                <x-admin.textarea id="bio" wire:model="bio" type="text" />
                <x-admin.input-error :messages="$errors->get('bio')" />

            </div>
        </div>

        <div class="mb-3 col-md-6">
            <x-admin.input-label for="email" :value="__('Email')" />
            <x-admin.text-input id="email" wire:model="email" type="text" :invalid="$errors->has('email')"
                autocomplete="email" />
            <x-admin.input-error :messages="$errors->get('email')" />

        </div>


        <div class="mb-3 col-md-6">
            <x-admin.input-label for="company" :value="__('Company')" />
            <x-admin.text-input id="company" wire:model="company" type="text" autocomplete="company" />
            <x-admin.input-error :messages="$errors->get('company')" />

        </div>

        <div class="mb-3 col-md-6">
            <x-admin.input-label for="job_title" :value="__('Job Title')" />
            <x-admin.text-input id="job_title" wire:model="job_title" type="text" autocomplete="job_title" />
            <x-admin.input-error :messages="$errors->get('job_title')" />

        </div>
        <div class="mb-3 col-md-6">
            <x-admin.input-label for="github" :value="__('Github')" />
            <x-admin.text-input id="github" wire:model="github" type="text" autocomplete="github" />
            <x-admin.input-error :messages="$errors->get('github')" />
        </div>


        <div class="mb-3 col-md-6">
            <x-admin.input-label for="linkedin" :value="__('Linkedin')" />
            <x-admin.text-input id="linkedin" wire:model="linkedin" type="text" autocomplete="linkedin" />
            <x-admin.input-error :messages="$errors->get('linkedin')" />
        </div>

        <div class="mb-3 col-md-6">
            <x-admin.input-label for="website" :value="__('Website')" />
            <x-admin.text-input id="website" wire:model="website" type="text" autocomplete="website" />
            <x-admin.input-error :messages="$errors->get('website')" />

        </div>


    </div>


    <div class="flex items-center gap-4">
        <x-admin.primary-button>{{ __('Save') }}</x-primary-button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-success">
                    {{ __('Saved.') }}
                </p>
            @endif
    </div>

</form>
