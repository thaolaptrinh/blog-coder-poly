@if ($recentPosts->isNotEmpty())
    <div class="recent-title section" id="recent-title" name="Header Posts">
        <div class="widget Text">
            <div class="widget-title">
                <h3 class="title">@lang('View the Most Recent Posts')</h3>
            </div>
            <p class="widget-content">@lang('Here you will find all of the most recent trending information.')</p>
        </div>
    </div>
    <div class="main section" id="main" name="Main Recent Posts">
        <div class="widget Blog">
            <div class="blog-posts hfeed container post-filter-wrap">
                <div class="grid-posts">
                    @foreach ($recentPosts as $post)
                        <article class="blog-post hentry post-filter post-{{ $loop->index }}" itemscope="itemscope"
                            itemtype="https://schema.org/CreativeWork">
                            <div class="post-filter-inside-wrap">
                                <div class="post-filter-image " itemprop="image" itemscope="itemscope"
                                    itemtype="https://schema.org/ImageObject">
                                    <a class="post-filter-link background-layer mix image-nos"
                                        href="{{ $post->url }}">
                                        <img alt="The way to get good ideas is to get lots of ideas"
                                            class="snip-thumbnail" data-src="{{ $post->thumbnail }}" itemprop="url">
                                    </a>

                                    @if (count($post->tags) > 0)
                                        <span class="post-label-fly">{{ optional($post->tags[0])->name }}</span>
                                    @endif
                                </div>
                                <div class="featured-meta-fly">
                                    <h2 class="entry-title vcard" itemprop="mainEntityOfPage"
                                        itemtype="https://schema.org/mainEntityOfPage">
                                        <a href="{{ $post->url }}" rel="bookmark" title="{{ $post->title }}"><span
                                                itemprop="name">{{ $post->title }}</span></a>
                                    </h2>
                                    <div class="post-snip" itemprop="author" itemscope="itemscope"
                                        itemtype="https://schema.org/Person">
                                        <span class="post-date published"
                                            datetime="{{ $post->published_at }}">{{ $post->published_at }}</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach

                </div>
                <div class="blog-pager-ok container" id="blog-pager-ok">
                    <a class="load-more" href="{{ route('guest.search', ['page' => 2]) }}"
                        title="{{ __('Older Posts') }}">
                        @lang('Load More')
                    </a>
                </div>
            </div>
        </div>
    </div>

@endif
