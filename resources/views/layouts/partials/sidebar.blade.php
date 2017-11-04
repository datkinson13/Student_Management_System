<ul class="nav nav-pills flex-column">
    <li class="nav-item"><a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Home</a></li>
    <li class="nav-item"><a class="nav-link {{ Request::is('course*') ? 'active' : '' }}" href="/course">Courses</a></li>
</ul>


<ul class="nav nav-pills flex-column">
    <li class="nav-item">Demonstration purposes only:</li>
    <li class="nav-item"><a class="nav-link {{ Request::is('login*') ? 'active' : '' }}" href="/login">Login</a></li>
</ul>