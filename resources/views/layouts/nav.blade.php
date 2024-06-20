@php use App\Helper; @endphp
<nav class="navbar navbar-expand-lg bg-primary-800">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('storage/' . Helper::setting('SETTING_SITE_LOGO')) }}" width="130" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse flex justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    @auth('web')
                        <a class="nav-link text-white" href="{{ route('user.dashboard') }}">Dashboard</a>
                    @else
                        <a class="nav-link text-white" href="{{ route('user.login') }}">Login</a>
                    @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>
