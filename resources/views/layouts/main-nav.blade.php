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
                <li>
                    Student Organization
                    <span><i class="fa-solid fa-caret-right sub-icon"></i></span>
                    <ul class="sub-dropdown"> 
                        <li><a href="{{ route('registration.guidelines') }}">Registration Guidelines</a></li>
                        <li><a>Apply For Registration</a></li>
                        <li><a>Registered Organization</a></li>
                    </ul>
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
    </ul>
    <a href="{{ route('login.student') }}" class="login-btn">LOGIN</a>
</nav>