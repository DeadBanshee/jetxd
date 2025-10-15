<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;
    
    protected $table = 'membership_plans';

    protected $fillable = [
        'title',
        'value',
        'stripe_id',
        'description',
    ];

}
