<?php

use Illuminate\Support\Facades\Auth;

$logout = function () {
    Auth::logout(); // Menghapus session login
    return redirect("/"); // Mengarahkan ulang ke halaman utama
};
?>

@volt
    <div>
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

            </ul>

        </nav>

    </div>
@endvolt
