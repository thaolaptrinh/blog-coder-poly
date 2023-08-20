@if ($latestPosts->isNotEmpty())
    <div class='widget PopularPosts'>
        <div class='widget-title'>
            <h3 class='title'>@lang('Latest Posts')</h3>
        </div>
        <div class='widget-content sidebar-posts'>

            @foreach ($latestPosts as $index => $post)
                @php
                    $authorName = $post->author?->name ?? blog()->site_name;
                    $authorPhoto = $post->author?->info?->photo ?? asset('static/default_avatar.jpg');
                    $isFirstPost = $index == 0;
                @endphp

                <div class='popular-post post {{ !$isFirstPost ?: 'gaint-post' }} item{{ $index }}'>
                    <a class='post-filter-link image-nos image-nos' href='{{ $post->url }}' title='{{ $post->title }}'>
                        <img alt='{{ $post->title }}' class='snip-thumbnail' data-src='{{ $post->thumbnail }}' />
                    </a>
                    <div class='relatedui-posts-box'>
                        <h2 class='entry-title vcard'>
                            <a href='{{ $post->url }}' rel='bookmark'
                                title='{{ $post->title }}'>{{ $post->title }}</a>
                        </h2>
                        <div class='post-snip'>

                            @if ($isFirstPost)
                                <img alt='{{ $authorName }}' class='post-author-image' src='{{ $authorPhoto }}' />
                                <span class='post-author'>{{ $authorName }}</span>
                            @endif
                            <span class='post-date'>{{ $post->published_at }}</span>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endif
