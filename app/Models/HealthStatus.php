<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthStatus extends Model
{
    protected $table="health_status";
    protected $fillable=[
        "health_status_name"
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    use HasFactory;

    // public function user(){
    //     return $this->belongsTo(User::class,'user_id');
    // }
}
