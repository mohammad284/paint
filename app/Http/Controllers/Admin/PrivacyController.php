<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Privacy;
use App\Models\Term;
class PrivacyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function updatePrivacy(Request $request){
        $privacy = Privacy::find(1);
        $data = [
            'en' => [
                'privacy_policy' => $request -> privacy_en,
            ],
            'de' => [
                'privacy_policy' => $request -> privacy_gr,
            ],
        ];
        $privacy->update($data);
        return redirect()->back()->withErrors('The privacy policy has been successfully modified');
    }
    public function privacy(){
        $privacy = Privacy::find(1);
        return view('dashboard.privacy.privacy',compact('privacy'));
    }
    public function updateTerms(Request $request){
        $terms = Term::find(1);
        $data = [
            'en' => [
                'terms' => $request -> terms_en,
            ],
            'de' => [
                'terms' => $request -> terms_gr,
            ],
        ];
        $terms->update($data);
        return redirect()->back()->withErrors('Terms and conditions have been successfully modified');
    }
    public function terms(){
        $terms = Term::find(1);
        return view('dashboard.privacy.terms',compact('terms'));
    }
}