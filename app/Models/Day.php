<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $table="days";
    protected $fillable=[
        "day_name",
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    use HasFactory;
}
