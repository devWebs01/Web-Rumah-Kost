<nav class="sidebar-nav scroll-sidebar" data-simplebar="">
    <ul id="sidebarnav">
        {{-- Admin --}}
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Beranda</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route("home") }}" aria-expanded="false">
                <span>
                    <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
            </a>
        </li>
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Pengguna</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route("admins.index") }}" aria-expanded="false">
                <span>
                    <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Admin</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route("owners.index") }}" aria-expanded="false">
                <span>
                    <i class="ti ti-alert-circle"></i>
                </span>
                <span class="hide-menu">Pemilik Kost</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route("guests.index") }}" aria-expanded="false">
                <span>
                    <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Penyewa</span>
            </a>
        </li>
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Kos-Kosan</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route("boardingHouses.index") }}" aria-expanded="false">
                <span>
                    <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Data Kos</span>
            </a>
        </li>

        {{-- Pemilik Kos --}}
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Kos</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route("boardingHouse.index") }}" aria-expanded="false">
                <span>
                    <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Data Kos</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route("rooms.index") }}" aria-expanded="false">
                <span>
                    <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Kamar</span>
            </a>
        </li>
    </ul>
    <div class="unlimited-access hide-menu bg-light-primary position-relative mb-7 mt-5 rounded">
        <div class="d-flex">
            <div class="unlimited-access-title me-3">
                <h6 class="fw-semibold fs-4 mb-6 text-dark w-85">Upgrade to pro</h6>
                <a href="
                https://adminmart.com/product/modernize-bootstrap-5-admin-template/"
                    target="_blank" class="btn btn-primary fs-2 fw-semibold lh-sm">Buy Pro</a>
            </div>
            <div class="unlimited-access-img">
                <img src="{{ asset("be-assets/images/backgrounds/rocket.png") }}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
</nav>
