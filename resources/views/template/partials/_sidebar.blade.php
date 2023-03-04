<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        @can('adminOrPetugas')
            <li class="nav-item">
                <a class="nav-link {{ isset($active) && $active == 'dashboard' ? '' : 'collapsed'  }}" href="/dashboard">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->
        @endcan

        @can('admin')
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
                    <li>
                        <a href="/siswa" class="{{ isset($sub) && $sub == 'siswa' ? 'active' : ''  }}">
                            <i class="bi bi-circle"></i><span>Siswa</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ isset($active) && $active == 'spp' ? '' : 'collapsed'  }}" href="/spp">
                    <i class="bi bi-receipt"></i>
                    <span>SPP</span>
                </a>
            </li>
        @endcan

        <li class="nav-heading">History & Pembayaran</li>

        @can('adminOrPetugas')
            <li class="nav-item">
                <a class="nav-link {{ isset($active) && $active == 'transaksi_pembayaran' ? '' : 'collapsed'  }}" href="/pembayaran">
                    <i class="bi bi-cash"></i>
                    <span>Transaksi Pembayaran</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ isset($active) && $active == 'history_pembayaran' ? '' : 'collapsed'  }}" href="/history">
                    <i class="bi bi-clock-history"></i>
                    <span>History Pembayaran</span>
                </a>
            </li>
        @endcan

        @can('siswa')
            <li class="nav-item">
                <a class="nav-link {{ isset($active) && $active == 'history_pembayaran_siswa' ? '' : 'collapsed'  }}" href="/siswa-history">
                    <i class="bi bi-clock-history"></i>
                    <span>History Pembayaran</span>
                </a>
            </li>
        @endcan

        <li class="nav-heading">Log out</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="/logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Keluar</span>
            </a>
        </li>
    </ul>
</aside><!-- End Sidebar-->
