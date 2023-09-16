<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', env('APP_NAME') ?? 'Laravel')</title>

    @stack('before-styles')
    @include('auth.includes.styles')
    @stack('after-styles')
</head>
<body>

    <div id="app" class="app">
        <main>
            @yield('content')
        </main>
    </div>

    @stack('before-scripts')
    @include('auth.includes.scripts')
    @stack('after-scripts')
</body>
</html>