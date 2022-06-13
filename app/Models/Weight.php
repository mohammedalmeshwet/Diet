<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Weight  extends Model
{
    protected $table = 'weight';
    protected $fillable = [
        'user_id',
        'weight'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    use HasFactory;



    ##################################################### Begin RelationShip #####################################################

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
###################################################### End RelationShip #######################################################
}

