<div class="col-md-3">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="{{route('timeline')}}">Timeline</a>
        </li>
        @auth
            <li class="nav-item">
                <a class="nav-link" href="{{route('profile.index')}}">My Profile</a>
            </li>
        @elseguest
            <li class="nav-item">
                <a class="nav-link" href="#">Sign in with Twitter</a>
            </li>
        @endauth
    </ul>
</div>
