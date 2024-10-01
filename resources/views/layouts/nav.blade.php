<sidebar class="sidebar-menu">
    <header class="header">
        <a href="{{ route('Dashboard') }}"><img src="{{ asset('assets/Images/FCU-Logo.jpg') }}" alt="Logo"><span>OSA IMS</span></a> 
        <span id="sidebar-toggle-button">
            <i class="fa-solid fa-bars icon open"></i>
            <i class="fa-solid fa-times icon close"></i>
        </span>
    </header>
    <ul class="sidebar-list">
        <li title="Dashboard" class="{{ request()->routeIs('Dashboard') ? 'active' : '' }}" >
            <a href="{{ route('Dashboard') }}"><i class="fa-solid fa-gauge icon"></i>Dashboard</a>
        </li>

        <li title="Users" class="{{ request()->routeIs('Users') || request()->routeIs('user.create') ? 'active' : '' }}" >
            <a href="{{ route('Users') }}"><i class="fa-solid fa-users icon"></i>Users</a>
        </li>

        <li title="Violators" class="{{ request()->routeIs('Violators') ? 'active' : '' }}" >
            <a href="{{ route('Violators') }}"><i class="fa-solid fa-exclamation-triangle icon"></i>Violators</a>
        </li>

        <li title="Organizations" class="{{ request()->routeIs('Organizations') ? 'active' : '' }}" >
            <a href="{{ route('Organizations') }}"><i class="fa-solid fa-sitemap icon"></i>Organizations</a>
        </li>

        <li title="Documents" class="{{ request()->routeIs('Documents') ? 'active' : '' }}" >
            <a href="{{ route('Documents') }}"><i class="fa-solid fa-folder-open icon"></i>Documents</a>
        </li>

        <li title="Appointments" class="{{ request()->routeIs('Appointments') ? 'active' : '' }}" >
            <a href="{{ route('Appointments') }}"><i class="fa-solid fa-book-open icon"></i>Appointments</a>
        </li>
        
        <li title="Settings" class="{{ request()->routeIs('Settings') ? 'active' : '' }}" >
            <a href="{{ route('Settings') }}"><i class="fa-solid fa-cog icon"></i>Settings</a>
        </li>
    </ul>
</sidebar>

<nav class="nav-bar">
    <div class="notifications">
        <span><i class="fa-solid fa-envelope icon"></i></span>
        <span><i class="fa-solid fa-bell icon"></i></span>
        <span><div class="vertical-line"></div></span>
    </div>
    <div class="profile">
        <span class="profile-dropdown">
            <img src="{{ asset('assets/Images/Default-Profile.png') }}" alt="Avatar">
            <i class="fa-solid fa-caret-down icon"></i>
            <div class="dropdown">
                <div class="dropdown-content">
                    <a id="Signout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa-solid fa-right-from-bracket icon"></i>
                        LOGOUT
                        <!-- Logout Form -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </a>
                </div>
            </div>
        </span>
    </div>
</nav>  