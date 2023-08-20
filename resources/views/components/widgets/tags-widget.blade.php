@if ($tags->isNotEmpty())
    <div class='widget Label'>
        <div class='widget-title'>
            <h3 class='title'>@lang('Tags')</h3>
        </div>
        <div class='widget-content cloud-label'>
            <ul>
                @foreach ($tags as $tag)
                    <li>
                        <a class='label-name' href='{{ route('guest.tag', $tag->slug) }}'>
                            {{ $tag->name }}
                            <span class='label-count'>{{ $tag->post_count }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
