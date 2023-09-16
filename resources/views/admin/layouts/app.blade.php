<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', env('APP_NAME') ?? 'Laravel')</title>

    @stack('before-styles')
    @include('admin.includes.styles')
    @stack('after-styles')
</head>
<body>

    <div id="app" class="app">
        {{-- navbar --}}
        @include('admin.includes.navbar')

        <main class="py-4 mb-5">
            <div class="container">
                <div class="row">
                    {{-- Sidebar --}}
                    @include('admin.includes.sidebar')

                    <div class="col-lg-9 mx-lg-0 my-3 my-lg-0">
                        {{-- Content --}}
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>

    @stack('before-scripts')
    @include('admin.includes.scripts')
    @stack('after-scripts')

    @stack('modal')
</body>
</html>