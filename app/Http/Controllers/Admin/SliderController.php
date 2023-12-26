<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use App\Models\Slider;
class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function all_sliders(){
        $app_lan = app()->getLocale();
        if($app_lan == 'en'){ $lan = '1';};
        if($app_lan == 'de'){ $lan = '2';};
        $sliders = Slider::where('status','1')->get();
        return view('dashboard.slider.all-slider',compact('sliders'));
    }
    public function addSlider(Request $request){
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
        Slider::create($data);
        return redirect()->back()->withErrors('added successfully');
    }
    public function updateSlider(Request $request,$sli_id){
        $slider = Slider::find($sli_id);
        if($request->image == null){
            $data['image'] = $slider->image;
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
        $data = [
            'en' => [
                'text' => $request -> text_en,
            ],
            'de' => [
                'text' => $request -> text_gr,
            ],
            'image'=> $data['image']
        ];
        $slider->update($data);
        return redirect()->back()->withErrors('updated successfully');
    }
    public function deleteSlider($sli_id){
        $slider = Slider::where('id',$sli_id)->delete();
        return redirect()->back()->withErrors('deleted successfully');
    }
}
