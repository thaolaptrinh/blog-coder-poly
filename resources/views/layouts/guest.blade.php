<!DOCTYPE html>
<html class="ltr" dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="#3154c2" name="theme-color">
    <meta content="#3154c2" name="msapplication-navbutton-color">

    <link href="https://maxcdn.bootstrapcdn.com/" rel="dns-prefetch">
    <link href="https://fonts.googleapis.com/" rel="dns-prefetch">
    <link href="https://use.fontawesome.com/" rel="dns-prefetch">
    <link href="https://ajax.googleapis.com/" rel="dns-prefetch">
    <link href="https://cdnjs.cloudflare.com/" rel="dns-prefetch">


    @if (isset($metaTags))
        {{ $metaTags }}
    @endif

    <!-- Canonical & Alternate Languages -->
    <link rel="canonical" href="{{ Request::url() }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ blog()->favicon }}" type="image/x-icon">

    <!-- Scripts -->
    @vite(['resources/js/app.js'])

    <!-- Font Awesome Brands -->
    <link href="{{ asset('guest/css/brands.min.css') }}" rel="stylesheet">
    <link href="{{ asset('guest/css/style.css') }}" rel="stylesheet">

    <!-- Global Variables -->
    <script defer="defer" type="text/javascript">
        var monthsName = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
                "November", "December"
            ],
            noThumb = "",
            relatedPostsNum = 3,
            commentsSystem = "blogger",
            relatedPostsText = "",
            loadMorePosts = "",
            showMoreText = "",
            postPerPage = 6,
            pageOfText = ["Page", "of"],
            fixedSidebar = true
        fixedMenu = true;
        disqusShortname = "templateiki";
    </script>

    @livewireStyles

    @stack('stylesheets')


    <style id="theia-sticky-sidebar-stylesheet-TSS">
        .theiaStickySidebar:after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>

<body {{ $attributes }} id="mainContent">
    <script type="text/javascript">
        (localStorage.getItem('mode')) === 'darkmode' ? document.querySelector('#mainContent').classList.add('dark'):
            document.querySelector('#mainContent').classList.remove('dark')
    </script>


    <!-- Outer Wrapper -->
    <div id="outer-wrapper">
        <!-- Header Wrapper -->
        <header id="fZilIo-menu" role="banner">
            <div class="fZilIo-mymenu-wrap">
                <div class="fZilIo-mymenu show">
                    <div class="container">
                        <div class="SuperLogo-wrap">
                            <div class="header-section">
                                <div class="header-left">
                                    <a aria-label="Menu" class="show-menu-space" href="javascript:;"></a>
                                    <div class="SuperLogo section" id="SuperLogo" name="Main Logo"
                                        style="margin-right: 20px;">
                                        <div class="widget Image" data-version="2" id="Image20">


                                            <a class="SuperLogo-img" href="{{ route('guest.index') }}">

                                                <x-application-logo data-dark="{{ asset('logo.png') }}"
                                                    data-normal="{{ asset('logo.png') }}" id="darkroom" height="67"
                                                    width="294" />

                                                <script type="text/javascript">
                                                    var darkImage = document.querySelector('#darkroom');
                                                    (localStorage.getItem("mode")) === "darkmode" ? darkImage.setAttribute('src', darkImage.getAttribute('data-dark')):
                                                        darkImage.setAttribute('src', darkImage.getAttribute('data-normal'))
                                                </script>
                                            </a>
                                        </div>
                                    </div>
                                    @includeIf('guest.main-menu')
                                </div>
                                <div class="header-right">
                                    <div class="search-wrap">
                                        <a aria-label="Dark mode" class="dark-toggle-flex" href="javascript:;"
                                            role="button"></a>
                                        <a class="search-button-flex" href="javascript:;" role="button"
                                            title="Search"></a>
                                    </div>
                                </div>
                                <div id="overlay-id"></div>
                                @livewire('search-posts')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>



        {{ $slot }}

        @includeIf('guest.footer')

    </div>


    @if (isset($outer))
        {{ $outer }}
    @endif
    <!-- Slider Mobile Menu -->
    @includeIf('guest.mobile-menu')
    <!--Demo Plugin -->
    <style type="text/css">
        .demo-btd {
            position: fixed;
            top: 30%;
            right: 20px;
            gap: 12px;
            display: flex;
            flex-direction: column;
            z-index: 22;
        }

        .demo-btd a {
            position: relative;
            display: flex;
            background: var(--mobile-menu-bg);
            color: var(--featured-posts-title);
            fill: var(--featured-posts-title);
            font-size: 13px;
            font-weight: 600;
            box-shadow: 0 0 5px 0px rgb(39 39 39 / 0.12);
            width: 67px;
            height: 67px;
            border-radius: 10px;
            text-align: center;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .demo-btd a:hover,
        .demo-btd a svg:hover {
            color: var(--button-bg-color);
            fill: var(--button-bg-color);
        }

        @media screen and (max-width:480px) {
            .demo-btd {
                bottom: 30%;
                transform: translate3d(-50%, 0, 0);
                top: unset;
                right: unset;
                left: 90%;
                flex-direction: row;
            }
        }
    </style>
    <div class="demo-btd">

        <a class="buy-btd-buy" href="{{ route('admin.posts.create') }}" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                <path d="M9 12l6 0"></path>
                <path d="M12 9l0 6"></path>
            </svg>

            <span>@lang('New Post')</span>
        </a>
    </div>
    <div class="overlay"></div>
    <div class="backTop" title="Back to Top"></div>
    <!-- Sticky Bottom Buttons -->
    <div class="section-sticky">
        <ul class="mobileMenu">
            <li class="myHome"><a href="https://color-ui-default-templateiki.blogspot.com/" role="button"><span
                        class="material-symbols-rounded">home</span></a></li>
            <li class="mySearch"><label role="button"><span class="material-symbols-rounded">search</span></label>
            </li>
            <li class="myNav"><label role="button"><span class="material-symbols-rounded">add</span></label>
            </li>
            <li class="myDark"><label role="button"><span class="material-symbols-rounded">dark_mode</span></label>
            </li>
            <li class="myTop" style="display: none;"><label role="button"><span
                        class="material-symbols-rounded">present_to_all</span></label></li>
        </ul>
    </div>
    <!-- Templateiki Template Hosted Plugins -->
    <script src="{{ asset('guest/js/jquery.min.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        var pikiMessages = {
            showMore: "Show more",
            noTitle: "No title",
            noResults: "No results found",
        }
    </script>
    <!--  Template LocalHost Plugins -->
    <script src="{{ asset('guest/js/plugins.js') }}" type="text/javascript"></script>

    <!--  Templates Under License Creative Common Rights (CC-3.0) JS Copyrighted -->
    <script type="text/javascript" src="{{ asset('guest/js/copyright.js') }}"></script>


    @livewireScripts

</body>

</html>
