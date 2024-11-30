<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        {{-- Header hanya tampil jika layout adalah MainLayout --}}
        @if($layout !== 'BlankLayout')
            @include('fe.components.header')
        @endif

        <div class="container">
            {{-- Sidebar hanya tampil jika layout adalah MainLayout --}}
            @if($layout !== 'BlankLayout')
                @include('fe.components.sidebar')
            @endif

            <main>
                {{-- Render layout yang sesuai --}}
                @if($layout === 'BlankLayout')
                    @yield('content')
                @else
                    {{-- @include('fe.layouts.main', ['content' => View::yieldContent('content')]) --}}
                    @yield('content')
                @endif
            </main>
        </div>
    </div>
</body>
</html>
