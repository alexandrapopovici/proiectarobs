<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><img src="{{ URL::to('img/slider/background1.jpg') }}" height="50px" width="110px"/></li>
                <li><img src="{{ URL::to('img/slider/bk.jpg') }}" height="50px" width="250px"/></li>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/about') }}">AboutUs</a></li>
                <?php if (!Auth::check()) { ?>
                    <li><a href="{{ url('/signin') }}" >SignIn</a></li>
                    <li><a href="{{ url('/login') }}" >LogIn</a></li>
                <?php } if (Auth::check()) { ?>
                    <li><a href="{{ url('user/dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ url('user/logout') }}">LogOut</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

