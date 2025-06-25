<x-auth-layout>
    <x-slot name="title">Verifikasi Email</x-slot>
    <x-slot name="text">Silakan verifikasi alamat email Anda untuk melanjutkan.</x-slot>

    @if (session("resent"))
        <div class="alert alert-light alert-dismissible fade show" role="alert">
            Link verifikasi baru telah dikirim ke email Anda.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    <p class="mb-3">
        Sebelum melanjutkan, silakan periksa email Anda untuk link verifikasi.
        Jika Anda belum menerima email tersebut, klik tombol di bawah ini:
    </p>

    <form method="POST" action="{{ route("verification.resend") }}">
        @csrf
        <div class="d-grid">
            <button type="submit" class="btn btn-outline-light">
                Kirim Ulang Email Verifikasi
            </button>
        </div>
    </form>
@endsection
</x-auth-layout>
