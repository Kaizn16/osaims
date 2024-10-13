<nav class="nav-bar">
    <ul class="nav-list">
        <li class="{{ Request::is('index') ? 'active' : '' }}">
            <a href="{{ route('index') }}">Home</a> 
        </li>
        <li>
            Student Service 
            <span><i class="fa-solid fa-caret-right icon"></i></span>
            <ul class="dropdown">
                <li>
                    <a>OSAIMS Account Creation</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="">About OSA </a>
        </li>
        <li>
            OSA Documents 
            <span><i class="fa-solid fa-caret-right icon"></i></span>
        </li>
        <li>
            Organizations
            <span><i class="fa-solid fa-caret-right icon"></i></span>
            <ul class="dropdown">
                <li><a href="">Registered Organization</a></li>
                <li><a href="{{ route('apply.org') }}">Apply For Organization</a></li>
                <li><a href="{{ route('registration.guidelines') }}">Registration Guidelines</a></li>
            </ul>
        </li>
    </ul>
    <a href="{{ route('login.student') }}" class="login-btn">LOGIN</a>
</nav>