<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Activity;
use App\Models\Day;
use App\Models\Exercise;

class TrainingExercises  extends Model
{
    protected $table = 'training_exercises';
    protected $fillable = [
        'activity_id',
        'name',
        'days_count'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    use HasFactory;



    ##################################################### Begin RelationShip #####################################################

    public function activity(){
        return $this->belongsTo(Activity::class,'activity_id');
    }

    public function days(){
        return $this->belongsToMany(Day::class,'trainning_exercise_day','trainning_exercise_id','day_id')->withPivot('id');
    }

    public function exercisees(){
        return $this->belongsToMany(Exercise::class,'trainning_exercise_day','trainning_exercise_id','exercise_id');
    }
###################################################### End RelationShip #######################################################
}

