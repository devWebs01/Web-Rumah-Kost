<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'boarding_house_id',
        'room_number',
        'status',
    ];

    public function boarding_house(): BelongsTo
    {
        return $this->belongsTo(BoardingHouse::class);
    }
}
