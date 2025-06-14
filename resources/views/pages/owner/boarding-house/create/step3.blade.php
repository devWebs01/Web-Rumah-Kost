<div class="carousel-item {{ $step === 3 ? "active" : "" }}">
    <div class="card border rounded" style="min-height: 400px;">
        <div class="card-body bg-white">
            <div class="row">
                {{-- Fasilitas --}}
                <div class="col-12">
                    <div class="mb-3">
                        <label for="facilities" class="form-label">Fasilitas</label>
                        <div wire:ignore>
                            <select id="input-tags" wire:model="facilities" multiple>
                                <option value="Balkon">Balkon</option>
                                <option value="CCTV">CCTV</option>
                                <option value="Dapur">Dapur</option>
                                <option value="Dispenser">Dispenser</option>
                                <option value="Duplikat Gerbang Kos">Duplikat Gerbang Kos</option>
                                <option value="Gazebo">Gazebo</option>
                                <option value="Jemuran">Jemuran</option>
                                <option value="Joglo">Joglo</option>
                                <option value="Jual Makanan">Jual Makanan</option>
                                <option value="K Mandi Luar">K Mandi Luar</option>
                                <option value="Kamar Mandi Luar - WC Duduk">Kamar Mandi Luar - WC Duduk</option>
                                <option value="Kamar Mandi Luar - WC Jongkok">Kamar Mandi Luar - WC Jongkok</option>
                                <option value="Kartu Akses">Kartu Akses</option>
                                <option value="Kompor">Kompor</option>
                                <option value="Kulkas">Kulkas</option>
                                <option value="Laundry">Laundry</option>
                                <option value="Loker">Loker</option>
                                <option value="Mesin Cuci">Mesin Cuci</option>
                                <option value="Mushola">Mushola</option>
                                <option value="Pengurus Kos">Pengurus Kos</option>
                                <option value="Penjaga Kos">Penjaga Kos</option>
                                <option value="R. Cuci">R. Cuci</option>
                                <option value="R. Jemur">R. Jemur</option>
                                <option value="R. Keluarga">R. Keluarga</option>
                                <option value="R. Makan">R. Makan</option>
                                <option value="R. Santai">R. Santai</option>
                                <option value="R. Tamu">R. Tamu</option>
                                <option value="Rice Cooker">Rice Cooker</option>
                                <option value="Rooftop">Rooftop</option>
                                <option value="TV">TV</option>
                                <option value="Taman">Taman</option>
                                <option value="WIFI">WIFI</option>
                            </select>
                        </div>
                        @error("facilities")
                            <small id="facilitiesId" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <br>
                        @error("facilities.*")
                            <small id="facilitiesId" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Aturan --}}
                    <div class="col-12 mt-3">
                        <label for="regulation" class="form-label">Aturan Kos</label>
                        <div wire:ignore>
                            <select wire:model='regulations' multiple name="regulation" id="input-tags">
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
                            <small id="regulationsId" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <br>
                        @error("regulations.*")
                            <small id="regulationsId" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

            </div>

            <div class="col-12 d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
                <div class="spinner-border d-none" wire:loading.class='d-none' wire:target='save' role="status">
                </div>
            </div>
        </div>
    </div>
</div>
