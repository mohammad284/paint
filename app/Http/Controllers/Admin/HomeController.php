<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon;
use Validator;
use App\Models\Slider;
use App\Models\Material;
use App\Models\Notification;
use App\Models\Package;
use App\Models\Tender;
use App\Models\Review;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders       = Slider::count();
        $users         = User::where('type','user')->count();
        $providers     = User::where('type','provider')->count();
        $materials     = Material::count();
        $allPackage    = Package::count();
        $insideTender  = Tender::where('inside','1')->count();
        $outsideTender = Tender::where('inside','0')->count();
        $reviews       = Review::count();
        $count_not = Notification::where('admin_read','0')->count();
        return view('dashboard.index',compact('count_not','sliders','users','providers','materials','allPackage','insideTender','outsideTender','reviews'));
    }
}