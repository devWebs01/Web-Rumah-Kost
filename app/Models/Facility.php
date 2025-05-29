<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'boarding_house_id',
    ];

    public function boarding_house(): BelongsTo
    {
        return $this->belongsTo(BoardingHouse::class);
    }
}
