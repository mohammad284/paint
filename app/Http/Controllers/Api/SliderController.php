<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Validator;
use Image;
class SliderController extends Controller
{
    public function sliders(){
        $sliders = Slider::where('status','1')->paginate(10);
        return response()->json([
            'status' => 200,
            'details'=>$sliders
        ]);
    }
    public function addSlider(Request $request){
        $validator = Validator::make($request->all(), [
            'text_en'   => ['required'],
            'text_gr'   => ['required'],
            'image'  => ['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        if($request->file('image')){
            $image=$request->file('image');
            $input['image'] = $image->getClientOriginalName();
            $path = 'images/slider/';
            $destinationPath = 'images/slider';
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.time().$input['image']);
            $name = $path.time().$input['image'];
            
           $data['image'] =  $name;
        }
        $data=[
            'image'=> $data['image'],
            'status'=> '1',
            'en' => [
                'text' => $request -> text_en,
            ],
            'de' => [
                'text' => $request -> text_gr,
            ],
        ];
        $slider = Slider::create($data);
        return response()->json([
            'status' => 200,
            'details'=>$slider
        ]);
    }
}
