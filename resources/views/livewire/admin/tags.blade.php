<div>

    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        @lang('Tags')
                    </h2>
                </div>

                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-new">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            @lang('New Tag')
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
                                                type="checkbox" aria-label="Select all" wire:model="selectAll"
                                                wire:click="toggleSelectAll"></th>
                                        <th>@lang('Name')</th>
                                        <th>@lang('Description')</th>
                                        <th>@lang('Slug')</th>
                                        <th>@lang('Count posts')</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tags as  $tag)
                                        <tr>
                                            <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                    value="{{ $tag->id }}" wire:model="selectedTags"></td>
                                            <td>{{ $tag->name }}</a></td>
                                            <td style="width: 35%;">
                                                {{ $tag->description ?: '----' }}
                                            </td>
                                            <td>
                                                {{ $tag->slug }}
                                            </td>
                                            <td>
                                                {{ $tag->posts_count }}
                                            </td>

                                            <td class="text-end">
                                                <a href="javascript:;" class="btn btn-sm btn-primary"
                                                    wire:click.prevent='edit({{ $tag }})'>@lang('Edit')</a>
                                                <a href="javascript:;" class="btn btn-sm btn-danger"
                                                    wire:click.prevent='delete({{ $tag }})'>@lang('Delete')</a>
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
                        <div class="card-footer d-flex align-items-center">

                            {{-- <ul class="pagination m-0 ms-auto">
                           <li class="page-item disabled">
                               <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                   <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                                   <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                       height="24" viewBox="0 0 24 24" stroke-width="2"
                                       stroke="currentColor" fill="none" stroke-linecap="round"
                                       stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                       <path d="M15 6l-6 6l6 6" />
                                   </svg>
                                   prev
                               </a>
                           </li>
                           <li class="page-item"><a class="page-link" href="#">1</a></li>
                           <li class="page-item active"><a class="page-link" href="#">2</a></li>
                           <li class="page-item"><a class="page-link" href="#">3</a></li>
                           <li class="page-item"><a class="page-link" href="#">4</a></li>
                           <li class="page-item"><a class="page-link" href="#">5</a></li>
                           <li class="page-item">
                               <a class="page-link" href="#">
                                   next <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                                   <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                       height="24" viewBox="0 0 24 24" stroke-width="2"
                                       stroke="currentColor" fill="none" stroke-linecap="round"
                                       stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                       <path d="M9 6l6 6l-6 6" />
                                   </svg>
                               </a>
                           </li>
                       </ul> --}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div wire:ignore.self class="modal modal-blur fade" id="modal-new" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('New Tag')</h5>
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


    <div wire:ignore.self class="modal modal-blur fade" id="modal-edit" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Edit')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='update'>
                    <div class="modal-body">

                        <input type="hidden" wire:model='selected_id'>

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
