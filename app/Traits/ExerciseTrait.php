<?php

namespace App\Traits;



Trait ExerciseTrait
{
    function saveMedia($media, $folder){
        $file_extension = $media -> getClientOriginalExtension();
        $file_name = time().'.'.$file_extension;
        $path = $folder;
        $media->move($path,$file_name);
        return $file_name;
    }
}
