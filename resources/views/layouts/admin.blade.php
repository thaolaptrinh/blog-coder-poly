<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@props(['single' => false, 'title' => __('Home')])

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />

    <title>{{ $title }} - {{ blog()->site_name }}</title>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <!-- CSS files -->
    <link href="{{ asset('back/dist/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('back/dist/css/tabler-flags.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('back/dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>


    @stack('stylesheets')
    @livewireStyles


</head>


<body {{ $attributes->merge(['class' => 'body-gradient']) }} id="main">
    <script type="text/javascript">
        (localStorage.getItem('mode-admin')) === 'dark' ? document.querySelector('#main').setAttribute('data-bs-theme',
                'dark'):
            document.querySelector('#main').removeAttribute('data-bs-theme');
    </script>
    @if ($single)
        {{ $slot }}
    @else
        <div class="page">
            <!-- Navbar -->
            @includeIf('admin.navbar')
            <div class="page-wrapper">
                {{ $slot }}
                <footer class="footer footer-transparent d-print-none">
                    <div class="container-xl">
                        <div class="row text-center align-items-center">

                            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                                <ul class="list-inline list-inline-dots mb-0">
                                    <li class="list-inline-item">
                                        Copyright &copy; {{ date('Y') }}
                                        <a href="javascript:;" class="link-secondary">{{ config('app.name') }}</a>.
                                        All rights reserved.
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    @endif


    @if (isset($modals))
        {{ $modals }}
    @endif

    <!-- Libs JS -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>

    <!-- Tabler Core -->
    <script src="{{ asset('back/dist/js/tabler.min.js') }}" defer></script>


    @livewireScripts


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        window.addEventListener('closeModal', () => {
            $('[id^="modal"]').modal('hide');

        })


        window.addEventListener('showModal', ({
            detail: {
                name,
            }
        }) => {

            $(`#${name}`).modal('show');
        })


        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        window.addEventListener('toast', ({
            detail: {
                type,
                message
            }
        }) => {
            Toast.fire({
                icon: type,
                title: message
            })
        })
    </script>

    @stack('scripts')
</body>

</html>
