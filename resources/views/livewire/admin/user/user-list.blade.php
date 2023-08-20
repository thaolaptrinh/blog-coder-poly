<div>

    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        @lang('Users')
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <input type="search" class="form-control d-inline-block w-9 me-3"
                            placeholder="{{ __('Search') }}..." wire:model='search' />
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modal-new-user">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            @lang('New User')
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <!-- Content here -->
            <div class="row row-cards">
                @forelse ($users as $user)
                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-body p-4 text-center">
                                <span class="avatar avatar-xl mb-3 rounded"
                                    style="background-image: url({{ $user->info->photo }})">
                                    {{ $user->info->photo ? '' : get_initials($user->name) }}
                                </span>
                                <h3 class="m-0 mb-1"><a href="#">{{ $user->name }}</a></h3>
                                <div class="text-muted">{{ $user->email ?? '--' }}</div>
                                <div class="mt-3">
                                    <span class="badge bg-purple-lt">{{ $user->getRoleNames()[0] }}</span>
                                </div>
                            </div>
                            <div class="d-flex">
                                <a href="#" wire:click.prevent='editUser({{ $user }})' class="card-btn">
                                    @lang('Edit')</a>
                                <a href="#" wire:click.prevent='deleteUser({{ $user }})' class="card-btn">
                                    @lang('Delete')</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="container-xl d-flex flex-column justify-content-center">
                        <div class="empty">
                            <div class="empty-img"><img src="./static/illustrations/undraw_printing_invoices_5r4r.svg"
                                    height="128" alt="">
                            </div>
                            <p class="empty-title">@lang('No result not found')</p>
                            <p class="empty-subtitle text-secondary">
                                @lang("Try adjusting your search or filter to find what you're looking for")
                            </p>
                            <div class="empty-action">
                                <x-admin.primary-button wire:click="clearSearch">
                                    @lang('Refresh')
                                </x-admin.primary-button>

                            </div>
                        </div>
                    </div>
                @endforelse

            </div>
            <div class="d-flex mt-4">
                <div class="mx-auto">
                    {{ $users->links('livewire::bootstrap') }}
                </div>

            </div>

            <div wire:ignore.self class="modal modal-blur fade" id="modal-new-user" tabindex="-1" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">@lang('New User')</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form wire:submit.prevent='newUser'>
                            <div class="modal-body">

                                <!-- Name -->
                                <div class="mb-3">
                                    <x-admin.input-label for="name" :value="__('Name')" />
                                    <x-admin.text-input id="name" type="text" wire:model="name"
                                        placeholder="{{ __('Enter name') }}" autofocus autocomplete="off"
                                        wire:model='name' :invalid="$errors->has('name')" />
                                    <x-admin.input-error :messages="$errors->get('name')" />
                                </div>

                                <!-- Username -->
                                <div class="mb-3">
                                    <x-admin.input-label for="username" :value="__('Username')" />
                                    <x-admin.text-input id="username" type="text" wire:model="username"
                                        placeholder="{{ __('Enter username') }}" autofocus autocomplete="off"
                                        wire:model='username' :invalid="$errors->has('username')" />
                                    <x-admin.input-error :messages="$errors->get('username')" />
                                </div>


                                <!-- Email -->
                                <div class="mb-3">
                                    <x-admin.input-label for="email" :value="__('Email')" />
                                    <x-admin.text-input id="email" type="email" wire:model="email"
                                        placeholder="{{ __('Enter email') }}" autofocus autocomplete="off"
                                        wire:model='email' :invalid="$errors->has('email')" />
                                    <x-admin.input-error :messages="$errors->get('email')" />
                                </div>

                                <div class="mb-3">
                                    <x-admin.input-label for="role" :value="__('Role')" />
                                    <x-admin.select-options wire:model='role_id'>
                                        @foreach (\Spatie\Permission\Models\Role::all() as $role)
                                            <option value="{{ $role->id }}" class=""
                                                {{ $role->name == 'author' ? 'selected' : '' }}>
                                                {{ Str::ucfirst($role->name) }}
                                            </option>
                                        @endforeach
                                    </x-admin.select-options>
                                    <x-admin.input-error :messages="$errors->get('role_id')" style="display: block" />
                                </div>

                                <div class="mb-3">
                                    <x-admin.input-label for="status" :value="__('Active')" />
                                    <div>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model="status"
                                                checked="" value="1">
                                            <span class="form-check-label">@lang('Yes')</span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model="status"
                                                value="0">
                                            <span class="form-check-label">@lang('No')</span>
                                        </label>
                                    </div>

                                    <x-admin.input-error :messages="$errors->get('status')" style="display: block" />

                                </div>



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn me-auto"
                                    data-bs-dismiss="modal">@lang('Close')</button>
                                <button type="submit" class="btn btn-primary">@lang('Save')</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>



            <div wire:ignore.self class="modal modal-blur fade" id="modal-edit-user" tabindex="-1" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">@lang('Edit')</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form wire:submit.prevent='updateUser'>
                            <input type="hidden" wire:model='selected_user_id'>

                            <div class="modal-body">

                                <!-- Name -->
                                <div class="mb-3">
                                    <x-admin.input-label for="name" :value="__('Name')" />
                                    <x-admin.text-input id="name" type="text" wire:model="name"
                                        placeholder="{{ __('Enter name') }}" autofocus autocomplete="off"
                                        wire:model='name' :invalid="$errors->has('name')" />
                                    <x-admin.input-error :messages="$errors->get('name')" />
                                </div>

                                <!-- Username -->
                                <div class="mb-3">
                                    <x-admin.input-label for="username" :value="__('Username')" />
                                    <x-admin.text-input id="username" type="text" wire:model="username"
                                        placeholder="{{ __('Enter username') }}" autofocus autocomplete="off"
                                        wire:model='username' :invalid="$errors->has('username')" />
                                    <x-admin.input-error :messages="$errors->get('username')" />
                                </div>


                                <!-- Email -->
                                <div class="mb-3">
                                    <x-admin.input-label for="email" :value="__('Email')" />
                                    <x-admin.text-input id="email" type="email" wire:model="email"
                                        placeholder="{{ __('Enter email') }}" autofocus autocomplete="off"
                                        wire:model='email' :invalid="$errors->has('email')" />
                                    <x-admin.input-error :messages="$errors->get('email')" />
                                </div>

                                <div class="mb-3">
                                    <x-admin.input-label for="role" :value="__('Role')" />
                                    <x-admin.select-options wire:model='role_id'>
                                        @foreach (\Spatie\Permission\Models\Role::all() as $role)
                                            <option value="{{ $role->id }}">
                                                {{ Str::ucfirst($role->name) }}
                                            </option>
                                        @endforeach
                                    </x-admin.select-options>
                                    <x-admin.input-error :messages="$errors->get('role_id')" style="display: block" />
                                </div>

                                <div class="mb-3">
                                    <x-admin.input-label for="status" :value="__('Active')" />
                                    <div>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model="status"
                                                checked="" value="1">
                                            <span class="form-check-label">@lang('Yes')</span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model="status"
                                                value="0">
                                            <span class="form-check-label">@lang('No')</span>
                                        </label>
                                    </div>

                                    <x-admin.input-error :messages="$errors->get('status')" style="display: block" />

                                </div>



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn me-auto"
                                    data-bs-dismiss="modal">@lang('Close')</button>
                                <button type="submit" class="btn btn-primary">@lang('Update')</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>


        </div>
    </div>

</div>
