<x-guest-layout class="static_page item-view">

    <x-slot name="metaTags">

        <title> {{ Str::ucfirst($page->name) }} - {{ blog()->site_name }} </title>
        <meta name="description" content="{{ Str::ucfirst(words($page->description, 120)) }}">
        <meta name="author" content="{{ blog()->site_name }}">

        <!-- Robot Meta Tags -->
        <meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large" />

        <!-- Open Graph -->
        <meta property="og:title" content="{{ Str::ucfirst($page->name) }} - {{ blog()->site_name }}">
        <meta property="og:description" content="{{ Str::ucfirst(words($page->description, 120)) }}">
        <meta property="og:type" content="article">
        <meta property="og:url" content="{{ Request::url() }}">
        <meta property="og:site_name" content="{{ blog()->site_name }}" />



        <!-- Twitter Card -->
        <meta name="twitter:domain" content="{{ Request::getHost() }}">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="{{ Request::url() }}">
        <meta name="twitter:creator" content="{{ blog()->site_name }}">
        <meta name="twitter:title" property="og:title" itemprop="name"
            content="{{ Str::ucfirst(words($page->description, 120)) }}">
        <meta name="twitter:description" property="og:description"
            content="{{ Str::ucfirst(words($page->description, 120)) }}">

    </x-slot>



    <div class="flex-section" id="center-container">
        <div class="container outer-container" style="transform: none;">
            <main id="feed-view"
                style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
                <!-- Main Wrapper -->
                <div class="theiaStickySidebar"
                    style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;">
                    <div class="main section" id="main" name="Main Recent Posts">
                        <div class="widget Blog" data-version="2" id="Blog1">
                            <div class="blog-posts hfeed container item-post-wrap">
                                <article class="blog-post hentry item-post" itemscope="itemscope"
                                    itemtype="https://schema.org/CreativeWork">
                                    <div class="post-inner-area">
                                        <h1 class="entry-title">About Us</h1>
                                        <div class="post-body entry-content" id="postBody">
                                            <br> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse a
                                            ullamcorper justo, et suscipit ex. Vivamus ornare eu mauris id imperdiet.
                                            Aliquam gravida ut velit at elementum. Nullam ullamcorper nisi in orci
                                            elementum fermentum. Vivamus congue, diam eget feugiat auctor, lectus est
                                            condimentum dui, id pulvinar purus nunc eu odio. Mauris semper dolor id
                                            magna tristique tincidunt. Nunc sed leo quam. Fusce laoreet ornare pulvinar.
                                            Cras luctus pretium libero a mattis. In id vestibulum odio, consequat
                                            laoreet tellus. Aenean id turpis felis. Fusce fringilla, dolor a cursus
                                            commodo, lacus urna commodo orci, vitae ornare est mi nec lorem. Curabitur
                                            eget lectus tincidunt dui pellentesque bibendum. Sed tincidunt augue
                                            posuere, vehicula orci eu, vehicula augue. Orci varius natoque penatibus et
                                            magnis dis parturient montes, nascetur ridiculus mus. Nunc iaculis felis
                                            porttitor vehicula condimentum.<br><br>Lorem ipsum dolor sit amet,
                                            consectetur adipiscing elit. Suspendisse a ullamcorper justo, et suscipit
                                            ex. Vivamus ornare eu mauris id imperdiet. Aliquam gravida ut velit at
                                            elementum. Nullam ullamcorper nisi in orci elementum fermentum. Vivamus
                                            congue, diam eget feugiat auctor, lectus est condimentum dui, id pulvinar
                                            purus nunc eu odio. Mauris semper dolor id magna tristique tincidunt. Nunc
                                            sed leo quam. Fusce laoreet ornare pulvinar. Cras luctus pretium libero a
                                            mattis. In id vestibulum odio, consequat laoreet tellus. Aenean id turpis
                                            felis. Fusce fringilla, dolor a cursus commodo, lacus urna commodo orci,
                                            vitae ornare est mi nec lorem. Curabitur eget lectus tincidunt dui
                                            pellentesque bibendum. Sed tincidunt augue posuere, vehicula orci eu,
                                            vehicula augue. Orci varius natoque penatibus et magnis dis parturient
                                            montes, nascetur ridiculus mus. Nunc iaculis felis porttitor vehicula
                                            condimentum.<br><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            Suspendisse a ullamcorper justo, et suscipit ex. Vivamus ornare eu mauris id
                                            imperdiet. Aliquam gravida ut velit at elementum. Nullam ullamcorper nisi in
                                            orci elementum fermentum. Vivamus congue, diam eget feugiat auctor, lectus
                                            est condimentum dui, id pulvinar purus nunc eu odio. Mauris semper dolor id
                                            magna tristique tincidunt. Nunc sed leo quam. Fusce laoreet ornare pulvinar.
                                            Cras luctus pretium libero a mattis. In id vestibulum odio, consequat
                                            laoreet tellus. Aenean id turpis felis. Fusce fringilla, dolor a cursus
                                            commodo, lacus urna commodo orci, vitae ornare est mi nec lorem. Curabitur
                                            eget lectus tincidunt dui pellentesque bibendum. Sed tincidunt augue
                                            posuere, vehicula orci eu, vehicula augue. Orci varius natoque penatibus et
                                            magnis dis parturient montes, nascetur ridiculus mus. Nunc iaculis felis
                                            porttitor vehicula condimentum.
                                        </div>
                                    </div>
                                </article>
                                <div class="fZilIo-comments comments-system-blogger" style="display: block;">

                                    <div class="title-wrap comments-title">
                                        <h3>Post a Comment</h3>
                                        <p class="all-comments">0Comments</p>
                                    </div>
                                    <section class="comments threaded no-comments" data-embed="true"
                                        data-num-comments="0" id="comments">
                                        <a name="comments"></a>
                                        <p class="comments-msg-alert">Please don't spam here, all comments are reviewed
                                            by the administrator.</p>
                                        <div class="comment-form">
                                            <a name="comment-form"></a>
                                            <a href="https://www.blogger.com/comment/frame/4133483032408945495?pa=3093663112807005735&amp;hl=en&amp;skin=soho"
                                                id="comment-editor-src"></a>
                                            <iframe allowtransparency="allowtransparency"
                                                class="blogger-iframe-colorize blogger-comment-from-post"
                                                frameborder="0" id="comment-editor" name="comment-editor"
                                                style="min-height:110px;" width="100%"></iframe>


                                        </div>
                                        <a class="btn" href="javascript:;" id="show-comment-form">Post a Comment
                                            (0)</a>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="custom-ads-placeholder">
                        <div class="section" id="upper-ad" name="Inside Post Ads">
                            <div class="widget HTML" data-version="2" id="HTML8">
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <!-- Sidebar Wrapper -->
            <aside id="sidebar-container" itemscope="itemscope" itemtype="https://schema.org/WPSideBar" role="banner"
                style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">

                <div class="theiaStickySidebar"
                    style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;">
                    <div class="sidebar section" id="sidebar" name="Sidebar Right">
                        <div class="widget PopularPosts" data-version="2" id="PopularPosts1">
                            <div class="widget-title">
                                <h3 class="title">Popular Posts</h3>
                            </div>
                            <div class="widget-content sidebar-posts">
                                <div class="popular-post post gaint-post item0">
                                    <a class="post-filter-link image-nos image-nos"
                                        href="https://color-ui-default-templateiki.blogspot.com/2021/09/when-you-are-able-to-shift-your-inner.html"
                                        title="When you are able to shift your inner awareness">
                                        <img alt="When you are able to shift your inner awareness"
                                            class="snip-thumbnail lazy-img"
                                            data-src="https://blogger.googleusercontent.com/img/a/AVvXsEg24vjSKXMsLJXq-bdBQrPtFhIgSDvxD4Nsy08RRsfsRDJgoGzAu4Mkr7uGX8SCBrRB4uoDqHw7nOjBVMfmZkkBCHo2vM8guWyedb2zoHk4uRZHtVwwnN1R_qZXoq3Qv_fuWeTrBX_tCXrDXL-2mVa_t2R_TR0sRolMaPKjwClJDiILWETuE7KDvf_hQA=w72-h72-p-k-no-nu"
                                            src="https://blogger.googleusercontent.com/img/a/AVvXsEg24vjSKXMsLJXq-bdBQrPtFhIgSDvxD4Nsy08RRsfsRDJgoGzAu4Mkr7uGX8SCBrRB4uoDqHw7nOjBVMfmZkkBCHo2vM8guWyedb2zoHk4uRZHtVwwnN1R_qZXoq3Qv_fuWeTrBX_tCXrDXL-2mVa_t2R_TR0sRolMaPKjwClJDiILWETuE7KDvf_hQA=w297-h283-p-k-no-nu">
                                    </a>
                                    <div class="relatedui-posts-box">
                                        <h2 class="entry-title vcard"><a
                                                href="https://color-ui-default-templateiki.blogspot.com/2021/09/when-you-are-able-to-shift-your-inner.html"
                                                rel="bookmark"
                                                title="When you are able to shift your inner awareness">
                                                When you are able to shift your inner awareness</a></h2>
                                        <div class="post-snip">
                                            <img alt="Jane Doe" class="post-author-image"
                                                src="//blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjTx8LT8ow6lB6hfJzOZGOwMGoHXIaa6Fdaxx2adTISMgIOBjJo86DY5tuDCad9w6evS8hYJHz-ry-OYuSA9dMT0S14qUl8vSdmB4yXAIlt9aym9PwrCnmr1_FRfN54YZ8/w200/jane+Doe.png">
                                            <span class="post-author">Jane Doe</span>
                                            <span class="post-date">September 30, 2021</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="popular-post post item1">
                                    <a class="post-filter-link gaint image-nos image-nos"
                                        href="https://color-ui-default-templateiki.blogspot.com/2021/09/sometimes-it-is-people-no-one-can.html"
                                        title="Sometimes it is the people no one can imagine">
                                        <img alt="Sometimes it is the people no one can imagine"
                                            class="snip-thumbnail lazy-img"
                                            data-src="https://blogger.googleusercontent.com/img/a/AVvXsEj-MoIi_dqSkBraVv3h7udD5Ip_S1u29vu8FU1pZ6dtBghHpqGrXwMLpuQTi7Cj7dMK344350VmvymZ-ZnD_lzpmIPpMhgbvfLeaBh_RFc3pt0XxyCHaZB3sHty4Dw0C4XtkT_LIfKK8xXy0b_-aNEFbcs5bhtD9dCpa5ucAztBIDMaqAjdkf170_qCuw=w72-h72-p-k-no-nu"
                                            src="https://blogger.googleusercontent.com/img/a/AVvXsEj-MoIi_dqSkBraVv3h7udD5Ip_S1u29vu8FU1pZ6dtBghHpqGrXwMLpuQTi7Cj7dMK344350VmvymZ-ZnD_lzpmIPpMhgbvfLeaBh_RFc3pt0XxyCHaZB3sHty4Dw0C4XtkT_LIfKK8xXy0b_-aNEFbcs5bhtD9dCpa5ucAztBIDMaqAjdkf170_qCuw=w88-h77-p-k-no-nu">
                                    </a>
                                    <div class="relatedui-posts-box">
                                        <h2 class="entry-title vcard"><a
                                                href="https://color-ui-default-templateiki.blogspot.com/2021/09/sometimes-it-is-people-no-one-can.html"
                                                rel="bookmark" title="Sometimes it is the people no one can imagine">
                                                Sometimes it is the people no one can imagine</a></h2>
                                        <div class="post-snip">
                                            <span class="post-date">September 30, 2021</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="popular-post post item2">
                                    <a class="post-filter-link gaint image-nos image-nos"
                                        href="https://color-ui-default-templateiki.blogspot.com/2022/01/innovation-is-progress-in-face-of.html"
                                        title="Innovation is progress in the face of tradition.">
                                        <img alt="Innovation is progress in the face of tradition."
                                            class="snip-thumbnail lazy-img"
                                            data-src="https://blogger.googleusercontent.com/img/a/AVvXsEigNfJKFOlqRuX5JP7vO0T3oLUo88PWadxTi5D84lpZXd3qD9OIE8pjio_PMRkXWpBo_Eqa1On2KUZPF1oP_mZi5v3EiGrUwjf3hjfoBWOdg-kJXpSpqL7FuDgoWQ_ANfNdN2keGS97C9zQEVTJCVOPO4GocKpf0-U7-GRGyTpkPDFiJkyBvD-zE8zm0Q=w72-h72-p-k-no-nu"
                                            src="https://blogger.googleusercontent.com/img/a/AVvXsEigNfJKFOlqRuX5JP7vO0T3oLUo88PWadxTi5D84lpZXd3qD9OIE8pjio_PMRkXWpBo_Eqa1On2KUZPF1oP_mZi5v3EiGrUwjf3hjfoBWOdg-kJXpSpqL7FuDgoWQ_ANfNdN2keGS97C9zQEVTJCVOPO4GocKpf0-U7-GRGyTpkPDFiJkyBvD-zE8zm0Q=w88-h77-p-k-no-nu">
                                    </a>
                                    <div class="relatedui-posts-box">
                                        <h2 class="entry-title vcard"><a
                                                href="https://color-ui-default-templateiki.blogspot.com/2022/01/innovation-is-progress-in-face-of.html"
                                                rel="bookmark"
                                                title="Innovation is progress in the face of tradition.">
                                                Innovation is progress in the face of tradition.</a></h2>
                                        <div class="post-snip">
                                            <span class="post-date">January 19, 2022</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="popular-post post item3">
                                    <a class="post-filter-link gaint image-nos image-nos"
                                        href="https://color-ui-default-templateiki.blogspot.com/2022/01/the-way-to-get-good-ideas-is-to-get.html"
                                        title="The way to get good ideas is to get lots of ideas">
                                        <img alt="The way to get good ideas is to get lots of ideas"
                                            class="snip-thumbnail lazy-img"
                                            data-src="https://blogger.googleusercontent.com/img/a/AVvXsEgNK2RjuGAOz4LPxIc-WiBa-52s2tCsVBZgMFWjFPyP6c9WDDQi8Chy0yhCdn-4Y7EgR8yiol6UKk5_j_U24p2bwqwoQppTQ3IM-HyAElnaqBIctVT8piyojtTDcNTjTUPjq45UN4avv96F9kkLbGBP6Muo75JeRoBGbN8IMVXuA0LEbYQrsapDyvgyPA=w72-h72-p-k-no-nu"
                                            src="https://blogger.googleusercontent.com/img/a/AVvXsEgNK2RjuGAOz4LPxIc-WiBa-52s2tCsVBZgMFWjFPyP6c9WDDQi8Chy0yhCdn-4Y7EgR8yiol6UKk5_j_U24p2bwqwoQppTQ3IM-HyAElnaqBIctVT8piyojtTDcNTjTUPjq45UN4avv96F9kkLbGBP6Muo75JeRoBGbN8IMVXuA0LEbYQrsapDyvgyPA=w88-h77-p-k-no-nu">
                                    </a>
                                    <div class="relatedui-posts-box">
                                        <h2 class="entry-title vcard"><a
                                                href="https://color-ui-default-templateiki.blogspot.com/2022/01/the-way-to-get-good-ideas-is-to-get.html"
                                                rel="bookmark"
                                                title="The way to get good ideas is to get lots of ideas">
                                                The way to get good ideas is to get lots of ideas</a></h2>
                                        <div class="post-snip">
                                            <span class="post-date">January 19, 2022</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget HTML" data-version="2" id="HTML27">
                            <div class="widget-content"><a class="piki-ads-res" href="javascript:;">Your Responsive
                                    Ads code (Google Ads)</a></div>
                        </div>
                        <div class="widget LinkList" data-version="2" id="LinkList77">
                            <div class="widget-title">
                                <h3 class="title">Social Plugin</h3>
                            </div>
                            <div class="widget-content">
                                <ul class="socialFilter colorful social">
                                    <li class="facebook"><a aria-label="buttons" class="fa-facebook"
                                            href="http://fb.com/templateiki" rel="noopener noreferrer"
                                            target="_blank" title="facebook">facebook</a></li>
                                    <li class="whatsapp"><a aria-label="buttons" class="fa-whatsapp" href="#"
                                            rel="noopener noreferrer" target="_blank" title="whatsapp">whatsapp</a>
                                    </li>
                                    <li class="instagram"><a aria-label="buttons" class="fa-instagram"
                                            href="#" rel="noopener noreferrer" target="_blank"
                                            title="instagram">instagram</a></li>
                                    <li class="youtube"><a aria-label="buttons" class="fa-youtube" href="#"
                                            rel="noopener noreferrer" target="_blank" title="youtube">youtube</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="widget Label" data-version="2" id="Label2">
                            <div class="widget-title">
                                <h3 class="title">Labels</h3>
                            </div>
                            <div class="widget-content cloud-label">
                                <ul>
                                    <li><a class="label-name"
                                            href="https://color-ui-default-templateiki.blogspot.com/search/label/Healthy%20Beauty">Healthy
                                            Beauty<span class="label-count">1</span></a></li>
                                    <li><a class="label-name"
                                            href="https://color-ui-default-templateiki.blogspot.com/search/label/Life%20Journey">Life
                                            Journey<span class="label-count">4</span></a></li>
                                    <li><a class="label-name"
                                            href="https://color-ui-default-templateiki.blogspot.com/search/label/Living%20Way">Living
                                            Way<span class="label-count">6</span></a></li>
                                    <li><a class="label-name"
                                            href="https://color-ui-default-templateiki.blogspot.com/search/label/News">News<span
                                                class="label-count">10</span></a></li>
                                    <li><a class="label-name"
                                            href="https://color-ui-default-templateiki.blogspot.com/search/label/Times%20Stories">Times
                                            Stories<span class="label-count">7</span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="widget HTML sibForm" data-version="2" id="HTML23">
                            <div class="widget-content"
                                data-shortcode="(sibForm) #title=(Follow by Email) #caption=(Get Notified About Next Update Direct to Your inbox)">
                                <div class="follow-by-email">
                                    <h3 class="follow-by-email-title">Follow by Email</h3>
                                    <span class="follow-by-email-caption">Get Notified About Next Update Direct to Your
                                        inbox</span>
                                    <div class="follow-by-email-inner">
                                        <form
                                            action="https://97cd17d0.sibforms.com/serve/MUIEAJSKtLF2M2jDzBZKYtop6Wzb_j8nEM8iomzGkl805pvHR3DdfyfDvxZtpNkqGisNl2GFkMsclwowjzauyq-HGgZgymSh97Y7AtVUks84C-RAJ0zIBDvt4FLtAmALH7jhNfOFolTP0jJPXEDxYpS3sinEo2hgV6b-8XAicINr_aH3Kr2YXu0M7uPZsE5gNiONyUV5MOb0kdHK"
                                            method="post" name="sib-subscribe-form" novalidate=""
                                            onsubmit="window.open(&quot;https://97cd17d0.sibforms.com/serve/MUIEAJSKtLF2M2jDzBZKYtop6Wzb_j8nEM8iomzGkl805pvHR3DdfyfDvxZtpNkqGisNl2GFkMsclwowjzauyq-HGgZgymSh97Y7AtVUks84C-RAJ0zIBDvt4FLtAmALH7jhNfOFolTP0jJPXEDxYpS3sinEo2hgV6b-8XAicINr_aH3Kr2YXu0M7uPZsE5gNiONyUV5MOb0kdHK&quot;,&quot;popupwindow&quot;,&quot;scrollbars=yes,width=550,height=520&quot;);return true"
                                            target="popupwindow">
                                            <input class="follow-by-email-address" name="EMAIL"
                                                placeholder="Email Address" type="email" value="">
                                            <input class="follow-by-email-submit" name="subscribe" type="submit"
                                                value="Subscribe">
                                        </form>
                                    </div>
                                </div>
                                <div class="Follow-by-alert">* We promise that we don't spam !</div>
                            </div>
                        </div>
                        <div class="widget HTML" data-version="2" id="HTML19">
                            <div class="widget-title">
                                <h3 class="title">Nature</h3>
                            </div>
                            <div class="widget-content">4/sidebar/recent</div>
                        </div>
                        <div class="widget HTML" data-version="2" id="HTML2">
                            <div class="widget-title">
                                <h3 class="title">Comments</h3>
                            </div>
                            <div class="widget-content">4/comments/show</div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</x-guest-layout>
