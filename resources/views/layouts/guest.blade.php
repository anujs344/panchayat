@php
use App\Models\SeoTool;
use App\Models\VisualSetting;

    $seo = SeoTool::first();
    $visualSetting = VisualSetting::first();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{$meta['ogdescription'] ?? ''}}">
        <meta name="keywords" content="{{$meta['keywords'] ?? ''}}">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" href="{{ isset($visualSetting) ? asset('storage/media/images/logo/' . $visualSetting->favicon_icon) : '' }}" type="image/png" />
        <title>@if (isset($meta['ogtitle'])){{$meta['ogtitle']}}@else @yield('title')@endif</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{asset('assets_home/css/style.css')}}">
        {{-- Notification --}}
        <link rel="stylesheet" href="{{ asset('assets/plugins/notifications/css/lobibox.min.css') }}" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

        {{-- share link --}}
        <meta property="og:site_name" content="{{ucwords($seo->site_title ?? '')}}"/>
        <meta property="og:type" content="{{ $meta['ogtype'] ?? 'website'}}" />
        <meta property="og:title" content="{{$meta['ogtitle'] ?? ''}}" />
        <meta property="og:description" content="{{$meta['ogdescription'] ?? ''}}" />
        <meta property="og:image" content="{{$meta['ogimage'] ?? ''}}" />
        <meta property="og:url" content="{{$meta['ogurl'] ?? ''}}" />

        <meta name="twitter:title" content="{{$meta['ogtitle'] ?? ''}}">
        <meta name="twitter:description" content="{{$meta['ogdescription'] ?? ''}}">
        <meta name="twitter:image" content="{{$meta['ogimage'] ?? ''}}">
        <meta name="twitter:site" content="{{ '@'.ucwords($seo->site_title ?? '') }}">
        {{-- <meta name="twitter:creator" content="@subhadipghorui"> --}}

        @stack('styles')
        @livewireStyles

    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            @livewire('user.header')
            {{ $slot ?? '' }}
            @yield('content')
            @livewire('user.footer')
        </div>

        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="{{asset('assets_home/js/script.js')}}"></script>
        <!-- Plugins -->
        <script src="{{asset('js/printThis.js')}}"></script>
        <!-- Custom Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <!--notification js -->
        <script src="{{ asset('assets/plugins/notifications/js/lobibox.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/notifications/js/notifications.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/notifications/js/notification-custom-script.js') }}"></script>

        @stack('js')

        @livewireScripts

        <script>
            // Notification
            @if (session()->has('success'))
                round_success_noti("{{session()->get('success')}}");
            @endif
            @if (session()->has('error'))
                round_error_noti("{{session()->get('error')}}");
            @endif
            @if (session()->has('information'))
                round_info_noti("{{session()->get('information')}}");
            @endif
            @if (session()->has('warning'))
                round_warning_noti("{{session()->get('warning')}}");
            @endif
        </script>
    </body>
</html>
