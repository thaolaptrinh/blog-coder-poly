<x-guest-layout class="error_page error-view">
    <div class='flex-section' id='center-container'>
        <div class='container outer-container'>
            <main id='feed-view'>
                <div class='main section' id='main' name='Main Recent Posts'>
                    <div class='widget Blog' data-version='2' id='Blog1'>
                        <div class='errorPage'>
                            <h3>404</h3>
                            <h4>@lang("There's nothing here!")</h4>
                            <p>@lang('Sorry, the page you were looking for in this blog does not exist.')</p>
                            <a class='homepage' href='{{ route('guest.index') }}'>
                                <span class='material-symbols-rounded'></span>
                                @lang('Home')
                            </a>
                        </div>
                    </div>
                </div>
                <div id='custom-ads-placeholder'>
                    <div class='section' id='upper-ad' name='Inside Post Ads'>
                        <div class='widget HTML' data-version='2' id='HTML8'></div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-guest-layout>
