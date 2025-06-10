<?php

use App\Models\Transaction;
use function Livewire\Volt\{state};
use function Laravel\Folio\{name};

name("transactions.index");

state([
    "transactions" => fn() => Transaction::where("user_id", Auth::User()->id)->get(),
]);
?>

<x-guest-layout>

    @volt
        <div>
            @foreach ($transactions as $transaction)
                {{ $transaction }}
            @endforeach
        </div>
    @endvolt
</x-guest-layout>
