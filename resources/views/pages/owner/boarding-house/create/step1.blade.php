<div class="carousel-item {{ $step === 1 ? "active" : "" }}">
    <div class="card border rounded" style="min-height: 400px;">
        <div class="card-body bg-white">
            <div class="row">

                {{-- Thumbnail --}}
                <div class="row mb-3">
                    <div class="col-md-8">
                        <div class="row">
                            {{-- Nama Kos --}}
                            <div class="col-12 mb-3">
                                <label class="form-label">Nama Kos</label>
                                <input type="text" class="form-control" wire:model="name"
                                    placeholder="Masukkan nama kos">
                                @error("name")
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Foto Sampul Kos</label>

                                {{-- Spinner saat loading thumbnail --}}
                                <div wire:loading wire:target="thumbnail" class="mb-2">
                                    <div class="spinner-border spinner-border-sm text-dark" role="status">
                                        <span class="visually-hidden">Uploading...</span>
                                    </div>
                                </div>

                                <input type="file" class="form-control" wire:model="thumbnail" accept="image/*">

                                @error("thumbnail")
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror

                            </div>

                            {{-- Kategori --}}
                            <div class="col-12 mb-3">
                                <label class="form-label">Kategori Kos</label>
                                <select class="form-select" wire:model="category">
                                    <option value="">Pilih Satu</option>
                                    <option value="male">Laki-laki</option>
                                    <option value="female">Perempuan</option>
                                    <option value="mixed">Campur</option>
                                </select>
                                @error("category")
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md align-content-md-center text-end">
                        {{-- Preview atau Placeholder --}}
                        <div class="my-3 mb-md-3">

                            @if ($thumbnail)
                                <a data-fancybox data-src="{{ $thumbnail->temporaryUrl() }}" data-caption="Foto Sampul">
                                    <img src="{{ $thumbnail->temporaryUrl() }}" class="img rounded-4 border"
                                        width="100%" height="180px" style="object-fit: cover;" alt="thumbnail" />
                                </a>
                            @else
                                <a data-fancybox
                                    data-src="{{ !empty($boardingHouse->thumbnail) ? Storage::url($boardingHouse->thumbnail) : "https://dummyimage.com/600x400/000/bfbfbf&text=silahkan+tambahkan+foto+sampul" }}"
                                    data-caption="Foto Sampul">
                                    <img src="{{ !empty($boardingHouse->thumbnail) ? Storage::url($boardingHouse->thumbnail) : "https://dummyimage.com/600x400/000/bfbfbf&text=silahkan+tambahkan+foto+sampul" }}"
                                        class="img rounded-4 border" style="object-fit: cover;" width="100%"
                                        height="180px" alt="thumbnail" />
                                </a>
                            @endif

                            {{-- @if ($thumbnail)
                                <img src="{{ $thumbnail->temporaryUrl() }}" class="img-fluid rounded shadow"
                                    style="max-height: 200px;" alt="Preview thumbnail">
                            @else
                                <img src="https://dummyimage.com/600x400/000/bfbfbf&text=silahkan+tambahkan+id+card"
                                    class="img-fluid rounded shadow" style="max-height: 200px;" alt="Placeholder">
                            @endif --}}
                        </div>
                    </div>
                </div>

                {{-- Link Google Maps --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Link Google Maps</label>
                    <input type="url" class="form-control" wire:model="location_map"
                        placeholder="https://goo.gl/maps/...">
                    @error("location_map")
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Minimum Sewa --}}
                <div class="col-md-6 mb-3">
                    <label for="minimum_rental_period" class="form-label">Minimum Lama Sewa (bulan)</label>
                    <select id="minimum_rental_period" wire:model="minimum_rental_period" class="form-select">
                        <option value="">-- Pilih Minimum Lama Sewa --</option>
                        <option value="1">1 bulan</option>
                        <option value="3">3 bulan</option>
                        <option value="6">6 bulan</option>
                        <option value="12">12 bulan</option>
                    </select>
                    @error("minimum_rental_period")
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Alamat --}}
                <div class="col-12 mb-3">
                    <label class="form-label">Alamat Lengkap</label>
                    <textarea class="form-control" wire:model="address" rows="3"
                        placeholder="Jl. Contoh No. 123, RT 01 RW 02, Kota Jambi"></textarea>
                    @error("address")
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>
