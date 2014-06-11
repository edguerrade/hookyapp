<div class="container">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ URL::to('/') }}">HookyApp</a>
    </div>

    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav navbar-right">
            <li>
                <form class="navbar-form" role="search">
                    <div class="form-group">
                        <select id="searchbox" name="q" placeholder="Search anything..." class="contacts form-control" style="width: 240px;"></select>
                    </div>
                </form>
            </li>
        </ul>
        @yield('nav')
    </div>

</div>