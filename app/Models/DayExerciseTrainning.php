<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Exercise;

class DayExerciseTrainning extends Model
{
    protected $table="trainning_exercise_day";
    protected $fillable=[
        'trainning_exercise_id',
        "day_id",
    ];
    public $timestamps = false;


    use HasFactory;

 public function exercises (){
    return $this->belongsToMany(Exercise::class,'train_exer_day_exercises','trainning_exercise_day_id','exercise_id');
 }
}
