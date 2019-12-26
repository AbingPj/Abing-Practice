<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.partials.head')
    @yield('head')
</head>

<body>
    <div id="app">
        <div class="main-container">  
               
                @include('layouts.partials.navbar')
                <div class="container">
                        @yield('content')
                </div>
              
            {{-- <main class="py-4">
                @yield('content')
            </main> --}}
        </div>
        @include('layouts.partials.footer')
    </div>

    @include('layouts.partials.footer-scripts')
    @yield('scripts')
</body>
</html>
