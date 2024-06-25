@php use App\Helper; @endphp
<footer class="container d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <p class="col-md-4 mb-0 text-muted fw-bold">{!! Helper::COPYRIGHT !!}</p>

    <a href="/"
       class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32">
            <use xlink:href="#bootstrap"></use>
        </svg>
    </a>

    <ul class="nav col-md-4 justify-content-end">
        <li class="nav-item"><a href="{{ route('home') }}" class="nav-link px-2 text-primary-800 fw-bold">Home</a></li>
        <li class="nav-item"><a href="{{ route('about_us') }}" class="nav-link px-2 text-primary-800 fw-bold">About Us</a></li>
        <li class="nav-item"><a href="{{ route('contact_us') }}" class="nav-link px-2 text-primary-800 fw-bold">Contact Us</a></li>
        <li class="nav-item"><a href="{{ route('privacy_policy') }}" class="nav-link px-2 text-primary-800 fw-bold">Privacy Policy</a>
        </li>
    </ul>
</footer>