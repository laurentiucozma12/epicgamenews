<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_text',
        'second_text',
        'first_image',
        'second_image',
        'our_mission',
        'our_vision',
        'services',
    ];
}
