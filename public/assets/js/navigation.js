// toggle sidebar and update the navbar based on sidebar state
function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar-menu');
    const navbar = document.querySelector('.nav-bar');

    sidebar.classList.toggle('toggle');

    if (sidebar.classList.contains('toggle')) {
        // Sidebar is expanded
        navbar.style.left = '256px';
        navbar.style.width = 'calc(100% - 256px)';
        localStorage.setItem('sidebarState', 'expanded');
    } else {
        // Sidebar is collapsed
        navbar.style.left = '70px';
        navbar.style.width = 'calc(100% - 70px)';
        localStorage.setItem('sidebarState', 'collapsed'); 
    }
}

document.querySelector('#sidebar-toggle-button').addEventListener('click', function() {
    toggleSidebar();
});

// On page load, check the localStorage for the sidebar state
document.addEventListener('DOMContentLoaded', function() {
    const sidebarState = localStorage.getItem('sidebarState');
    const sidebar = document.querySelector('.sidebar-menu');
    const navbar = document.querySelector('.nav-bar');

    if (sidebarState === 'expanded') {
        sidebar.classList.add('toggle');
        navbar.style.left = '256px';
        navbar.style.width = 'calc(100% - 256px)';
    } else {
        sidebar.classList.remove('toggle');
        navbar.style.left = '70px';
        navbar.style.width = 'calc(100% - 70px)';
    }


    const profileDropdown = document.querySelector('.profile-dropdown');
    const dropdownMenu = document.querySelector('.profile-dropdown .dropdown');
    
    profileDropdown.addEventListener('click', function() {
        dropdownMenu.classList.toggle('active');
    });

    document.addEventListener('click', function(event) {
        if (!profileDropdown.contains(event.target)) {
            dropdownMenu.classList.remove('active');
        }
    });

});
