<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- except been searched by search machines --}}
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ URL::asset('js/all.js') }}"></script>
   

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="https://fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> --}}
    {{-- <link href="https://fonts.googleapis.com/earlyaccess/cwtexyen.css" rel="stylesheet" type="text/css"> --}}
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC&amp;subset=chinese-traditional" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/editor.css') }}" rel="stylesheet">
    <link href="{{ asset('css/grv.css') }}" rel="stylesheet">
    <link href="{{ asset('css/grv/menu.css') }}" rel="stylesheet">
    <link href="{{ asset('css/system.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/grv/showExternally.css') }}" rel="stylesheet">
    

    <style>
        body,
        .popover {
            font-family: 'Microsoft JhengHei';
            font-weight: 700;
            color: #181818;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0px;
            font-weight: 700;
        }

        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 1px grey;
            /* border-radius: 10px; */
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #6c757d;
            border-radius: 10px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #6c757d;
        }
    </style>
    @show
</head>

<body>

    <div id="app">
        @auth
        @include('grv.CMS.menu')
        @else
        @include('grv.CMS.nav')
        <main style="padding:90px 0; height:100vh;">
            <section class="cd-section">
                <div class="container p-0">
                    @yield('content')
                </div>
                <div id="cd-loading-bar" data-scale="1" class="index"></div> <!-- lateral loading bar -->
            </section>
        </main>
        @endauth
    </div>
    </div>
    @yield('script')
    @section('javascript')
    <script defer src="{{ URL::asset('js/icon.js') }}"></script>

    <script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/grv.js') }}"></script>

    @show
</body>

</html>