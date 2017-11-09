<ul class="nav nav-pills flex-column">
    <li class="nav-item"><a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Home</a></li>
    <li class="nav-item"><a class="nav-link {{ Request::is('users*') ? 'active' : '' }}" href="/users">Users</a></li>
    <li class="nav-item"><a class="nav-link {{ Request::is('course*') ? 'active' : '' }}" href="/course">Courses</a></li>
    <hr/>
    <li class="nav-item"><a class="nav-link {{ Request::is('tickets*') ? 'active' : '' }}" href="/tickets">Help</a></li>
</ul>
