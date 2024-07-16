<!doctype html>

@if($getLocale == 'ar')
     <html lang="ar" dir="rtl">
@else
     <html lang="en">
@endif

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('theme/images/favicon.png') }}">

    <!-- Style -->
    @include('layouts.style')
</head>
<body>
    <div id="app" class="{{ ($getLocale == 'ar') ? 'right-to-left' : '' }}">
        @include('layouts.header')
        
        <main class="py-4">
            <!-- Show flash messages -->
            @include('components.alert')

            @yield('content')
        </main>

        @include('layouts.footer')
    </div>

    <!-- Script -->
    @include('layouts.script')
</body>
</html>
