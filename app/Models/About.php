<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'about_first_text',
        'about_second_text',
        'about_our_mission',
        'about_our_vision',
        'about_services',
    ];
}
