<?php

use Illuminate\Support\Facades\Auth;

$logout = function () {
    Auth::logout(); // Menghapus session login
    return redirect("/"); // Mengarahkan ulang ke halaman utama
};
?>

@volt
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
            <div class="container">
                <a class="navbar-brand" href="/">E-Kost</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-sm-0 mx-lg-2">
                            <a class="nav-link  {{ request()->routeIs("welcome") ? "active text-primary fw-bold" : "" }} "
                                href="/">Beranda</a>
                        </li>
                        <li class="nav-item mx-sm-0 mx-lg-2">
                            <a class="nav-link {{ request()->routeIs("catalog.listing") ? "active text-primary fw-bold" : "" }}"
                                href="{{ route("catalog.listing") }}">Cari Kost</a>
                        </li>

                        <li class="nav-item mx-sm-0 mx-lg-2">
                            <a class="nav-link " href="#">Kontak</a>
                        </li>

                        <li class="nav-item mx-sm-0 mx-lg-2 {{ Auth()->check() ?: "d-none" }}">
                            <a class="nav-link " href="{{ route("transactions.index") }}">Transaksi</a>
                        </li>

                        <li class="nav-item mx-sm-0 mx-lg-2">
                            @auth

                                @if (Auth::user()->role === "admin")
                                    <a class="btn btn-outline-primary" href="{{ route("home") }}">Dashboard</a>
                                @elseif (Auth::user()->role === "owner")
                                    <a class="btn btn-outline-primary" href="{{ route("home") }}">Dashboard</a>
                                @else
                                    <div class="d-flex gap-4 mt-lg-0 mt-sm-3">

                                        <a class="btn btn-outline-primary" href="{{ route("profile.guest") }}">Data Profil</a>
                                        <a class="btn btn-outline-primary" wire:click="logout" href="#">Keluar</a>
                                    </div>
                                @endif
                            @else
                                <div class="d-flex gap-4 mt-lg-0 mt-sm-3">
                                    <a class="btn btn-primary" href="{{ route("register") }}">Daftar</a>
                                    <a class="btn btn-outline-primary" href="{{ route("login") }}">Masuk</a>
                                </div>
                            @endauth
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </div>
@endvolt
