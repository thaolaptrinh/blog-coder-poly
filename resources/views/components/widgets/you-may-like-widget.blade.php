@if ($relatedPosts->isNotEmpty())
    <div class="related-runs">
        <div class="widget-title">
            <h3 class="title">@lang('You May Like')</h3>
            <a class="simple-viewmore" href="{{ route('guest.tag', $tag->slug) }}">@lang('Show More')</a>
        </div>

        <div class="Super-related">
            <div class="BiggerRelated">
                @foreach ($relatedPosts as $post)
                    <div class="relatedui-posts">
                        <div class="relatedui-posts-thumb">
                            <a class="post-filter-link image-nos" href="{{ $post->url }}"><img
                                    class="snip-thumbnail lazy-img" alt=" {{ $post->title }}"
                                    data-src="{{ $post->thumbnail }}" src="{{ $post->thumbnail }}">
                            </a>
                        </div>
                        <div class="relatedui-posts-box">
                            <h2 class="entry-title">
                                <a href="{{ $post->url }}">
                                    {{ $post->title }}
                                </a>
                            </h2>
                            <div class="post-snip">
                                <span class="post-date">{{ $post->published_at }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endif
