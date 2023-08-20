<div>
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        @lang('All Posts')
                    </h2>
                </div>

                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">

                        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            @lang('New Post')
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
                                        <th>@lang('Thumbnail')</th>
                                        <th>@lang('Title')</th>
                                        <th>@lang('Author')</th>
                                        <th>@lang('Categories')</th>
                                        <th>@lang('Tags')</th>
                                        <th>@lang('Date')</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($posts as  $post)
                                        <tr>
                                            <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                    value="{{ $post->id }}" wire:model="selectedPosts"></td>
                                            <td>
                                                <img src="{{ $post->thumbnail }}" alt="thumbnail"
                                                    style="max-width: 100px;max-height: 100px">
                                            </td>
                                            <td style="width: 20%;"><a
                                                    href="{{ $post->url }}">{{ $post->title }}</a></td>
                                            <td>
                                                {{ $post->author?->name }}
                                            </td>

                                            <td>
                                                @forelse ($post->categories as $category)
                                                    <a href="#">{{ $category->name }}</a>
                                                @empty
                                                    ---
                                                @endforelse

                                            </td>

                                            <td>
                                                @foreach ($post->tags as $tag)
                                                    <a href="#">{{ $tag->name }}</a>
                                                @endforeach
                                            </td>


                                            <td>
                                                {{ $post->published_at }}
                                            </td>


                                            <td class="d-grid text-end">
                                                <a href="{{ route('admin.posts.edit', $post->id) }}"
                                                    class="btn btn-sm btn-primary m-1">@lang('Edit')</a>
                                                <a href="{{ route('guest.post', $post->slug) }}"
                                                    class="btn btn-sm btn-secondary m-1"
                                                    target="_blank">@lang('View')</a>
                                                <a href="javascript:;" class="btn btn-sm btn-danger m-1"
                                                    wire:click.prevent='delete({{ $post }})'>@lang('Delete')</a>
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

                            <div class="ms-auto">
                                {{ $posts->links('livewire::bootstrap') }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


</div>
