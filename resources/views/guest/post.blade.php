<x-guest-layout class="item item-view">


    <x-slot name="metaTags">

        <title> {{ $post->title }} </title>
        <meta name="description" content="{{ Str::ucfirst(words($post->body, 120)) }}">
        <meta name="author" content="{{ $post->author?->name ? $post->author->name : blog()->site_name }}">

        <!-- Robot Meta Tags -->
        <meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large" />
        <!-- Open Graph -->
        <meta property="og:title" content="{{ Str::ucfirst($post->title) }}">
        <meta property="og:description" content="{{ Str::ucfirst(words($post->body, 120)) }}">
        <meta property="og:image" content="{{ $post->thumbnail }}">
        <meta property="og:type" content="article">
        <meta property="og:url" content="{{ Request::url() }}">
        <meta property="og:site_name" content="{{ blog()->site_name }}" />



        <!-- Twitter Card -->
        <meta name="twitter:domain" content="{{ Request::getHost() }}">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:site" content="{{ Request::url() }}">
        <meta name="twitter:creator" content="{{ blog()->site_name }}">
        <meta name="twitter:title" property="og:title" itemprop="name" content="{{ Str::ucfirst($post->title) }}">
        <meta name="twitter:description" property="og:description"
            content="{{ Str::ucfirst(words($post->body, 120)) }}">
        <meta name="twitter:image" content="{{ $post->thumbnail }}">


    </x-slot>


    @push('stylesheets')

        @if ($post->layout->isLeftSidebar())
            <style>
                .flex-section .outer-container {
                    flex-direction: row-reverse;
                }
            </style>
        @elseif ($post->layout->isNoSidebar())
            <style>
                .item-view #sidebar-container {
                    display: none;
                }

                .item-view #feed-view {
                    width: 100%;
                }
            </style>
        @endif
    @endpush

    <div class='flex-section' id='center-container'>
        <div class='container outer-container'>
            <main id='feed-view'>
                <div class='main section' id='main' name='Main Recent Posts'>
                    <div class='widget Blog' data-version='2' id='Blog1'>
                        <div class='blog-posts hfeed container item-post-wrap'>
                            <article class='blog-post hentry item-post' itemscope='itemscope'
                                itemtype='https://schema.org/CreativeWork'>
                                <div class='post-inner-area'>
                                    <nav id='breadcrumb'>
                                        <a href='{{ route('guest.index') }}'>@lang('Home')</a>
                                        <em class='delimiter'></em>
                                        <span class='current'>{{ $post->title }}</span>
                                    </nav>

                                    <h1 class='entry-title'>{{ $post->title }}</h1>
                                    <div class='all-flex'>
                                        <div class='post-inner-data flex'>
                                            <div class='post-inner-user'>
                                                <span class='author-image'>
                                                    <img alt="{{ $post->author?->name }}" class='snip-thumbnail'
                                                        data-src="{{ $post->author?->info?->photo ?? asset('static/default_avatar.jpg') }}" />
                                                </span>
                                            </div>
                                            <div class='post-inner-username'>
                                                <span class='post-author-times' itemprop='name'>
                                                    @lang('Author') -
                                                    <span class='material-symbols-rounded'></span>
                                                    {{ $post->author?->name ?? blog()->site_name }}
                                                </span>
                                                <div class='post-times'>
                                                    <span class='post-date published'
                                                        datetime='{{ $post->published_at }}'>{{ $post->published_at }}</span>
                                                    <span id='readTime'></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='post-inner-comments flex'>
                                            <span class='comment-bubble show'>{{ $post->comments_count }}</span>
                                            <div class='share-top'>
                                                <span class='material-symbols-rounded'>share</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='post-body entry-content' id='postBody'>
                                        {!! $post->body !!}
                                    </div>
                                    <div class='below-ads'></div>
                                    @if ($post->tags->isNotEmpty())
                                        <div class='label-container'>
                                            <span>@lang('Tags')</span>
                                            <div class='label-head Label'>
                                                @foreach ($post->tags as $tag)
                                                    <a class='label-link' href="{{ route('guest.tag', $tag->slug) }}"
                                                        rel='tag'>{{ $tag->name }}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    <div class='feed-share'>
                                        <ul class='share-runs colorful-ico social-front-hover'>
                                            <li class='share-icon'>
                                                <span class='s-icon'></span>
                                            </li>
                                            <li class='facebook-f'>
                                                <a class='fa-facebook window-piki' data-height='650'
                                                    data-url='https://www.facebook.com/sharer.php?u={{ $post->url }}'
                                                    data-width='550' href='javascript:;' rel='nofollow'
                                                    title='Facebook'>Facebook</a>
                                            </li>

                                            <li class='show-hid'>
                                                <a aria-label='Share button' href='javascript:;' rel='nofollow'></a>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                                <div class='post-footer'>
                                    <div class='fZilIo-author'>
                                        <div class='avatar-container'>
                                            <img alt='{{ $post->author?->name }}'
                                                class='author-avatar snip-thumbnail'
                                                data-src='{{ $post->author?->info?->photo ?? asset('static/default_avatar.jpg') }}' />
                                        </div>
                                        <h3 class='author-name'>
                                            <a alt='Jane Doe' href='#'
                                                target='_blank'>{{ $post->author?->name ?? blog()->site_name }}</a>
                                        </h3>
                                        <div class='author-description'>
                                            <span class='description-alt'>
                                                {{ $post->author?->bio ?? words(blog()->site_description, 100) }}
                                                {{ __(Str::ucfirst($post->author?->getRoleNames()[0])) }}

                                            </span>
                                            <ul class='description-links colorful-ico social-color-hover'></ul>
                                        </div>
                                    </div>

                                    {{-- Widget You May Like --}}
                                    <x-widgets.you-may-like-widget :currentPost="$post" :limit="3" />

                                </div>
                            </article>
                            <script>
                                function get_text(e) {
                                    ret = "";
                                    for (var t = e.childNodes.length, n = 0; n < t; n++) {
                                        var o = e.childNodes[n];
                                        8 != o.nodeType && (ret += 1 != o.nodeType ? o.nodeValue : get_text(o))
                                    }
                                    return ret
                                }
                                var words = get_text(document.getElementById("postBody")),
                                    count = words.split(" ").length,
                                    avg = 200,
                                    counted = count / avg,
                                    maincount = Math.round(counted);
                                document.getElementById("readTime").innerHTML = maincount + " " +
                                    @json(__('minute read'));
                            </script>

                            @livewire('comments-post', ['post' => $post])

                        </div>
                    </div>
                </div>


            </main>

            <aside id='sidebar-container' itemscope='itemscope' itemtype='https://schema.org/WPSideBar'
                role='banner'>
                <div class='sidebar section' id='sidebar' name='Sidebar Right'>

                    <x-widgets.latest-posts-widget :currentPost="$post" :limit="4" />

                    <div class='widget LinkList'>
                        <div class='widget-title'>
                            <h3 class='title'>@lang('Social Media')</h3>
                        </div>
                        <div class='widget-content'>
                            <ul class='socialFilter colorful social'>
                                <li class='facebook'>
                                    <a aria-label='buttons' class='fa-facebook' href='{{ blog()->url_facebook }}'
                                        rel='noopener noreferrer' target='_blank' title='facebook'>facebook</a>
                                </li>
                                <li class='twitter'>
                                    <a aria-label='buttons' class='fa-twitter' href='{{ blog()->url_twitter }}'
                                        rel='noopener noreferrer' target='_blank' title='twitter'>twitter</a>
                                </li>
                                <li class='instagram'>
                                    <a aria-label='buttons' class='fa-instagram' href='{{ blog()->url_instagram }}'
                                        rel='noopener noreferrer' target='_blank' title='instagram'>instagram</a>
                                </li>
                                <li class='youtube'>
                                    <a aria-label='buttons' class='fa-youtube' href='{{ blog()->url_youtube }}'
                                        rel='noopener noreferrer' target='_blank' title='youtube'>youtube</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    {{-- Widget Tag --}}
                    <x-widgets.tags-widget />

                    <div class="widget HTML sibForm">
                        <div class="widget-content">
                            <div class="follow-by-email">
                                <h3 class="follow-by-email-title">@lang('Subscribe')</h3>
                                <span class="follow-by-email-caption">@lang('Get Notified About Latest Posts')</span>
                                <div class="follow-by-email-inner">
                                    <form>
                                        <input class="follow-by-email-address" name="EMAIL"
                                            placeholder="{{ __('Email Address') }}" type="email" value="">
                                        <input class="follow-by-email-submit" name="subscribe" type="submit"
                                            value="{{ __('Subscribe') }}">
                                    </form>
                                </div>
                            </div>
                            <div class="Follow-by-alert">* @lang("We promise that we don't spam!")</div>
                        </div>
                    </div>
                </div>
            </aside>

        </div>
    </div>

    <x-slot name="outer">
        <div class='StickyBox'>
            <div class='StickyDemo'>
                <div class='StickyTab'>
                    <div class='StickyType'>@lang('Share to other apps')</div>
                    <label class='close-check'>
                        <span class='material-symbols-rounded'>close</span>
                    </label>
                </div>
                <div class='share-wrapper-icons colorful colorful-ico'>
                    <li class='facebook-f'>
                        <a class='fa-facebook window-piki' data-height='650'
                            data-url='https://www.facebook.com/sharer.php?u={{ $post->url }}' data-width='550'
                            href='javascript:;' rel='nofollow' title='Facebook'>Facebook</a>
                    </li>
                    <li class='twitter'>
                        <a class='fa-twitter window-piki' data-height='460'
                            data-url='https://twitter.com/intent/tweet?url={{ $post->url }}&text={{ $post->title }}'
                            data-width='550' href='javascript:;' rel='nofollow' title='Twitter'>Twitter</a>
                    </li>

                    <li class='linkedin'>
                        <a class='fa-linkedin window-piki' data-height='700'
                            data-url='https://www.linkedin.com/shareArticle?url={{ $post->url }}'
                            data-width='1000' href='javascript:;' rel='nofollow' title='LinkedIn'>LinkedIn</a>
                    </li>

                    <li class='email'>
                        <a class='email window-piki' data-height='460'
                            data-url='mailto:?subject={{ $post->title }}&body={{ $post->url }}' data-width='550'
                            href='javascript:;' rel='nofollow' title='Email'>Email</a>
                    </li>
                </div>
                <div class='copy-section'>
                    <span class='title'>@lang('Copy Post Link')</span>
                    <div class='copy-post'>
                        <input id='showlink' readonly='readonly' value='{{ $post->url }}' />
                        <button aria-label='Copy'>Copy</button>
                        <div class='messageDone' id='messageDone'></div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-guest-layout>
