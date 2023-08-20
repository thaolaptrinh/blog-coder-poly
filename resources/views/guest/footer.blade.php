<div class='flex-footer' id='footer-wrapper' itemscope='itemscope' itemtype='https://schema.org/WPFooter' role='banner'>
    <div class='flex-ft footer-data'>
        <div class='container outer-container'>
            <div class='Footer-Function section' id='Footer-Function' name='Footer Info'>
                <div class='widget Image' data-version='2' id='Image150'>
                    <div class='widget-content'>
                        <div class='about-content'>
                            <div class='widget-title'>
                                <h3 class='title'>@lang('Designed with by')</h3>
                            </div>
                            <div class='footer-logo custom-image'>
                                <a href='{{ route('guest.index') }}'>
                                    <x-application-logo height="67" width="294" />
                                </a>
                            </div>
                            <span class='image-caption'></span>
                        </div>
                    </div>
                </div>
                <div class='widget LinkList' data-version='2' id='LinkList7'>
                    <div class='widget-content'>
                        <ul class='colorful-ico colorful'>
                            <li class='facebook-f'>
                                <a aria-label='buttons' class='fa-facebook-f' href='https://facebook.com/templateiki'
                                    rel='noopener noreferrer' target='_blank'></a>
                            </li>
                            <li class='twitter'>
                                <a aria-label='buttons' class='fa-twitter' href='https://twitter.com/templateiki'
                                    rel='noopener noreferrer' target='_blank'></a>
                            </li>
                            <li class='youtube'>
                                <a aria-label='buttons' class='fa-youtube'
                                    href='https://www.youtube.com/c/pikitemplates?sub_confirmation=1'
                                    rel='noopener noreferrer' target='_blank'></a>
                            </li>
                            <li class='instagram'>
                                <a aria-label='buttons' class='fa-instagram'
                                    href='https://www.instagram.com/templateiki/' rel='noopener noreferrer'
                                    target='_blank'></a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class='FooterChecksService section' id='FooterChecks-Service' name='Product Services'>
                <div class='widget LinkList' data-version='2' id='LinkList11'>
                    <div class='widget-title'>
                        <h3 class='title'>@lang('Categories')</h3>
                    </div>
                    <div class='widget-content'>
                        <ul>

                            @foreach (\App\Models\Category::limit(5)->get() as $category)
                                <li>
                                    <a
                                        href='{{ route('guest.category', $category->slug) }}'>{{ Str::ucfirst(Str::lower($category->name)) }}</a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
                <div class='widget LinkList' data-version='2' id='LinkList6'>
                    <div class='widget-title'>
                        <h3 class='title'>@lang('Tags')</h3>
                    </div>
                    <div class='widget-content'>
                        <ul>
                            @foreach (\App\Models\Tag::limit(5)->get() as $tag)
                                <li>
                                    <a
                                        href='{{ route('guest.tag', $tag->slug) }}'>{{ Str::ucfirst(Str::lower($tag->name)) }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='flex-ft footer-container'>
        <div class='container footer-outer'>
            <div class='footer-checks-menu section' id='footer-checks-menu' name='Footer Menu'>
                <div class='widget LinkList' data-version='2' id='LinkList8'>
                    <div class='widget-content'>
                        <ul>
                            <li>
                                <a href='{{ route('guest.index') }}'>@lang('Home')</a>
                            </li>
                            {{-- <li>
                                <a href='/'>@lang('About')</a>
                            </li>
                            <li>
                                <a href='/'>@lang('Contact us')</a>
                            </li>
                            <li>
                                <a href='/'>@lang('Privacy Policy')</a>
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </div>
            <div class='footer-copyright section' id='footer-copyright' name='Footer Attribution'>
                <div class='widget HTML' data-version='2' id='HTML33'>
                    <div class='widget-content'>
                        <span class='copyright-text widget'>
                            Design by - <a href='https://www.templateiki.com/' id='templateiki' rel='dofollow'>Premium
                                Blogger Templates</a> & <a href="/">{{ config('app.name') }}</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
