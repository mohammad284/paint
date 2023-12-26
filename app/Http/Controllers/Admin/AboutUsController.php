<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\AboutUs;
use Image;
class AboutUsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware(['auth', 'verified']);
    }
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'verified']);
    // }
    public function aboutUs(){
        $about_us = AboutUs::find(1);
        return view('dashboard.about-us.about-us',compact('about_us'));
    }
    public function updateAboutUs(Request $request){
        $about = AboutUs::find(1);
        $data = [ 
            'email_support' => $request->email_support ,
            'mobile'        => $request->mobile ,
            'phone'         => $request->phone ,
            'faceBook'      => $request->faceBook ,
            'whatsapp'      => $request->whatsapp ,
            'twitter'       => $request->twitter ,
            'Instagram'     => $request->Instagram ,
            'telegram'      => $request->telegram ,
            'en' => [
                'bio' => $request -> bio_en,
            ],
            'de' => [
                'bio' => $request -> bio_gr,
            ],
        ];
        $about->update($data);
        return redirect()->back()->withErrors('updated successfully');
    }
}
