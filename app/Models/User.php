<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\hasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, LogsActivity, Notifiable;

    protected static $logOnlyDirty = true;

    protected static $logAttributes = ['name', 'email'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // log semua perubahan
            ->logOnlyDirty() // hanya jika ada perubahan
            ->useLogName('user'); // nama kategori log
    }

    protected $with = ['identity'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        //
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function boardingHouse(): hasOne
    {
        return $this->hasOne(BoardingHouse::class, 'owner_id', 'id');
    }

    public function identity(): hasOne
    {
        return $this->hasOne(Identity::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function activities()
    {
        return $this->hasMany(\Spatie\Activitylog\Models\Activity::class, 'causer_id');
    }
}
