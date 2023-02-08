<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ isset($active) && $active == 'dashboard' ? 'active' : '' }}" aria-current="page" href="/dashboard">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Dashboard
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
            <span>Data Management</span>
                
            <a class="link-secondary" href="#" aria-label="Add a new report">
                <span data-feather="database" class="align-text-bottom"></span>
            </a>
        </h6>

        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link {{ isset($active) && $active == 'petugas' ? 'active' : '' }}" aria-current="page" href="/petugas">
                    <span data-feather="user-plus" class="align-text-bottom"></span>
                    Petugas
                </a>
            </li>
        </ul>
    </div>
</nav>