<!DOCTYPE html>
<html>
<head>
	@include('includes.head')
</head>
<body style="padding-top:70px;">

    <header class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        @include('includes.header')
    </header>

    <div class="container">

        <div id="main" class="row">

            <!-- sidebar content -->
            <div id="sidebar" class="col-md-2">
                @include('includes.sidebar')
            </div>

            <!-- main content -->
            <div id="content" class="col-md-10">
                @yield('content')
            </div>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        </div><!-- /.modal -->

        <footer class="row" style="margin: 50px 0;">
            @include('includes.footer')
        </footer>

    </div>
    @include('includes.foot')
</body>
</html>