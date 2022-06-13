<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Exercise;

class TrainExerDayExercises extends Model
{
    protected $table="train_exer_day_exercises";
    protected $fillable=[
        'trainning_exercise_day_id',
        "exercise_id",
    ];
    public $timestamps = false;


    use HasFactory;
}
