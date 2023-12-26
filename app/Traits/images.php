<?php

namespace App\Traits;
use Image;

Trait images
{
    function saveImage($photo , $path){
        $image=$photo;
        $input['image'] = $image->getClientOriginalName();
        $path = $path;
        $destinationPath = $path;
        $img = Image::make($image->getRealPath());
        $img->resize(500, 500, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.time().$input['image']);
        $name = $path.time().$input['image'];
        
        $photo =  $name;

        return $photo;
    }


}
