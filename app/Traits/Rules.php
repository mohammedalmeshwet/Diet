<?php

namespace App\Traits;



Trait Rules
{
    public function perfectWeight($gender, $height){
        return $gender === "male"   ? ($height - 100 ) - ($height - 150 )/4
                                    : ($height - 100 ) - ($height - 150 )/2;
    }
}
