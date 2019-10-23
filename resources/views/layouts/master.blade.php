<!DOCTYPE html>
<html>
@include('layouts.header')

<body class="hold-transition sidebar-mini layout-fixed text-sm">
    <div class="wrapper">
        @include('layouts.menu.nav')

        <div class="content-wrapper">
            <!-- Content Header -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">@yield('title')</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            @yield('content')

        </div>


        <!-- Modal -->
        @yield('modal')

        <!-- Footer -->
        @include('layouts.footer')
    </div>
</body>

</html>