<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'extension', 'path'];
    
    public function imageable()
    {
        return $this->morphTo();
    }
    
    // Accessor for the is_associated attribute
    public function getIsAssociatedAttribute()
    {
        return $this->imageable !== null;
    }
}
 