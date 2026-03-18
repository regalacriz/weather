<!DOCTYPE html>
<html lang="en">

@include('layouts.head')

<body>

    <div id="content" class="d-flex flex-column">
        @yield('content')

        @stack('scripts')
    </div>

    @include('layouts.footer')
</body>

</html>
