<div id="app">
        <nav class="navbar navbar-expand-md navbar-light @yield('nav-bg','navbar-bg')">
            <div class="container">
                <a class="navbar-brand" href="/"><img src="{{asset("images/logo_with_name_blogosphere.png")}}"></a>
{{--{{ config('app.name', 'Laravel') }}--}}
</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="container1 " id="menulogo" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" onclick="menu(this)">
                        <div class="bar1"></div>
                        <div class="bar2"></div>
                        <div class="bar3"></div>
                    </div>
                </button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <!-- Left Side Of Navbar -->
{{--    <ul class="navbar-nav mr-auto">--}}

{{--    </ul>--}}

    <!-- Right Side Of Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        <li class="nav-item active">
            <a class="nav-link  font-weight-bold text-white" href="/">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="/about">About us</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="/read">Read blog</a>
        </li>
        @guest
            @if (Route::has('login'))
                <li class="nav-item login">
                    <a class="text-white btn-auth btn-lg blue" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @endif

            @if (Route::has('register'))
                <li class="nav-item sign_up">
                    <a class="text-white btn-auth btn-lg blue" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item">
                <a class="nav-link text-white" href="/add">Add blog</a>
            </li>
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <img src="/storage/profile_pictures/{{Auth::user()->image }}" alt="prof pic" width=30" height="30" style="border-radius: 50%">
                    {{ Auth::user()->name . ' ' . Auth::user()->lastname}}
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/profile">My page</a>
                    <a class="dropdown-item " href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>
</div>
</div>
</nav>

<main class="py-4">
    @yield('content')
</main>
</div>
