<div class="fZilIo-myblock-content">
    <div class="fZilIo-myblock section" id="top-pixy-main-widget">

        @foreach ($threeCategories as $category)
            <div class="widget HTML type-column open-iki">
                <div class="widget-title">
                    <h3 class="title">{{ $category->name }}</h3><a class="simple-viewmore"
                        href="{{ route('guest.category', $category->slug) }}">
                        @lang('Show More')
                    </a>
                </div>
                <div class="widget-content">
                    <div class="color-flex-column">
                        @foreach ($category->posts as $post)
                            @if ($loop->index == 0)
                                <div class="lr-section item{{ $loop->index }}">
                                    <div class="col-img">
                                        <a class="post-filter-link mix image-nos"
                                            href="{{ route('guest.post', $post->slug) }}">
                                            <img class="snip-thumbnail lazy-img" alt="{{ $post->title }}"
                                                data-src="{{ $post->thumbnail }}" src="{{ $post->thumbnail }}"></a>
                                        <div class="featured-meta-fly">
                                            <h2 class="entry-title"><a
                                                    href="{{ route('guest.post', $post->slug) }}">{{ $post->title }}.</a>
                                            </h2>
                                            <div class="post-snip">
                                                <img class="post-author-image"
                                                    src="{{ $post->author->info->photo }}"><span
                                                    class=" post-author  ">{{ $post->author->name }}</span><span
                                                    class="post-date">{{ $post->published_at }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="lr-step item{{ $loop->index }}">
                                    <div class="col-main-thumb"><a class="post-filter-link image-nos"
                                            href="{{ $post->url }}"><img class="snip-thumbnail lazy-img"
                                                alt="{{ $post->title }}." data-src="{{ $post->thumbnail }}"
                                                src="{{ $post->thumbnail }}"></a>
                                    </div>
                                    <div class="piki-hero-box"><span class="post-tag">{{ $category->name }}</span>
                                        <h2 class="entry-title"><a href="{{ $post->url }}">{{ $post->title }}.</a>
                                        </h2>
                                        <div class="post-snip"><span class="post-date">{{ $post->published_at }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
        @endforeach




    </div>
</div>
