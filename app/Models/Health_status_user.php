<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Health_status_user extends Model
{
    protected $table="health_status_user";
    protected $fillable=[
        "user_id",
        "health_status_id"
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
