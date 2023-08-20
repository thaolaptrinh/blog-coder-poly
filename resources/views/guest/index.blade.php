<x-guest-layout class="index home feed-view">

    <x-slot name="metaTags">

        <title> {{ blog()->site_name }} - {{ blog()->site_description }}</title>
        <meta name="keywords" content="{{ blog()->site_keywords }}">
        <meta name="description" content="{{ blog()->site_description }}">
        <meta name="author" content="{{ blog()->site_name }}">

        <!-- Robot Meta Tags -->
        <meta name="robots" content="index, follow">
        <!-- Open Graph -->
        <meta property="og:title" content="{{ blog()->site_name }}">
        <meta property="og:description" content="{{ blog()->site_description }}">
        <meta property="og:image" content="{{ blog()->logo }}">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ Request::root() }}">
        <meta property="og:site_name" content="{{ blog()->site_name }}">


        <!-- Twitter Card -->
        <meta name="twitter:domain" content="{{ Request::getHost() }}">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:site" content="{{ Request::url() }}">
        <meta name="twitter:creator" content="{{ blog()->site_name }}">
        <meta name="twitter:title" property="og:title" itemprop="name" content="{{ blog()->site_name }}">
        <meta name="twitter:description" property="og:description" content="{{ blog()->site_description }}">
        <meta name="twitter:image" content="{{ blog()->logo }}">


    </x-slot>


    <div class="flex-section" id="mega-wrap">
        <div class="fZilIo-block container flex section" id="ft-post" name="Top Feature Section">
            <x-widgets.popular-posts-widget />
        </div>
    </div>

    <div class="flex-section" id="center-container">
        <div class="container outer-container" style="transform: none;">
            <main id="feed-view"
                style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">

                <!-- Main Wrapper -->
                <div class="theiaStickySidebar"
                    style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;">
                    <x-widgets.top-main-widget />


                    <x-widgets.main-recent-posts-widget limit="9" />


                </div>
            </main>
        </div>
    </div>


</x-guest-layout>
