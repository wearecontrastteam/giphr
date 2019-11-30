<div class="col-md-3">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="{{route('home')}}">Home</a>
        </li>
        @auth
        <li class="nav-item">
            <a class="nav-link" href="{{route('profile')}}">My Profile</a>
        </li>
        @elseguest
            <li class="nav-item">
                <a class="nav-link" href="#">Sign in with Twitter</a>
            </li>
        @endauth
    </ul>
</div>
