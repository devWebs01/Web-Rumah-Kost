<x-auth-layout>
    <x-slot name="title">Daftar Akun</x-slot>
    <x-slot name="text">Silakan buat akun baru untuk mulai menggunakan layanan pemesanan kos.</x-slot>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input id="name" type="text" class="form-control border px-2 @error('name') is-invalid @enderror"
                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback text-white" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Alamat Email</label>
            <input id="email" type="email" class="form-control border px-2 @error('email') is-invalid @enderror"
                name="email" value="{{ old('email') }}" required>

            @error('email')
                <span class="invalid-feedback text-white" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Jenis Pengguna</label>
            <select class="form-select @error('role') is-invalid @enderror" name="role" id="role" required>
                <option disabled selected>Pilih salah satu</option>
                <option value="guest" {{ old('role') == 'guest' ? 'selected' : '' }}>Penyewa Kos</option>
                <option value="owner" {{ old('role') == 'owner' ? 'selected' : '' }}>Pemilik Kos</option>
            </select>

            @error('role')
                <span class="invalid-feedback text-white" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Kata Sandi</label>
            <input id="password" type="password"
                class="form-control border px-2 @error('password') is-invalid @enderror" name="password" required>

            @error('password')
                <span class="invalid-feedback text-white" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password-confirm" class="form-label">Konfirmasi Kata Sandi</label>
            <input id="password-confirm" type="password" class="form-control border px-2"
                name="password_confirmation" required autocomplete="new-password">
        </div>

        <div class="mb-0 d-grid">
            <button type="submit" class="btn btn-outline-light">
                Daftar
            </button>

            <div class="mt-2 text-center">
                Sudah punya akun?
                <a class="fw-bold text-white" href="{{ route('login') }}">
                    Masuk sekarang!
                </a>
            </div>
        </div>
    </form>
</x-auth-layout>
