@if (!is_null($popularPosts))

    <div class="widget PopularPosts">
        <div class="widget-content">
            <div class="featured-grid-all">
                @forelse ($popularPosts as  $post)
                    @php
                        $authorName = $post->author?->name ?? blog()->site_name;
                        $authorPhoto = $post->author?->info?->photo ?? asset('static/default_avatar.jpg');
                    @endphp
                    @if ($post && $loop->index == 0)
                        <div class="featuredui-block item{{ $loop->index }}">
                            <a class="post-filter-inner" href="{{ route('guest.post', $post->slug) }}"
                                title="{{ $post->title }}">
                                <span class="post-filter-link background-layer mix image-nos">
                                    <img alt="{{ $post->title }}" class="snip-thumbnail lazy-img"
                                        data-src="{{ $post->thumbnail }}" src="{{ $post->thumbnail }}">
                                </span>
                                <div class="featured-meta-fly">
                                    @foreach ($post->tags as $tag)
                                        <span class="post-tag" style="margin: 1px;">
                                            {{ $tag->name }}
                                        </span>
                                        @break($loop->index == 1)
                                    @endforeach
                                    <h2 class="entry-title vcard">{{ $post->title }}
                                    </h2>
                                    <div class="post-snip">
                                        <img alt="{{ $authorName }}" class="post-author-image"
                                            src="{{ $authorPhoto }}">
                                        <span class="post-author">{{ $authorName }}</span>
                                        <span class="post-date"
                                            datetime="{{ $post->published_at }}">{{ $post->published_at }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @else
                    @endif
                @empty
                @endforelse

                <div class="featured-block">

                    @forelse ($popularPosts as $post)
                        @if ($post)
                            @continue($loop->index == 0)
                            @php
                                $authorName = $post->author?->name ?? blog()->site_name;
                                $authorPhoto = $post->author?->info?->photo ?? asset('static/default_avatar.jpg');
                            @endphp
                            <div class="featuredui-block item{{ $loop->index }}">
                                <a class="post-filter-inner" href="{{ route('guest.post', $post->slug) }}"
                                    title="{{ $post->title }}">
                                    <span class="post-filter-link background-layer mix image-nos">
                                        <img alt="{{ $post->title }}" class="snip-thumbnail lazy-img"
                                            data-src="{{ $post->thumbnail }}" src="{{ $post->thumbnail }}">
                                    </span>
                                    <div class="featured-meta-fly">
                                        @foreach ($post->tags as $tag)
                                            <span class="post-tag" style="margin: 1px;">
                                                {{ $tag->name }}
                                            </span>
                                            @break($loop->index == 1)
                                        @endforeach
                                        <h2 class="entry-title vcard">{{ $post->title }}
                                        </h2>
                                        <div class="post-snip">
                                            <img alt="{{ $authorName }}" class="post-author-image"
                                                src="{{ $authorPhoto }}">
                                            <span class="post-author">{{ $authorName }}</span>
                                            <span class="post-date"
                                                datetime="{{ $post->published_at }}">{{ $post->published_at }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif

                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>

@endif
