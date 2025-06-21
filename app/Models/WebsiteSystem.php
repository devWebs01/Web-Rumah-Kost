<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteSystem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'facebook',
        'twitter',
        'instagram',
        'phone_number',
        'whatsapp_number',
    ];
}
