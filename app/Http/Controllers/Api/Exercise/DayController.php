<?php

namespace App\Http\Controllers\Api\Exercise;

use App\Http\Controllers\Controller;
use App\Models\Day;
use App\Traits\GeneralTrait;

class DayController extends Controller
{
    use GeneralTrait;
    public function getAllDays(){
        $days =  (new Day()) -> all();
        return $this->returnData('days', $days);
    }
}

