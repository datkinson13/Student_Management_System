<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="/">Dashboard</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        {{-- Leaving this home link here for now as an example but how many do we really need?
              Dashboard is a link home, and there is another home link in the side bar.        --}}
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            @if ($currentUser)
                <li class="nav-item active dropdown">
                    <!-- Will need to pass in $user object for name variables? -->
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button"
                       aria-expanded="false"
                       aria-haspopup="true">
                        {{ $currentUser->Fname }} {{ $currentUser->Lname }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                                     document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            @else
                <li class="nav-item dropdown {{ Request::is('login*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item dropdown {{ Request::is('register*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
            @endif
        </ul>
    </div>
</nav>
