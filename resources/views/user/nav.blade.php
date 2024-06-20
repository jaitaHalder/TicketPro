<ul class="list-group list-group-flush">
    <li>
        <a href="{{ route('user.dashboard') }}" class="list-group-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">Dashboard</a>
    </li>
    <li>
        <a href="{{ route('user.bookings') }}" class="list-group-item {{ request()->routeIs('user.bookings') ? 'active' : '' }}">Bookings</a>
    </li>
    <li>
        <a href="{{ route('user.change_password') }}" class="list-group-item {{ request()->routeIs('user.change_password') ? 'active' : '' }}">Change Password</a>
    </li>
    <li>
        <a href="{{ route('user.logout') }}" class="list-group-item">Logout</a>
    </li>
</ul>