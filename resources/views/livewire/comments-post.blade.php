<div class='fZilIo-comments1'>

    <div class='title-wrap comments-title'>
        <h3>@lang('Comments')</h3>
        <p class='all-comments'>{{ $post->comments_count }} @lang('Comments')</p>
    </div>
    <section class='comments threaded no-comments'>
        @if ($post->comments->isNotEmpty())
            <div class="comments" style="max-height: 300px; overflow-y: scroll;">
                @foreach ($post->comments as $comment)
                    <div class="comments-item">
                        <div class="author">
                            <span>
                                {{ $comment->user->name }} - {{ $comment->depth }}
                            </span>
                        </div>
                        <p class="content">{{ $comment->comment }}</p>
                    </div>
                    <br>
                @endforeach
            </div>
        @endif

        <p class='comments-msg-alert'>@lang("Please don't spam here, all comments are reviewed by the administrator.")</p>
        <a class='btn' href='javascript:;' id='show-comment-form'>
            @lang('Comment')
        </a>
    </section>
</div>
