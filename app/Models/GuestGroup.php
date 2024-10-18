<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'invitation_id',
        'group_type',
        'mobile_number',
        'max_members',
        'confirmed_count',
        'confirmation_status'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }

    public function guests()
    {
        return $this->hasMany(Guest::class);
    }
}

