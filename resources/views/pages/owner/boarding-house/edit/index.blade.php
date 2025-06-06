<?php

use App\Models\{BoardingHouse, Room};
use function Livewire\Volt\{state, on, usesFileUploads};
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use function Laravel\Folio\{name};

name("boardingHouse.edit");

usesFileUploads();

state([
    "step" => 1,
])->url();

state([
    "user" => Auth::user(),
    "boardingHouse" => fn() => $this->user->boardingHouse ?? null,

    // kost
    "name" => fn() => $this->boardingHouse->name,
    "location_map" => fn() => $this->boardingHouse->location_map,
    "address" => fn() => $this->boardingHouse->address,
    "owner_id" => fn() => $this->boardingHouse->owner_id,
    "thumbnail",
    "category" => fn() => $this->boardingHouse->category,

    // Kamar
    "boarding_house_id" => fn() => $this->boardingHouse->id,

    // Fasilitas & aturan
    "facilities" => fn() => $this->boardingHouse?->facilities->pluck("name")->toArray(),
    "regulations" => fn() => $this->boardingHouse?->regulations->pluck("rule")->toArray(),
]);

$save = function () {
    // Validasi data boarding house
    $validatedBoardingHouse = $this->validate([
        "name" => "required|string|max:255",
        "location_map" => "nullable|url",
        "address" => "required|string",
        "thumbnail" => "nullable|image|mimes:jpeg,png,jpg",
        "category" => "required|in:male,female,mixed",
    ]);

    $validatedBoardingHouse["owner_id"] = Auth::id();

    if ($this->thumbnail) {
        $validatedBoardingHouse["thumbnail"] = $this->thumbnail->store("thumbnails", "public");
    } else {
        $validatedBoardingHouse["thumbnail"] = $this->boardingHouse->thumbnail;
    }

    // Jika boardingHouse sudah ada, update
    if ($this->boardingHouse) {
        $this->boardingHouse->update($validatedBoardingHouse);
        $boardingHouse = $this->boardingHouse;
    } else {
        $boardingHouse = BoardingHouse::create($validatedBoardingHouse);
    }

    // Hapus dan simpan ulang fasilitas
    $boardingHouse->facilities()->delete();
    $facilities = is_array($this->facilities) ? $this->facilities : explode(",", $this->facilities);

    foreach ($facilities as $facility) {
        $boardingHouse->facilities()->create([
            "name" => $facility,
        ]);
    }

    // Hapus dan simpan ulang aturan
    $boardingHouse->regulations()->delete();
    foreach ($this->regulations as $regulation) {
        $boardingHouse->regulations()->create([
            "rule" => $regulation,
        ]);
    }

    // Flash alert sukses
    LivewireAlert::title("Proses Berhasil!")->position("center")->success()->toast()->show();

    $this->redirectRoute("boardingHouse.index");
};

?>

