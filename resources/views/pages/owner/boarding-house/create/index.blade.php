<?php

use App\Models\{BoardingHouse, Room};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Livewire\Volt\{state, on, usesFileUploads};
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

usesFileUploads();

state(["step" => 1])->url();

state([
    "user" => Auth::user(),
    "boardingHouse" => fn() => $this->user->boardingHouse ?? null,

    // Kos
    "name",
    "location_map",
    "address",
    "owner_id",
    "thumbnail",
    "category",
    "minimum_rental_period",

    // Kamar
    "boarding_house_id",
    "total_rooms",
    "question_room" => "form1",

    // Kamar banyak tipe
    "rooms" => [],

    // Kamar 1 tipe
    "price",
    "size",

    // Fasilitas & Aturan
    "facilities" => [],
    "regulations" => [],

    // Galeri
    "galleries" => [],
    "prevgalleries",
]);

// Button navigation
on([
    "prevBtn_updated" => fn() => ($this->step = max(1, $this->step)),
    "nextBtn_updated" => fn() => ($this->step = $this->step > 3 ? 1 : $this->step),
]);

$addRoom = fn() => ($this->rooms[] = ["type" => "", "price" => "", "size" => "", "total" => ""]);
$removeRoom = fn($index) => array_splice($this->rooms, $index, 1);

$prevBtn = fn() => $this->step-- && $this->dispatch("count_step");

$nextBtn = function () {
    match ($this->step) {
        1 => $this->validate([
            "name" => "required|string|max:255",
            "address" => "required|string|min:10",
            "thumbnail" => "required|image|mimes:jpeg,png,jpg|max:2048",
            "category" => "required|in:male,female,mixed",
            "minimum_rental_period" => "required|in:1,3,6,12",
            "location_map" => "required|url",
        ]),
        2 => $this->question_room === "form1"
            ? $this->validate([
                "price" => "required|numeric|min:0",
                "size" => "required|string",
                "total_rooms" => "required|integer|min:1",
                "galleries" => "required|array|min:1",
                "galleries.*" => "required|image|mimes:jpeg,png,jpg|max:2048",
            ])
            : $this->validate([
                "rooms" => "required|array|min:1",
                "rooms.*.type" => "required|string",
                "rooms.*.price" => "required|numeric|min:0",
                "rooms.*.size" => "required|string",
                "rooms.*.total" => "required|integer|min:1",
                "galleries" => "required|array|min:1",
                "galleries.*" => "required|image|mimes:jpeg,png,jpg|max:2048",
            ]),
        3 => $this->validate([
            "facilities" => "required|array|min:1",
            "facilities.*" => "required|string|min:2|max:100",
            "regulations" => "required|array|min:1",
            "regulations.*" => "required|string|min:2|max:100",
        ]),
    };

    $this->step++;
    $this->dispatch("nextBtn_updated");
};

$updatingGalleries = fn() => ($this->prevgalleries = $this->galleries);

$updatedGalleries = fn($value) => is_array($value) && ($this->galleries = array_merge($this->prevgalleries ?? [], $value));

$removeItem = function ($key) {
    if (isset($this->galleries[$key])) {
        $this->galleries[$key]->delete();
        unset($this->galleries[$key]);
        $this->galleries = array_values($this->galleries);
    }
};

