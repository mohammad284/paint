<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaperType;
use App\Models\BuildingTypeTranslation;
use App\Models\CategoryTypeTranslation;
use App\Models\floarTypeTranslation;
use App\Models\MaterialTranslation;
use App\Models\NotificationTranslation;
use App\Models\PaperTypeTranslation;
use App\Models\PrivacyTranslation;
use App\Models\ProviderServiceTranslation;
use App\Models\ServiceTranslation;
use App\Models\SliderTranslation;
use App\Models\TypeWorkTranslation;
use App\Models\TermTranslation;
class PaperController extends Controller
{
    public function papers(){
        $papers = PaperType::all();
        return response()->json([
            'details' => $papers
        ]);
    }
    public function translate(){
        $datas = BuildingTypeTranslation::where('locale','gr')->update(['locale'=>'de']);
        $datas = CategoryTypeTranslation::where('locale','gr')->update(['locale'=>'de']);
        $datas = floarTypeTranslation::where('locale','gr')->update(['locale'=>'de']);
        $datas = MaterialTranslation::where('locale','gr')->update(['locale'=>'de']);
        $datas = NotificationTranslation::where('locale','gr')->update(['locale'=>'de']);
        $datas = PaperTypeTranslation::where('locale','gr')->update(['locale'=>'de']);
        $datas = PrivacyTranslation::where('locale','gr')->update(['locale'=>'de']);
        $datas = ProviderServiceTranslation::where('locale','gr')->update(['locale'=>'de']);
        $datas = ServiceTranslation::where('locale','gr')->update(['locale'=>'de']);
        $datas = SliderTranslation::where('locale','gr')->update(['locale'=>'de']);
        $datas = TermTranslation::where('locale','gr')->update(['locale'=>'de']);
        $datas = TypeWorkTranslation::where('locale','gr')->update(['locale'=>'de']);
        return 'ok';
    }
}
