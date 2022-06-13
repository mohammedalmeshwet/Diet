<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminAndUser\AuthController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\User\GoalController;
use App\Http\Controllers\Api\User\ActivityController;
use App\Http\Controllers\Api\AdminAndUser\FoodController;
use App\Http\Controllers\Api\Diet\DietController;
use App\Http\Controllers\Api\User\WeightController;
use App\Http\Controllers\Api\User\RankController;
use App\Http\Controllers\Api\User\AlternativesController;
use App\Http\Controllers\Api\User\HealthStatusController;
use App\Http\Controllers\Api\User\UserDietController;
use App\Http\Controllers\Api\User\HealthStatusUserController;
use App\Http\Controllers\Api\User\Unliked_foodsController;
use App\Http\Controllers\Api\Meal\MealController;
use App\Http\Controllers\Api\Exercise\ExerciseController;
use App\Http\Controllers\Api\Exercise\TrainingExercisesController;
use App\Http\Controllers\Api\Exercise\DayController;
use App\Http\Controllers\Api\Exercise\UserExerciseController;
use App\Http\Controllers\Api\Exercise\DayExerciseTrainningController;
use App\Http\Controllers\Api\User\UserDietAssesementController;


//Route User

    Route::group(['prefix' => 'user','namespace' => 'User'],function(){
        Route::post('login',[AuthController::class,'loginUser']);
        Route::post('register',[UserController::class,'Register']);


    });


    Route::group(['prefix' => 'admin','namespace' => 'Admin'],function(){
        Route::post('login',[AuthController::class,'loginAdmin']);
    });


    Route::group(['middleware' => 'auth.guard:user-api'],function()
    {
        //Route User
        Route::group(['prefix' => 'user'],function()
        {
            Route::post('logout',[AuthController::class,'logout']);
            Route::post('add-activity',[ActivityController::class,'addActivityUser']);
            Route::post('set-goal',[GoalController::class,'setGoalUser']);
            Route::post('add-unliked_food',[Unliked_foodsController::class,'addUnlikedFood']);
            Route::get('get-Diet-User',[DietController::class,'getDietNewUser']);
            Route::get('get-diet-active-user',[DietController::class,'getDietActiveUser']);
            Route::post('save-diet',[DietController::class,'saveDietUser']);
            Route::get('Diet-User/{calory}',[DietController::class,'show']);
            Route::get('System-Decision-To-Goal',[GoalController::class,'getSystemDecisionToGoal']);
            Route::get('get-All-Goals',[GoalController::class,'getAllUserGoal']);
            Route::put('add-personal-information',[UserController::class,'add_Personal_Information']);
            Route::delete('delete/{user_id}',[UserController::class,'destroy']);
            Route::get('get-all-unlikedFood-user',[Unliked_foodsController::class,'getAllUnlikedFood_User']);
            Route::post('add-weight',[WeightController::class,'addWeightUser']);
            Route::get('get-current-weight/{user_id}',[WeightController::class,'getCurrentWeightUser']);
            Route::post('get-alternatives-to-meal',[AlternativesController::class,'getAlternativesToMeal']);
            Route::get('get-all-health-status',[HealthStatusController::class,'getAllHealthStatus']);
            Route::post('add-health-status',[HealthStatusUserController::class,'addHealthStatus']);
            Route::get('get-all-foods',[FoodController::class,'getAllFoods']);
            Route::get('get-all-activities',[ActivityController::class,'getAllActivities']);
            Route::get('check-user-have-diet-active',[UserDietController::class,'checkUserHaveDietActive']);
            Route::post('diet-assesement',[UserDietAssesementController::class,'store']);

            Route::get('get-current-training-exercise',[TrainingExercisesController::class,'getUserTrainingExercises']);
            Route::get('get-day-specific-exercises/{id}',[DayExerciseTrainningController::class,'getDaySpecificExercises']);
            Route::post('save-training-exercise',[UserExerciseController::class,'saveUserExercise']);
            Route::get('get-all-training-exercise',[TrainingExercisesController::class,'getAllUserTrainingExercise']);


        });



        //Route Admin
        Route::group(['prefix' => 'admin'],function()
        {
            Route::post('logout',[AuthController::class,'logout']);
            Route::delete('delete-user/{id}',[UserController::class,'destroy']);
            Route::get('get-all-users',[UserController::class,'getAllUsers']);
            Route::put('change-level-user/{user_id}',[UserController::class,'changeStatusUser']);
            Route::post('food/store',[FoodController::class,'store']);
            Route::post('goal/store',[GoalController::class,'store']);
            Route::post('activity/store',[ActivityController::class,'store']);
            Route::put('activity/update/{avtivity_id}',[ActivityController::class,'update']);
            Route::get('get-all-ranks',[RankController::class,'getAllRanks']);
            Route::post('diet/store',[DietController::class,'store']);
            Route::get('diet/get-all-diets',[DietController::class,'getAllDiet']);
            Route::delete('delete-diet/{id}',[DietController::class,'destroy']);
            Route::post('health_status/store',[HealthStatusController::class,'store']);
            Route::put('health_status/update/{id}',[HealthStatusController::class,'update']);
            Route::get('get-all-health_status',[HealthStatusController::class,'getAllHealthStatus']);
            Route::get('get-all-foods',[FoodController::class,'getAllFoods']);
            Route::get('get-all-activities',[ActivityController::class,'getAllActivities']);
            Route::get('get-All-Goals',[GoalController::class,'getAllGoal']);

            
            Route::post('add-exercise',[ExerciseController::class,'addExercise']);
            Route::get('get-All-exercises',[ExerciseController::class,'getAllExercises']);
            Route::get('get-day-specific-exercises/{id}',[DayExerciseTrainningController::class,'getDaySpecificExercises']);


            Route::post('add-training-exercise',[TrainingExercisesController::class,'addTrainingExercise']);
            Route::get('get-all-training-exercises',[TrainingExercisesController::class,'getAllTrainingExercise']);

            Route::get('get-all-days',[DayController::class,'getAllDays']);

            Route::post('add-trainning-exercise-day',[DayExerciseTrainningController::class,'addTrainningExerciseDay']);
            Route::get('get-all-day-exercise-trainning',[DayExerciseTrainningController::class,'getAllDayExerciseTrainning']);
        });
    });



################################ Begin one To Many RelationShip #################################

    Route::get('diet/{calory}',[DietController::class,'show']);
    Route::get('meal/{meal_id}',[MealController::class,'show']);



################################ End one To Many RelationShip ###################################
