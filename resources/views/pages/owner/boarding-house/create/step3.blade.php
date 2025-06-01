<div class="carousel-item {{ $step === 3 ? "active" : "" }}">
    <div class="card" style="min-height: 400px;">
        <div class="card-body bg-white">
            <div class="row">
                {{-- Fasilitas --}}
                <div class="col-12">
                    <div class="mb-3">
                        <label for="facilities" class="form-label">Fasilitas</label>
                        <div wire:ignore>
                            <input type="text" wire:model="facilities" id="input-tags"
                                aria-describedby="facilitiesId" autocomplete="facilities" />
                        </div>
                        @error("facilities")
                            <small id="facilitiesId"
                                class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <br>
                        @error("facilities.*")
                            <small id="facilitiesId"
                                class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Aturan --}}
                    <div class="col-12 mt-3">
                        <label for="regulation" class="form-label">Aturan Kost</label>
                        <div wire:ignore>
                            <select wire:model='regulations' multiple name="regulation"
                                id="input-tags">
                                <option value="5-orang-per-kamar">5 orang/ kamar</option>
                                <option value="ada-jam-malam">Ada jam malam</option>
                                <option value="ada-jam-malam-untuk-tamu">Ada jam malam untuk tamu
                                </option>
                                <option value="akses-24-jam">Akses 24 Jam</option>
                                <option value="bawa-hasil-tes-antigen">Bawa hasil tes antigen saat
                                    check-in (sewa harian)</option>
                                <option value="boleh-bawa-anak">Boleh bawa anak</option>
                                <option value="boleh-bawa-hewan">Boleh bawa hewan</option>
                                <option value="boleh-pasutri">Boleh pasutri</option>
                                <option value="check-in-14-21">Check-in pukul 14:00-21:00 (sewa
                                    harian)
                                </option>
                                <option value="check-out-maks-12">Check-out maks. pukul 12:00 (sewa
                                    harian)</option>
                                <option value="denda-kerusakan-barang">Denda kerusakan barang kos
                                </option>
                                <option value="dilarang-bawa-hewan">Dilarang bawa hewan</option>
                                <option value="dilarang-menerima-tamu">Dilarang menerima tamu
                                </option>
                                <option value="dilarang-merokok-di-kamar">Dilarang merokok di kamar
                                </option>
                                <option value="harga-termasuk-listrik">Harga termasuk listrik (sewa
                                    harian)</option>
                                <option value="kamar-hanya-bagi-penyewa">Kamar hanya bagi penyewa
                                </option>
                                <option value="khusus-mahasiswa">Khusus Mahasiswa</option>
                                <option value="khusus-karyawan">Khusus karyawan</option>
                                <option value="kriteria-umum">Kriteria umum</option>
                                <option value="lawan-jenis-dilarang-ke-kamar">Lawan jenis dilarang
                                    ke
                                    kamar</option>
                                <option value="maks-1-orang-per-kamar">Maks. 1 orang/ kamar
                                </option>
                                <option value="maks-2-orang-per-kamar">Maks. 2 orang/ kamar
                                </option>
                                <option value="maks-3-orang-per-kamar">Maks. 3 orang/ kamar
                                </option>
                                <option value="maks-4-orang-per-kamar">Maks. 4 orang/ kamar
                                </option>
                                <option value="maks-2-orang-sewa-harian">Maksimal 2 orang (sewa
                                    harian)
                                </option>
                                <option value="swab-negatif-check-in">Menunjukan bukti (-) Swab
                                    saat
                                    check-in</option>
                                <option value="pasutri-bawa-surat-nikah">Pasutri wajib membawa
                                    surat
                                    nikah (sewa harian)</option>
                                <option value="biaya-alat-elektronik">Tambah biaya untuk alat
                                    elektronik</option>
                                <option value="tamu-bebas-berkunjung">Tamu bebas berkunjung
                                </option>
                                <option value="tamu-boleh-menginap">Tamu boleh menginap</option>
                                <option value="tamu-dilarang-menginap">Tamu dilarang menginap
                                </option>
                                <option value="tamu-menginap-dikenakan-biaya">Tamu menginap
                                    dikenakan
                                    biaya</option>
                                <option value="tanpa-deposit">Tanpa deposit (sewa harian)</option>
                                <option value="termasuk-listrik">Termasuk listrik</option>
                                <option value="tidak-bisa-dp">Tidak bisa DP (sewa harian)</option>
                                <option value="tidak-boleh-bawa-anak">Tidak boleh bawa anak
                                </option>
                                <option value="tidak-untuk-pasutri">Tidak untuk pasutri</option>
                                <option value="wajib-ikut-piket">Wajib ikut piket</option>
                                <option value="wajib-lampirkan-ktp-check-in">Wajib lampirkan KTP
                                    saat
                                    check-in (sewa harian)</option>
                                <option value="wajib-sertakan-ktp">Wajib sertakan KTP saat
                                    pengajuan
                                    sewa</option>
                                <option value="wajib-sertakan-buku-nikah">Wajib sertakan buku nikah
                                    saat pengajuan sewa</option>
                                <option value="wajib-sertakan-kk">Wajib sertakan kartu keluarga
                                    saat
                                    pengajuan sewa</option>
                            </select>
                        </div>
                        @error("regulations")
                            <small id="regulationsId"
                                class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <br>
                        @error("regulations.*")
                            <small id="regulationsId"
                                class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>

            </div>
        </div>
    </div>
</div>
