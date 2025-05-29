<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Regulation extends Model
{
    use HasFactory;

    protected $fillable = [
        'rule',
    ];

    public function boarding_house(): BelongsTo
    {
        return $this->belongsTo(BoardingHouse::class);
    }
}
