<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden = ['all_day'];


    protected $appends = ['allDay'];


    public function getAllDayAttribute(): bool
    {
        return (bool)$this->attributes['all_day'];
    }
}
