<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.partials.head')
</head>
<body>
    <div class="dashboard-main-wrapper">
        @include('layouts.partials.navbar')
        @include('layouts.partials.sidebar')

        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                @yield('content')
            </div>
            @include('layouts.partials.footer')
        </div>
    </div>
    @include('layouts.partials.scripts')
</body>
</html>
