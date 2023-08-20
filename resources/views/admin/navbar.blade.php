<div class="sticky-top">
    <header class="navbar navbar-expand-md d-print-none sticky-top" data-bs-theme="dark">
        <div class="container-xl">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                <a href="{{ route('admin.home') }}">
                    <x-application-logo width="110" height="32" alt="Tabler" class="navbar-brand-image" />
                </a>
            </h1>
            <div class="navbar-nav flex-row order-md-last">

                <div class="nav-item d-none d-md-flex me-3">
                    <div class="btn-list">
                        <a href="{{ route('guest.index') }}" class="btn" target="_blank" rel="noreferrer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-world-upload"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M21 12a9 9 0 1 0 -9 9"></path>
                                <path d="M3.6 9h16.8"></path>
                                <path d="M3.6 15h8.4"></path>
                                <path d="M11.578 3a17 17 0 0 0 0 18"></path>
                                <path d="M12.5 3c1.719 2.755 2.5 5.876 2.5 9"></path>
                                <path d="M18 21v-7m3 3l-3 -3l-3 3"></path>
                            </svg>
                            @lang('Blog')
                        </a>

                    </div>
                </div>


                <div class="d-none d-md-flex" id="mode-admin">
                    <span id="theme-dark" class="nav-link px-0 hide-theme-dark" title="Dark" data-bs-toggle="tooltip"
                        data-bs-placement="bottom">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                        </svg>
                    </span>
                    <span id="theme-light" class="nav-link px-0 hide-theme-light" title="Light"
                        data-bs-toggle="tooltip" data-bs-placement="bottom">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                            <path
                                d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                        </svg>
                    </span>

                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                        aria-label="Open user menu">
                        <span class="avatar avatar-sm"
                            style="background-image: url({{ auth()->user()->info->photo }})"></span>
                        <div class="d-none d-xl-block ps-2">
                            <div>{{ auth()->user()->name }}</div>
                            <div class="mt-1 small text-muted">{{ auth()->user()->getRoleNames()[0] }}
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <a href="{{ route('admin.profile.edit') }}" class="dropdown-item">@lang('Profile')</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <header class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="navbar">
                <div class="container-xl">
                    <ul class="navbar-nav">
                        <li @class(['nav-item', 'active' => request()->routeIs('admin.home')])>
                            <a class="nav-link" href="{{ route('admin.home') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    @lang('Home')
                                </span>
                            </a>
                        </li>

                        <li @class([
                            'nav-item dropdown',
                            'active' => request()->routeIs('admin.posts.*'),
                        ])>
                            <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown"
                                data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9 11l3 3l8 -8" />
                                        <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                                    </svg>
                                </span>

                                <span class="nav-link-title">
                                    @lang('Posts')
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('admin.posts.index') }}">
                                    @lang('All Posts')
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.posts.create') }}">
                                    @lang('New Post')
                                </a>

                                <a class="dropdown-item" href="{{ route('admin.posts.categories.index') }}">
                                    @lang('Categories')
                                </a>

                                <a class="dropdown-item" href="{{ route('admin.posts.tags.index') }}">
                                    @lang('Tags')
                                </a>

                            </div>
                        </li>

                        @role('administrator')
                            <li @class([
                                'nav-item',
                                'active' => request()->routeIs('admin.users.index'),
                            ])>
                                <a class="nav-link" href="{{ route('admin.users.index') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        @lang('Users')
                                    </span>
                                </a>
                            </li>

                            <li @class([
                                'nav-item',
                                'active' => request()->routeIs('admin.settings.*'),
                            ])>
                                <a class="nav-link" href="{{ route('admin.settings') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-file-settings" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                            <path d="M12 10.5v1.5"></path>
                                            <path d="M12 16v1.5"></path>
                                            <path d="M15.031 12.25l-1.299 .75"></path>
                                            <path d="M10.268 15l-1.3 .75"></path>
                                            <path d="M15 15.803l-1.285 -.773"></path>
                                            <path d="M10.285 12.97l-1.285 -.773"></path>
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                            <path
                                                d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                            </path>
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        @lang('Settings')
                                    </span>
                                </a>
                            </li>
                        @endrole



                    </ul>

                </div>
            </div>
        </div>
    </header>
</div>
