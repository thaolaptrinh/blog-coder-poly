<div id="fZilIo-mysearch">
    <div class="fZilIo-mysearch-container">
        <div class="search-form" role="search">
            <input class="search-input" placeholder="{{ __('Search') }}" type="text" wire:model="search">
        </div>
        <button aria-label="Search" class="fZilIo-mysearch-close search-hidden"></button>
    </div>
    <div class="search-section">

        <div class="my-ajax">
            @forelse  ($posts as $post)
                <div class="search-box">
                    <div class="search-thumb">
                        <a class="post-filter-link" href="">
                            <img class="snip-thumbnail lazy-img" alt="{{ $post->title }}" src="{{ $post->thumbnail }}"
                                src="{{ $post->thumbnail }}">
                        </a>
                    </div>
                    <div class="entery-category-box">
                        <h2 class="entry-title"><a href="{{ route('guest.post', $post->slug) }}">
                                {{ $post->title }}
                            </a></h2>
                        <div class="post-snip"><span class="post-date">{{ $post->published_at }}</span>
                        </div>
                    </div>
                </div>
            @empty
                @if (!empty($search))
                    <span class="error-status"><b>@lang('Error')</b>&nbsp;@lang('No results found')</span>
                @endif
            @endforelse

            @if ($isShowMore)
                <div class="link-snip"><a href="{{ route('guest.search', ['q' => $search]) }}">@lang('Show More')</a>
                </div>
            @endif


        </div>
    </div>
</div>
