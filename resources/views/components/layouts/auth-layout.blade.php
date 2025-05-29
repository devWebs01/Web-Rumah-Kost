<!doctype html>
<html lang="en">

    <head>
        <title>{{ $title ?? "" }} - Website Pemesanan Kamar Kost</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- Bootstrap CSS v5.2.1 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

        <style>
            @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap');

            * {
                font-family: "DM Sans", sans-serif;
                font-optical-sizing: auto;
                font-weight: <weight>;
                font-style: normal;
            }
        </style>

    </head>

    <body>
        <main
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <section class="container py-5">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-6 mb-5 mb-lg-0">
                            <div class="pe-lg-3">
                                <h1 class="display-5 fw-bold mb-2 mb-md-3">Temukan Kamar Kost yang
                                    <span class="text-primary">Nyaman!</span>
                                </h1>
                                <p class="lead mb-4">
                                    Daftar atau Masuk sekarang dan buktikan bahwa Anda adalah bagian dari komunitas
                                    kami!
                                </p>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="text-primary">
                                                <svg class="bi bi-chat-right-fill" fill="currentColor" height="32"
                                                    viewbox="0 0 16 16" width="32"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M14 0a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-0">Bantuan 24/7</h6>
                                            <p>Siap Membantu Anda</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="d-flex">
                                        <div class="text-primary">
                                            <svg class="bi bi-shield-fill-check" fill="currentColor" height="32"
                                                viewbox="0 0 16 16" width="32" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.777 11.777 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7.159 7.159 0 0 0 1.048-.625 11.775 11.775 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.541 1.541 0 0 0-1.044-1.263 62.467 62.467 0 0 0-2.887-.87C9.843.266 8.69 0 8 0zm2.146 5.146a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647z"
                                                    fill-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-0">Keamanan</h6>
                                            <p>Lingkungan Aman</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="ps-lg-5">
                                <div class="card shadow-lg border border-primary text-white text-left h-100">

                                    <div class="card-body bg-primary p-4 p-xl-5">
                                        {{-- Alert untuk pesan sukses --}}
                                        @if (session("success"))
                                            <div class="alert alert-light alert-dismissible fade show" role="alert">
                                                {{ session("success") }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif

                                        {{-- Alert untuk pesan error umum (bukan dari validasi) --}}
                                        @if (session("error"))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                {{ session("error") }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif

                                        {{-- Alert untuk error validasi --}}
                                        @if ($errors->any())
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <ul class="mb-0 list-unstyled">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif

                                        {{ $slot }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz4fnFO9gybYw0U3y7T2E1W4J3e7Z3gF1Vh7wU1h5rD5s5mZ5lZ5mZ5lZ5" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-1mQ7m0B5T5mZ5lZ5mZ5lZ5mZ5lZ5mZ5" crossorigin="anonymous"></script>
    </body>

</html>
