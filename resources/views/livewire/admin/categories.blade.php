<div>

    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        @lang('Categories')
                    </h2>
                </div>

                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modal-new-category">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            @lang('New Category')
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
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="d-flex gap-2">
                                    <x-admin.select-options wire:model='actionTarget'>
                                        <option value="" selected>-- @lang('Choose action') --</option>
                                        <option value="delete"> @lang('Delete')</option>
                                    </x-admin.select-options>
                                    <x-admin.primary-button
                                        wire:click='deleteSelected'>@lang('Apply')</x-admin.primary-button>
                                </div>
                                <div class="ms-auto text-muted">
                                    @lang('Search'):
                                    <div class="ms-2 d-inline-block">
                                        <input type="text" wire:model='search' class="form-control form-control-sm"
                                            aria-label="Search invoice">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter datatable table-striped">
                                <thead>
                                    <tr>
                                        <th class="w-1"><input class="form-check-input m-0 align-middle"
                                                type="checkbox" aria-label="Select all invoices" wire:model="selectAll"
                                                wire:click="toggleSelectAll"></th>
                                        <th>@lang('Name')</th>
                                        <th>@lang('Description')</th>
                                        <th>@lang('Slug')</th>
                                        <th>@lang('Count posts')</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as  $category)
                                        <tr>
                                            <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                    value="{{ $category->id }}" wire:model="selectedCategories"></td>
                                            <td> {{ str_repeat('-', $category->depth) }} {{ $category->name }}</a></td>
                                            <td style="width:
                                                    35%;">
                                                {{ $category->description ?: '----' }}
                                            </td>
                                            <td>
                                                {{ $category->slug }}
                                            </td>
                                            <td>
                                                {{ $category->posts_count }}
                                            </td>

                                            <td class="text-end">
                                                <a href="javascript:;" class="btn btn-sm btn-primary m-1"
                                                    wire:click.prevent='edit({{ $category }})'>@lang('Edit')</a>
                                                <a href="javascript:;" class="btn btn-sm btn-danger m-1"
                                                    wire:click.prevent='delete({{ $category }})'>@lang('Delete')</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-danger text-center">@lang('No result not found')</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{-- <div class="card-footer d-flex align-items-center">
                            <div class="ms-auto">
                                {{ $categories->links('pagination::bootstrap-4') }}
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div wire:ignore.self class="modal modal-blur fade" id="modal-new-category" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('New Category')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='store'>
                    <div class="modal-body">

                        <!-- Name -->
                        <div class="mb-3">
                            <x-admin.input-label for="name" :value="__('Name')" />
                            <x-admin.text-input id="name" type="text" placeholder="{{ __('Enter name') }}"
                                autofocus autocomplete="off" wire:model='name' :invalid="$errors->has('name')" />
                            <x-admin.input-error :messages="$errors->get('name')" />
                        </div>

                        <!-- Slug -->
                        <div class="mb-3">
                            <x-admin.input-label for="slug" :value="__('Slug')" />
                            <x-admin.text-input id="slug" type="text" placeholder="{{ __('Enter slug') }}"
                                autofocus autocomplete="off" wire:model='slug' :invalid="$errors->has('slug')" />
                            <x-admin.input-error :messages="$errors->get('slug')" />
                        </div>

                        <!-- Parent category -->


                        <div class="mb-3">
                            <x-admin.input-label for="parent_id" :value="__('Parent category')" />
                            <x-admin.select-options wire:model='parent_id'>
                                <option value="" selected>-- @lang('No Seleceted') --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {!! str_repeat('&nbsp;&nbsp;&nbsp;', $category->depth) !!} {{ $category->name }}
                                    </option>
                                @endforeach

                            </x-admin.select-options>
                            <x-admin.input-error :messages="$errors->get('parent_id')" style="display: block" />
                        </div>



                        <!-- Description -->
                        <div class="mb-3">
                            <x-admin.input-label for="description" :value="__('Description')" />
                            <x-admin.textarea wire:model='description' />
                            <x-admin.input-error :messages="$errors->get('description')" />
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


    <div wire:ignore.self class="modal modal-blur fade" id="modal-edit-category" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('New Category')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='update'>
                    <div class="modal-body">

                        <input type="hidden" wire:model='selected_category_id'>

                        <!-- Name -->
                        <div class="mb-3">
                            <x-admin.input-label for="name" :value="__('Name')" />
                            <x-admin.text-input id="name" type="text" placeholder="{{ __('Enter name') }}"
                                autofocus autocomplete="off" wire:model='name' :invalid="$errors->has('name')" />
                            <x-admin.input-error :messages="$errors->get('name')" />
                        </div>

                        <!-- Slug -->
                        <div class="mb-3">
                            <x-admin.input-label for="slug" :value="__('Slug')" />
                            <x-admin.text-input id="slug" type="text" placeholder="{{ __('Enter slug') }}"
                                autofocus autocomplete="off" wire:model='slug' :invalid="$errors->has('slug')" />
                            <x-admin.input-error :messages="$errors->get('slug')" />
                        </div>

                        <!-- Parent category -->


                        <div class="mb-3">
                            <x-admin.input-label for="parent_id" :value="__('Parent category')" />
                            <x-admin.select-options wire:model='parent_id'>
                                @forelse  (\App\Models\Category::where('id','<>',$selected_category_id) as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == $parent_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @empty
                                    <option value="">@lang('None')</option>
                                @endforelse

                            </x-admin.select-options>
                            <x-admin.input-error :messages="$errors->get('parent_id')" style="display: block" />
                        </div>



                        <!-- Description -->
                        <div class="mb-3">
                            <x-admin.input-label for="description" :value="__('Description')" />
                            <x-admin.textarea wire:model='description' />
                            <x-admin.input-error :messages="$errors->get('description')" />
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




</div>
