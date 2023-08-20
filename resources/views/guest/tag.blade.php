<x-guest-layout class="index feed-view search-view">

    <x-slot name="metaTags">

        <title> {{ Str::ucfirst($tag->name) }} - {{ blog()->site_name }} </title>
        <meta name="description" content="{{ Str::ucfirst(words($tag->description, 120)) }}">
        <meta name="author" content="{{ blog()->site_name }}">

        <!-- Robot Meta Tags -->
        <meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large" />

        <!-- Open Graph -->
        <meta property="og:title" content="{{ Str::ucfirst($tag->name) }} - {{ blog()->site_name }}">
        <meta property="og:description" content="{{ Str::ucfirst(words($tag->description, 120)) }}">
        <meta property="og:type" content="article">
        <meta property="og:url" content="{{ Request::url() }}">


        <!-- Twitter Card -->
        <meta name="twitter:domain" content="{{ Request::getHost() }}">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="{{ Request::url() }}">
        <meta name="twitter:creator" content="{{ blog()->site_name }}">
        <meta name="twitter:title" property="og:title" itemprop="name"
            content="{{ Str::ucfirst(words($tag->description, 120)) }}">
        <meta name="twitter:description" property="og:description"
            content="{{ Str::ucfirst(words($tag->description, 120)) }}">
        <meta name="twitter:label1" content="Posts" />
        <meta name="twitter:data1" content="{{ $tag->posts_count }}" />

    </x-slot>



    <div class='flex-section' id='center-container'>
        <div class='container outer-container'>
            <main id='feed-view'>
                <!-- Main Wrapper -->
                <div class='main section' id='main' name='Main Recent Posts'>
                    <div class='widget Blog' data-version='2' id='Blog1'>
                        <div class="queryMessage">
                            <span class="query-info query-success">{{ $tag->name }}</span>
                        </div>
                        <div class='blog-posts hfeed container post-filter-wrap'>
                            <div class='grid-posts'>
                                @foreach ($posts as $post)
                                    <article class="blog-post hentry post-filter post-{{ $loop->index }}"
                                        itemscope="itemscope" itemtype="https://schema.org/CreativeWork">
                                        <div class="post-filter-inside-wrap">
                                            <div class="post-filter-image " itemprop="image" itemscope="itemscope"
                                                itemtype="https://schema.org/ImageObject">
                                                <a class="post-filter-link background-layer mix image-nos"
                                                    href="{{ $post->url }}">
                                                    <img alt="The way to get good ideas is to get lots of ideas"
                                                        class="snip-thumbnail" data-src="{{ $post->thumbnail }}"
                                                        itemprop="url">
                                                </a>

                                                @if (count($post->tags) > 0)
                                                    <span
                                                        class="post-label-fly">{{ optional($post->tags[0])->name }}</span>
                                                @endif
                                            </div>
                                            <div class="featured-meta-fly">
                                                <h2 class="entry-title vcard" itemprop="mainEntityOfPage"
                                                    itemtype="https://schema.org/mainEntityOfPage">
                                                    <a href="{{ $post->url }}" rel="bookmark"
                                                        title="{{ $post->title }}"><span
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
                        </div>
                        <div class='blog-pager container' id='blog-pager'>

                            {{ $posts->links('pagination::bootstrap-4') }}

                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>
</x-guest-layout>
