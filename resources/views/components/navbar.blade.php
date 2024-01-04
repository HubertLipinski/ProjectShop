<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm py-4">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Logowanie</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Rejestracja</a>
                        </li>
                    @endif
                @else
                    @if(auth()->user()->hasAccess('platform.index'))
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="{{ route('platform.index') }}">Panel Administratora</a>
                        </li>
                    @endif
                    <li class="nav-item px-2">
                        <a class="nav-link" href="{{ route('products.index') }}">Lista produktów</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                            Koszyk <cart-indicator :cart-count="{{ $cartCount }}"/>
                        </a>
                    </li>
                    <li class="nav-item dropdown px-2">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a href="{{ route('payment.orders') }}" class="dropdown-item">Moje zamówienia</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                Wyloguj się
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
