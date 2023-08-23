<!DOCTYPE html>
<html lang="en" lang="en" data-footer="true"
    data-override='{
        "attributes": {
            "placement": "vertical",
            "layout": "fluid",
            "radius": "standard",
            "color": "light-lime",
            "navcolor": "default"
        }
    }'>

@include('panel.head')
<style>
    input[type="checkbox"]:checked {
        background: red;
    }
</style>

<body>
    <div id="root">
        @if (Auth::user())
            @include('panel.nav')
        @endif

        @yield('content')

        @include('panel.footers')
    </div>
    @include('panel.script')
    @stack('script')
</body>

</html>
