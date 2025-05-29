<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BoardingHouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location_map',
        'address',
        'owner_id',
        'thumbnail',
        'category_id',
        'room_size',
        'price',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function facilities(): HasMany
    {
        return $this->hasMany(Facility::class);
    }

    public function regulations()
    {
        return $this->hasMany(Regulation::class);
    }
}
