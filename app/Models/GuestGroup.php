<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestGroup extends Model
{
    use HasFactory;
    
    protected $fillable = ['event_id','invitation_id','group_type','mobile_number','max_members'];
}
