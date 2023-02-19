<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ isset($active) && $active == 'dashboard' ? '' : 'collapsed'  }}" href="/dashboard">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-heading">Data Management</li>

        <li class="nav-item">
            <a class="nav-link {{ isset($active) && $active == 'petugas' ? '' : 'collapsed'  }}" href="/petugas">
            <i class="bi bi-person-plus"></i>
            <span>Petugas</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ isset($active) && $active == 'manajemen-siswa' ? '' : 'collapsed'  }}" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-people"></i><span>Manajemen Siswa</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse {{ isset($active) && $active == 'manajemen-siswa' ? 'show' : ''  }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/kelas" class="{{ isset($sub) && $sub == 'kelas' ? 'active' : ''  }}">
                        <i class="bi bi-circle"></i><span>Kelas</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside><!-- End Sidebar-->