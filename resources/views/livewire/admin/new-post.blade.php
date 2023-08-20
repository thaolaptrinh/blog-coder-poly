<div>
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        @lang('New Post')
                    </h2>
                </div>

            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <form wire:submit.prevent='store'>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-8">

                                <div class="mb-3">
                                    <x-admin.input-label :value="__('Title')" />
                                    <x-admin.text-input wire:model="title" :invalid="$errors->has('title')" />
                                    <x-admin.input-error :messages="$errors->get('title')" />
                                </div>


                                <div class="mb-3">
                                    <x-admin.input-label :value="__('Slug')" />
                                    <x-admin.text-input wire:model="slug" :invalid="$errors->has('slug')" />
                                    <x-admin.input-error :messages="$errors->get('slug')" />
                                </div>

                                <div class="row">
                                    <div class="col-md-4">

                                        <div class="mb-3">
                                            <x-admin.input-label :value="__('Category')" />
                                            <x-admin.select-options wire:model="category_id">
                                                <option value="" selected>-- @lang('No Seleceted') --</option>
                                                @foreach (\App\Models\Category::all() as $category)
                                                    <option value="{{ $category->id }}">
                                                        {{ Str::ucfirst($category->name) }}
                                                    </option>
                                                @endforeach
                                            </x-admin.select-options>
                                            <x-admin.input-error :messages="$errors->get('category_id')" style="display: block" />
                                        </div>
                                    </div>

                                    <div class="col-md-3">

                                        <div class="mb-3">
                                            <x-admin.input-label :value="__('Status')" />
                                            <x-admin.select-options wire:model="status">
                                                @foreach (\App\Enums\PostStatus::cases() as $case)
                                                    <option value="{{ $case->value }}">
                                                        {{ __(Str::ucfirst($case->name)) }}
                                                    </option>
                                                @endforeach
                                            </x-admin.select-options>
                                            <x-admin.input-error :messages="$errors->get('status')" style="display: block" />
                                        </div>
                                    </div>

                                    <div class="col-md-3">

                                        <div class="mb-3">
                                            <x-admin.input-label :value="__('Layout')" />
                                            <x-admin.select-options wire:model="layout">
                                                @foreach (\App\Enums\PostLayout::cases() as $case)
                                                    <option value="{{ $case->value }}">
                                                        {{ __(Str::ucfirst($case->name)) }}
                                                    </option>
                                                @endforeach
                                            </x-admin.select-options>
                                            <x-admin.input-error :messages="$errors->get('layout')" style="display: block" />
                                        </div>
                                    </div>


                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <x-admin.input-label :value="__('Private')" />
                                            <x-admin.select-options wire:model="is_private">
                                                <option value="0">@lang('No')</option>
                                                <option value="1">@lang('Yes')</option>
                                            </x-admin.select-options>
                                            <x-admin.input-error :messages="$errors->get('is_private')" style="display: block" />
                                        </div>
                                    </div>



                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="mb-3">
                                    <div class="form-label">@lang('Thumbnail')</div>
                                    <input type="file" wire:model='thumbnail' class="form-control">

                                    @if ($thumbnail?->temporaryUrl())
                                        <img src="{{ $thumbnail->temporaryUrl() }}" alt="{{ __('Thumbnail') }}"
                                            style="max-width: 230px; max-height: 230px;margin-top: 10px;" />
                                    @else
                                        <img src="https://imgs.search.brave.com/Bnih5OaEx311pSibhBdL7BVSCg0rs96EYZHLu3IaKr0/rs:fit:860:0:0/g:ce/aHR0cHM6Ly9kZXZl/bG9wZXJzLmVsZW1l/bnRvci5jb20vZG9j/cy9hc3NldHMvaW1n/L2VsZW1lbnRvci1w/bGFjZWhvbGRlci1p/bWFnZS5wbmc"
                                            style="max-width: 230px; max-height: 230px;margin-top: 10px;" />
                                    @endif

                                </div>
                            </div>

                        </div>
                        <div wire:ignore class="mb-3">
                            <x-admin.input-label :value="__('Content')" />
                            <x-admin.textarea id="tinymce-editor" wire:model="body" />
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">@lang('Save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @includeIf('admin.tiny-mce')

</div>
