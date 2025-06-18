<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BoardingHouse extends Model
{
    use HasFactory, LogsActivity;
    protected static $logAttributes = ['name', 'category'];
    protected static $logName = 'boarding_house';
    protected $with = ['rooms', 'galleries', 'owner'];

    protected $fillable = [
        'name',
        'location_map',
        'address',
        'owner_id',
        'thumbnail',
        'category',
        'verification_status',
        'minimum_rental_period',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function facilities(): HasMany
    {
        return $this->hasMany(Facility::class);
    }

    public function regulations(): HasMany
    {
        return $this->hasMany(Regulation::class);
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->useLogName('boarding_house');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Kos {$this->name} telah {$eventName} oleh " . auth()->user()?->name;
    }
}