<x-panel-layout>
    @volt
        <div>
            @include("components.partials.tom-select")

            <form wire:submit='save'>
                <div class="card border rounded">
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

                            {{-- Fasilitas --}}
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="facilities" class="form-label">Fasilitas</label>
                                    <div wire:ignore>
                                        <input type="text" wire:model="facilities" id="input-tags"
                                            aria-describedby="facilitiesId" autocomplete="facilities"
                                            value="{{ implode(",", is_array($facilities) ? $facilities : explode(",", $facilities)) }}" />
                                    </div>

                                    @error("facilities")
                                        <small id="facilitiesId" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                    <br>
                                    @error("facilities.*")
                                        <small id="facilitiesId" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Aturan --}}
                            <div class="col-12 mt-3">
                                <label for="regulation" class="form-label">Aturan Kost</label>
                                <div wire:ignore>
                                    <select wire:model='regulations' multiple name="regulation" id="input-tags">
                                        <option value="5-orang-per-kamar" @selected(in_array("5-orang-per-kamar", $regulations))>5 orang/ kamar
                                        </option>
                                        <option value="ada-jam-malam" @selected(in_array("ada-jam-malam", $regulations))>Ada jam malam</option>
                                        <option value="ada-jam-malam-untuk-tamu" @selected(in_array("ada-jam-malam-untuk-tamu", $regulations))>Ada jam malam
                                            untuk tamu</option>
                                        <option value="akses-24-jam" @selected(in_array("akses-24-jam", $regulations))>Akses 24 Jam</option>
                                        <option value="bawa-hasil-tes-antigen" @selected(in_array("bawa-hasil-tes-antigen", $regulations))>Bawa hasil tes
                                            antigen saat check-in (sewa harian)</option>
                                        <option value="boleh-bawa-anak" @selected(in_array("boleh-bawa-anak", $regulations))>Boleh bawa anak
                                        </option>
                                        <option value="boleh-bawa-hewan" @selected(in_array("boleh-bawa-hewan", $regulations))>Boleh bawa hewan
                                        </option>
                                        <option value="boleh-pasutri" @selected(in_array("boleh-pasutri", $regulations))>Boleh pasutri</option>
                                        <option value="check-in-14-21" @selected(in_array("check-in-14-21", $regulations))>Check-in pukul
                                            14:00-21:00 (sewa harian)</option>
                                        <option value="check-out-maks-12" @selected(in_array("check-out-maks-12", $regulations))>Check-out maks.
                                            pukul 12:00 (sewa harian)</option>
                                        <option value="denda-kerusakan-barang" @selected(in_array("denda-kerusakan-barang", $regulations))>Denda kerusakan
                                            barang kos</option>
                                        <option value="dilarang-bawa-hewan" @selected(in_array("dilarang-bawa-hewan", $regulations))>Dilarang bawa
                                            hewan</option>
                                        <option value="dilarang-menerima-tamu" @selected(in_array("dilarang-menerima-tamu", $regulations))>Dilarang
                                            menerima tamu</option>
                                        <option value="dilarang-merokok-di-kamar" @selected(in_array("dilarang-merokok-di-kamar", $regulations))>Dilarang
                                            merokok di kamar</option>
                                        <option value="harga-termasuk-listrik" @selected(in_array("harga-termasuk-listrik", $regulations))>Harga termasuk
                                            listrik (sewa harian)</option>
                                        <option value="kamar-hanya-bagi-penyewa" @selected(in_array("kamar-hanya-bagi-penyewa", $regulations))>Kamar hanya
                                            bagi penyewa</option>
                                        <option value="khusus-mahasiswa" @selected(in_array("khusus-mahasiswa", $regulations))>Khusus Mahasiswa
                                        </option>
                                        <option value="khusus-karyawan" @selected(in_array("khusus-karyawan", $regulations))>Khusus karyawan
                                        </option>
                                        <option value="kriteria-umum" @selected(in_array("kriteria-umum", $regulations))>Kriteria umum</option>
                                        <option value="lawan-jenis-dilarang-ke-kamar" @selected(in_array("lawan-jenis-dilarang-ke-kamar", $regulations))>Lawan
                                            jenis dilarang ke kamar</option>
                                        <option value="maks-1-orang-per-kamar" @selected(in_array("maks-1-orang-per-kamar", $regulations))>Maks. 1 orang/
                                            kamar</option>
                                        <option value="maks-2-orang-per-kamar" @selected(in_array("maks-2-orang-per-kamar", $regulations))>Maks. 2 orang/
                                            kamar</option>
                                        <option value="maks-3-orang-per-kamar" @selected(in_array("maks-3-orang-per-kamar", $regulations))>Maks. 3 orang/
                                            kamar</option>
                                        <option value="maks-4-orang-per-kamar" @selected(in_array("maks-4-orang-per-kamar", $regulations))>Maks. 4 orang/
                                            kamar</option>
                                        <option value="maks-2-orang-sewa-harian" @selected(in_array("maks-2-orang-sewa-harian", $regulations))>Maksimal 2
                                            orang (sewa harian)</option>
                                        <option value="swab-negatif-check-in" @selected(in_array("swab-negatif-check-in", $regulations))>Menunjukan bukti
                                            (-) Swab saat check-in</option>
                                        <option value="pasutri-bawa-surat-nikah" @selected(in_array("pasutri-bawa-surat-nikah", $regulations))>Pasutri wajib
                                            membawa surat nikah (sewa harian)</option>
                                        <option value="biaya-alat-elektronik" @selected(in_array("biaya-alat-elektronik", $regulations))>Tambah biaya
                                            untuk alat elektronik</option>
                                        <option value="tamu-bebas-berkunjung" @selected(in_array("tamu-bebas-berkunjung", $regulations))>Tamu bebas
                                            berkunjung</option>
                                        <option value="tamu-boleh-menginap" @selected(in_array("tamu-boleh-menginap", $regulations))>Tamu boleh
                                            menginap</option>
                                        <option value="tamu-dilarang-menginap" @selected(in_array("tamu-dilarang-menginap", $regulations))>Tamu dilarang
                                            menginap</option>
                                        <option value="tamu-menginap-dikenakan-biaya" @selected(in_array("tamu-menginap-dikenakan-biaya", $regulations))>Tamu
                                            menginap dikenakan biaya</option>
                                        <option value="tanpa-deposit" @selected(in_array("tanpa-deposit", $regulations))>Tanpa deposit (sewa
                                            harian)</option>
                                        <option value="termasuk-listrik" @selected(in_array("termasuk-listrik", $regulations))>Termasuk listrik
                                        </option>
                                        <option value="tidak-bisa-dp" @selected(in_array("tidak-bisa-dp", $regulations))>Tidak bisa DP (sewa
                                            harian)</option>
                                        <option value="tidak-boleh-bawa-anak" @selected(in_array("tidak-boleh-bawa-anak", $regulations))>Tidak boleh bawa
                                            anak</option>
                                        <option value="tidak-untuk-pasutri" @selected(in_array("tidak-untuk-pasutri", $regulations))>Tidak untuk
                                            pasutri</option>
                                        <option value="wajib-ikut-piket" @selected(in_array("wajib-ikut-piket", $regulations))>Wajib ikut piket
                                        </option>
                                        <option value="wajib-lampirkan-ktp-check-in" @selected(in_array("wajib-lampirkan-ktp-check-in", $regulations))>Wajib
                                            lampirkan KTP saat check-in (sewa harian)</option>
                                        <option value="wajib-sertakan-ktp" @selected(in_array("wajib-sertakan-ktp", $regulations))>Wajib sertakan KTP
                                            saat pengajuan sewa</option>
                                        <option value="wajib-sertakan-buku-nikah" @selected(in_array("wajib-sertakan-buku-nikah", $regulations))>Wajib
                                            sertakan buku nikah saat pengajuan sewa</option>
                                        <option value="wajib-sertakan-kk" @selected(in_array("wajib-sertakan-kk", $regulations))>Wajib sertakan
                                            kartu keluarga saat pengajuan sewa</option>
                                    </select>

                                </div>
                                @error("regulations")
                                    <small id="regulationsId" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                                <br>
                                @error("regulations.*")
                                    <small id="regulationsId" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12 d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                                <div class="spinner-border d-none" wire:loading.class='d-none' wire:target='save'
                                    role="status">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        </form>

        </div>
    @endvolt

</x-panel-layout>
