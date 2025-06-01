<?php

use App\Models\{BoardingHouse, Room};
use function Livewire\Volt\{state, on, usesFileUploads};
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

usesFileUploads();

state([
    "step" => 1,
])->url();

state([
    "user" => Auth::user(),
    "boardingHouse" => fn() => $this->user->boardingHouse ?? null,

    // kost
    "name",
    "location_map",
    "address",
    "owner_id",
    "thumbnail",
    "category",

    // Kamar
    "boarding_house_id",
    "total_rooms",
    "question_room" => "form1",

    // Kamar banyak tipe
    "type_rooms" => [],
    "price_rooms" => [],
    "size_rooms" => [],

    // Kamar 1 tipe
    "room_number",
    "price",
    "size",

    // Fasilitas & aturan
    "facilities" => [],
    "regulations" => [],
]);

on([
    "prevBtn_updated" => function () {
        if ($this->step < 1) {
            $this->step = 1;
        }
    },
    "nextBtn_updated" => function () {
        if ($this->step > 3) {
            $this->step = 1;
        }
    },
]);

$prevBtn = function () {
    $this->step--;
    $this->dispatch("count_step");
};

$nextBtn = function () {
    $this->step++;
    $this->dispatch("nextBtn_updated");
};

$save = function () {
    // dd($this->all());

    // Validasi data boarding house
    $validatedBoardingHouse = $this->validate([
        "name" => "required|string|max:255",
        "location_map" => "nullable|url",
        "address" => "required|string",
        "thumbnail" => "required|image|mimes:jpeg,png,jpg",
        "category" => "required|in:male,female,mixed",
    ]);

    $validatedBoardingHouse["owner_id"] = Auth::user()->id;
    $validatedBoardingHouse["thumbnail"] = $this->thumbnail->store("thumbnails", "public");

    // Simpan BoardingHouse
    $boardingHouse = BoardingHouse::updateOrCreate($validatedBoardingHouse);

    // Simpan kamar berdasarkan tipe
    if ($this->question_room === "form1") {
        for ($index = 0; $index < $this->total_rooms; $index++) {
            Room::create([
                "boarding_house_id" => $boardingHouse->id,
                "room_number" => $index + 1, // Menggunakan 1-based index untuk nomor kamar
                "price" => $this->price,
                "size" => $this->size,
            ]);
        }
    } elseif ($this->question_room === "form2") {
        // Validasi untuk tipe kamar yang berbeda
        $this->validate([
            "type_rooms" => "required|array",
            "price_rooms" => "required|array",
            "size_rooms" => "required|array",
            "total_rooms" => "required|integer|min:1",
        ]);
        for ($index = 0; $index < count($this->type_rooms); $index++) {
            Room::create([
                "boarding_house_id" => $boardingHouse->id,
                "room_number" => $this->type_rooms[$index], // Menggunakan tipe kamar sebagai nomor
                "price" => $this->price_rooms[$index],
                "size" => $this->size_rooms[$index],
            ]);
        }
    }

    $validatedFacility = $this->validate([
        "facilities" => "required",
        "facilities.*" => "required|string|min:2",
    ]);

    $facilities = is_array($this->facilities) ? $this->facilities : explode(",", $this->facilities);

    foreach ($facilities as $facility) {
        $boardingHouse->facilities()->create([
            "name" => $facility,
        ]);
    }

    $validatedregulation = $this->validate([
        "regulations" => "required",
        "regulations.*" => "required|string|min:2",
    ]);

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

@volt
    <div>
        @include("components.partials.tom-select")

        <h3 class="fw-bolder text-center text-decoration-underline">Step {{ $step }}</h3>

        {{-- Wizard --}}
        <div id="kostWizardCarousel" class="carousel slide" data-bs-interval="false">
            <div class="carousel-inner">
                <form wire:submit='save'>
                    {{-- Step 1 --}}
                    @include("pages.owner.boarding-house.create.step1")

                    {{-- Step 2 --}}
                    @include("pages.owner.boarding-house.create.step2")

                    {{-- Step 3 --}}
                    @include("pages.owner.boarding-house.create.step3")

                </form>
            </div>

            {{-- Wizard Controls --}}
            <div class="d-flex justify-content-between mt-3">
                <button id="prevBtn" wire:click="prevBtn" class="btn btn-primary" type="button"
                    data-bs-target="#kostWizardCarousel" data-bs-slide="prev" {{ $step < 2 ? "disabled" : "" }}
                    wire:loading.attr="disabled">Sebelumnya</button>
                <button id="nextBtn" wire:click="nextBtn" class="btn btn-primary" type="button"
                    data-bs-target="#kostWizardCarousel" data-bs-slide="next" {{ $step > 2 ? "disabled" : "" }}
                    wire:loading.attr="disabled">Selanjutnya</button>
            </div>
        </div>
    </div>
@endvolt
