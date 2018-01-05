<ul class="nav nav-pills flex-column">
    <li class="nav-item"><a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Home</a></li>
    @if (Auth::check())<li class="nav-item"><a class="nav-link {{ Request::is('users*') ? 'active' : '' }}" href="/users">Users</a></li>@endif
    <li class="nav-item"><a class="nav-link {{ Request::is('course*') ? 'active' : '' }}" href="/course">Courses</a></li>
    @if (Auth::check())<li class="nav-item"><a class="nav-link {{ Request::is('businessroles*') ? 'active' : '' }}" href="/businessroles">Business Roles</a></li>@endif
    @if (Auth::check())<li class="nav-item"><a class="nav-link {{ Request::is('/competencies/monitor') ? 'active' : '' }}" href="/competencies/monitor">Competency Monitor</a></li>@endif
    @if (Auth::check())<li class="nav-item"><a class="nav-link {{ Request::is('/trainingliability/calculate') ? 'active' : '' }}" href="/trainingliability/calculate">Net Training Liability</a></li>@endif
    <li class="nav-item"><a class="nav-link {{ Request::is('/calendar*') ? 'active' : '' }}" href="/calendar">Calendar</a></li>
    @if (Auth::check())<li class="nav-item"><a class="nav-link {{ Request::is('reports*') ? 'active' : '' }}" href="/reports">Reports</a></li>@endif
    @if (Auth::check())<li class="nav-item"><a class="nav-link {{ Request::is('enrollment*') ? 'active' : '' }}" href="/enrollment">Enrollment</a></li>@endif
    <hr/>
    <li class="nav-item"><a class="nav-link {{ Request::is('tickets*') ? 'active' : '' }}" href="/tickets">Help</a></li>
</ul>
