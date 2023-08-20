<div class="fZilIo-Ismenu section" id="fZilIo-Ismenu" name="Main Menu">
    <div class="widget LinkList show-menu" data-version="2" id="LinkList12">
        <ul id="menutab" role="tablist">
            <li itemprop="name" role="tab">
                <a href="{{ route('guest.index') }}" itemprop="url">@lang('Home')</a>
            </li>

            <li itemprop="name" role="tab" class="sub-tab"><a href="javascript:;" itemprop="url">@lang('Categories')</a>
                <ul class="sub-menu m-sub overflow-hidden" style="width: 200px">

                    @foreach (\App\Models\Category::limit(10)->get() as $category)
                        <li itemprop="name" role="tab">
                            <a href="{{ route('guest.category', $category->slug) }}" itemprop="url">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>

        </ul>
    </div>
</div>
