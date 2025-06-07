<?php

use App\Models\BoardingHouse;
use function Livewire\Volt\{state};
use function Laravel\Folio\{name};

name("catalog.show");

state(["boardingHouse"]);
?>

<x-guest-layout>

    @volt
        <div></div>
    @endvolt

</x-guest-layout>
