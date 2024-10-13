<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title','event_type','date','location','max_guests','details'];

    public function guestGroups()
    {
        return $this->hasMany(GuestGroup::class);
    }

    public function getTotalGuestsAttribute()
    {
        return $this->guestGroups->sum('max_members');
    }
}
