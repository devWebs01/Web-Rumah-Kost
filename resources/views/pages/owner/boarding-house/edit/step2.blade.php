<div class="carousel-item {{ $step === 2 ? "active" : "" }}">
    <div class="card border rounded" style="min-height: 400px;">
        <div class="card-body bg-white">
            <div class="row">
                <div class="col-12 mb-3">
                    <label class="form-label">Apakah kos ini punya lebih dari 1 tipe kamar?</label>

                    <select class="form-select" wire:model.live="question_room">
                        <option value="form1">Tidak, hanya ada 1 tipe kamar</option>
                        <option value="form2">Ya, ada beberapa tipe kamar</option>
                    </select>
                    @error("question_room")
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Tab Pane: form1 --}}
                <div class="{{ $question_room === "form1" ? "" : "d-none" }}">
                    <div class="row">
                        {{-- Harga --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga per Bulan (Rp)</label>
                            <input type="number" class="form-control" wire:model="price" placeholder="Cth: 500000">
                            @error("price")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Ukuran --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ukuran Kamar (m²)</label>
                            <input type="text" class="form-control" wire:model="size" placeholder="Cth: 3x4">
                            @error("size")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Jumlah --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jumlah Kamar</label>
                            <input type="number" class="form-control" wire:model="total_rooms" placeholder="Cth: 10">
                            @error("total_rooms")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Tab Pane: form2 --}}
                <div class="{{ $question_room === "form2" ? "" : "d-none" }}">
                    <div class="row">
                        <div class="col-12">
                            <button type="button" wire:click="addRoom" class="btn btn-outline-primary mb-3">
                                Tambah Kamar
                            </button>
                        </div>

                        <form wire:submit.prevent="submitRooms">
                            @foreach ($rooms as $index => $room)
                                {{-- Tipe Kamar --}}
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Tipe Kamar {{ $index }}</label>
                                    <input type="text"
                                        class="form-control @error("rooms.{$index}.type") is-invalid @enderror"
                                        wire:model="rooms.{{ $index }}.type" placeholder="Cth: A1 / 01">
                                    @error("rooms.{$index}.type")
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Harga --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Harga per Bulan (Rp)</label>
                                    <input type="number"
                                        class="form-control @error("rooms.{$index}.price") is-invalid @enderror"
                                        wire:model="rooms.{{ $index }}.price" placeholder="Cth: 500000">
                                    @error("rooms.{$index}.price")
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Ukuran --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Ukuran Kamar (m²)</label>
                                    <input type="text"
                                        class="form-control @error("rooms.{$index}.size") is-invalid @enderror"
                                        wire:model="rooms.{{ $index }}.size" placeholder="Cth: 3x4">
                                    @error("rooms.{$index}.size")
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Jumlah --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jumlah Kamar</label>
                                    <input type="number"
                                        class="form-control @error("rooms.{$index}.total") is-invalid @enderror"
                                        wire:model="rooms.{{ $index }}.total" placeholder="Cth: 10">
                                    @error("rooms.{$index}.total")
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Tombol Hapus --}}
                                <div class="col-md-6 mb-3 text-end">
                                    <p class="form-label text-white">Opsi</p>
                                    <button type="button" wire:click="removeRoom({{ $index }})"
                                        class="btn btn-danger">
                                        Hapus
                                    </button>
                                </div>
                            @endforeach
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
