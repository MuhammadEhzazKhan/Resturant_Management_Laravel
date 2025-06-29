<nav class="custom-navbar navbar navbar-expand-lg navbar-dark fixed-top" data-spy="affix" data-offset-top="10">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="{{ url('home') }}">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('home#about') }}">About</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('home#gallery') }}">Gallery</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('home#table') }}">Book-Table</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('home#blog') }}">Blog</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('home#testmonial') }}">Reviews</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('home#contact') }}">Contact</a></li>
        </ul>
        <a class="navbar-brand m-auto" href="#">
            <img src="assets/imgs/logo.svg" class="brand-img" alt="">
            <span class="brand-txt">Food Hut</span>
        </a>
        <ul class="navbar-nav">
            @if (Route::has('login'))
                @auth
                    <li class="nav-item"><a class="nav-link" href="{{ url('my_cart') }}">Cart</a></li>
                    <form action="{{ route('logout') }}" method="POST">@csrf
                        <input class="btn btn-primary ml-xl-4" type="submit" value="Logout">
                    </form>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                @endauth
            @endif
        </ul>
    </div>
</nav>