$save = function () {
    DB::beginTransaction();

    try {
        // Validasi Boarding House
        $validated = $this->validate([
            "name" => "required|string|max:255",
            "location_map" => "required|url",
            "address" => "required|string",
            "thumbnail" => "required|image|mimes:jpeg,png,jpg|max:2048",
            "category" => "required|in:male,female,mixed",
            "minimum_rental_period" => "required|in:1,3,6,12",
            "facilities" => "required|array|min:1",
            "facilities.*" => "required|string|min:2|max:100",
            "regulations" => "required|array|min:1",
            "regulations.*" => "required|string|min:2|max:100",
            "galleries" => "required|array|min:1",
            "galleries.*" => "required|image",
        ]);

        $validated["owner_id"] = Auth::id();
        $validated["thumbnail"] = $this->thumbnail->store("thumbnails", "public");

        $boardingHouse = BoardingHouse::updateOrCreate(["owner_id" => Auth::id()], $validated);

        // Rooms
        if ($this->question_room === "form1") {
            $this->validate([
                "price" => "required|numeric|min:0",
                "size" => "required|string",
                "total_rooms" => "required|integer|min:1",
            ]);

            for ($i = 0; $i < $this->total_rooms; $i++) {
                Room::create([
                    "boarding_house_id" => $boardingHouse->id,
                    "room_number" => $i + 1,
                    "price" => $this->price,
                    "size" => $this->size,
                ]);
            }
        } else {
            $this->validate([
                "rooms" => "required|array|min:1",
                "rooms.*.type" => "required|string",
                "rooms.*.price" => "required|numeric|min:0",
                "rooms.*.size" => "required|string",
                "rooms.*.total" => "required|integer|min:1",
            ]);

            foreach ($this->rooms as $room) {
                for ($i = 0; $i < $room["total"]; $i++) {
                    Room::create([
                        "boarding_house_id" => $boardingHouse->id,
                        "room_number" => $room["type"] . "-" . ($i + 1),
                        "price" => $room["price"],
                        "size" => $room["size"],
                    ]);
                }
            }
        }

        // Fasilitas & Aturan
        $boardingHouse->facilities()->delete();
        foreach ($this->facilities as $facility) {
            $boardingHouse->facilities()->create(["name" => $facility]);
        }

        $boardingHouse->regulations()->delete();
        foreach ($this->regulations as $regulation) {
            $boardingHouse->regulations()->create(["rule" => $regulation]);
        }

        // Galeri
        foreach ($this->galleries as $gallery) {
            $path = $gallery->store("galleries", "public");
            $boardingHouse->galleries()->create(["image" => $path]);
        }

        // Notifikasi Admin
        $admin = \App\Models\User::where("email", "admin@testing.com")->first();
        if ($admin && optional($admin->identity)->whatsapp_number) {
            $message = implode("\n", ["📢 *Pemberitahuan Data Kos Baru*", "", "Telah ditambahkan data kos baru oleh *{$boardingHouse->owner->name}*.", formatField("Nama Kos", $boardingHouse->name), formatField("Kategori", ucfirst($boardingHouse->category)), formatField("Alamat", $boardingHouse->address), formatField("Minimal Sewa", "{$boardingHouse->minimum_rental_period} bulan"), "", "Silakan cek detailnya di sistem admin."]);

            (new \App\Services\FonnteService())->send($admin->identity->whatsapp_number, $message);
        }

        DB::commit();

        LivewireAlert::title("Proses Berhasil!")->position("center")->success()->toast()->show();
        $this->redirectRoute("boardingHouse.index");
    } catch (\Throwable $e) {
        DB::rollBack();

        if ($e instanceof \Illuminate\Validation\ValidationException) {
            if (array_key_exists("price", $e->errors()) || array_key_exists("size", $e->errors())) {
                $this->step = 2;
            }
            if (array_key_exists("galleries", $e->errors())) {
                $this->step = 3;
            }
        }

        throw $e;
    }
};

?>

@volt
    <div>
        @include("components.partials.tom-select")

        <h3 class="fw-bolder text-center text-decoration-underline">Step {{ $step }}</h3>

        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <strong>Terjadi kesalahan pada input:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form wire:submit="save" enctype="multipart/form-data">
            <div id="kostWizardCarousel" class="carousel slide" data-bs-interval="false">
                <div class="carousel-inner">
                    @include("pages.owner.boarding-house.create.step1")
                    @include("pages.owner.boarding-house.create.step2")
                    @include("pages.owner.boarding-house.create.step3")
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <button wire:click="prevBtn" class="btn btn-primary" type="button"
                        {{ $step < 2 ? "disabled" : "" }}>Sebelumnya</button>
                    <button wire:click="nextBtn" class="btn btn-primary" type="button"
                        {{ $step > 2 ? "disabled" : "" }}>Selanjutnya</button>
                </div>
            </div>
        </form>
    </div>
@endvolt
