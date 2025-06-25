<x-auth-layout>
    <x-slot name="title">Reset Kata Sandi</x-slot>
    <x-slot name="text">Masukkan email dan kata sandi baru Anda untuk mereset akun.</x-slot>

    <form method="POST" action="{{ route("password.update") }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="mb-3">
            <label for="email" class="form-label">Alamat Email</label>
            <input id="email" type="email" class="form-control border px-2 @error("email") is-invalid @enderror"
                name="email" value="{{ $email ?? old("email") }}" required autocomplete="email" autofocus>

            @error("email")
                <span class="invalid-feedback text-white" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Kata Sandi Baru</label>
            <input id="password" type="password"
                class="form-control border px-2 @error("password") is-invalid @enderror" name="password" required
                autocomplete="new-password">

            @error("password")
                <span class="invalid-feedback text-white" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password-confirm" class="form-label">Konfirmasi Kata Sandi</label>
            <input id="password-confirm" type="password" class="form-control border px-2" name="password_confirmation"
                required autocomplete="new-password">
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-outline-light">
                Reset Kata Sandi
            </button>
        </div>
    </form>
</x-auth-layout>
