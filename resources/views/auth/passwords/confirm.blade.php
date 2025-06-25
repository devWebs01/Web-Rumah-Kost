<x-auth-layout>
    <x-slot name="title">Konfirmasi Kata Sandi</x-slot>
    <x-slot name="text">Silakan konfirmasi kata sandi Anda sebelum melanjutkan.</x-slot>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-3">
            <label for="password" class="form-label">Kata Sandi</label>
            <input id="password" type="password"
                class="form-control border px-2 @error('password') is-invalid @enderror"
                name="password" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback text-white" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="d-grid mb-2">
            <button type="submit" class="btn btn-outline-light">
                Konfirmasi Kata Sandi
            </button>
        </div>

        @if (Route::has('password.request'))
            <div class="text-center mt-2">
                <a class="text-white text-decoration-none" href="{{ route('password.request') }}">
                    Lupa Kata Sandi?
                </a>
            </div>
        @endif
    </form>
</x-auth-layout>
