<div class="carousel-item {{ $step === 1 ? "active" : "" }}">
    <div class="card" style="min-height: 400px;">
        <div class="card-body bg-white">
            <div class="row">
                {{-- Nama Kost --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Kost</label>
                    <input type="text" class="form-control" wire:model="name" placeholder="Masukkan nama kost">
                    @error("name")
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Thumbnail --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Foto Sampul Kost</label>
                    <input type="file" class="form-control" wire:model="thumbnail"
                        placeholder="Link gambar thumbnail" accept="image/*">
                    @error("thumbnail")
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Kategori --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kategori Kost</label>
                    <select class="form-select" wire:model="category">
                        <option selected disabled>Pilih Satu</option>
                        <option value="male">Laki-laki</option>
                        <option value="female">Perempuan</option>
                        <option value="mixed">Campur</option>
                    </select>
                    @error("category")
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Maps --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Link Google Maps</label>
                    <input type="url" class="form-control" wire:model="location_map"
                        placeholder="https://goo.gl/maps/...">
                    @error("location_map")
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Alamat --}}
                <div class="col-12 mb-3">
                    <label class="form-label">Alamat Lengkap</label>
                    <textarea class="form-control" wire:model="address" rows="3"></textarea>
                    @error("address")
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>
