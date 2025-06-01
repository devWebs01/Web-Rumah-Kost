<div class="carousel-item {{ $step === 2 ? "active" : "" }}">
    <div class="card" style="min-height: 400px;">
        <div class="card-body bg-white">
            <div class="row">

                {{-- Pertanyaan 1 --}}
                <div class="col-12 mb-3">
                    <label class="form-label">Apakah kos ini punya lebih dari 1 tipe kamar?</label>

                    <select class="form-select" wire:model.live="question_one">
                        <option value="form1">Tidak, hanya ada 1 tipe kamar</option>
                        <option value="form2">Ya, ada beberapa tipe kamar</option>
                    </select>
                    @error("question_one")
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                @if ($question_one === "form1")
                    {{-- Harga --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Harga per Bulan (Rp)</label>
                        <input type="number" class="form-control" wire:model="price"
                            placeholder="Cth: 500000">
                        @error("price")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Ukuran --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ukuran Kamar (m²)</label>
                        <input type="text" class="form-control" wire:model="size"
                            placeholder="Cth: 3x4">
                        @error("size")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Jumlah --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jumlah Kamar</label>
                        <input type="number" class="form-control" wire:model="total_rooms"
                            placeholder="Cth: 10">
                        @error("total_rooms")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                @elseif ($question_one === "form2")
                    {{-- Nomor Kamar --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tipe Kamar</label>
                        <input type="text" class="form-control" wire:model="type_rooms"
                            placeholder="Cth: A1 / 01">
                        @error("type_rooms")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Harga --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Harga per Bulan (Rp)</label>
                        <input type="number" class="form-control" wire:model="price_rooms"
                            placeholder="Cth: 500000">
                        @error("price")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Ukuran --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ukuran Kamar (m²)</label>
                        <input type="text" class="form-control" wire:model="size_rooms"
                            placeholder="Cth: 3x4">
                        @error("size")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Jumlah --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jumlah Kamar</label>
                        <input type="number" class="form-control" wire:model="total_rooms"
                            placeholder="Cth: 10">
                        @error("total_rooms")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
