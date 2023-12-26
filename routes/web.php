<?php
// admin controller
  use Illuminate\Support\Facades\Route;
  use Illuminate\Http\Request;
  //paint controller 
    use App\Http\Controllers\Admin\HomeController;
    use App\Http\Controllers\Admin\TenderController;
    use App\Http\Controllers\Admin\Auth\LoginController;
    use App\Http\Controllers\Admin\PackageController;
    use App\Http\Controllers\Admin\TypeWorkController;
    use App\Http\Controllers\Admin\UserController;
    use App\Http\Controllers\Admin\AdressController;
    use App\Http\Controllers\Admin\SliderController;
    use App\Http\Controllers\Admin\MaterialController;
    use App\Http\Controllers\Admin\CategoryController;
    use App\Http\Controllers\Admin\ServiceController;
    use App\Http\Controllers\Admin\BuildingTypeController;
    use App\Http\Controllers\Admin\FloarController;
    use App\Http\Controllers\Admin\BranshWorkController;
    use App\Http\Controllers\Admin\ReviewController;
    use App\Http\Controllers\Admin\BlackListController;
    use App\Http\Controllers\Admin\PrivacyController;
    use App\Http\Controllers\Admin\ColorController;
    use App\Http\Controllers\Admin\ColorShadeController;
    use App\Http\Controllers\Admin\EmailController;
    use App\Http\Controllers\Admin\AboutUsController;
    use App\Http\Controllers\Admin\NotificationController;
    use App\Http\Controllers\Admin\AdminController;
    use App\Http\Controllers\Admin\PaymentController;
    use App\Http\Controllers\Admin\ReportController;
    use App\Http\Controllers\Admin\PaperController;
    use App\Http\Controllers\Admin\CouponController ;
    use App\Http\Controllers\Admin\SupportController;
    use App\Http\Controllers\Admin\FinancialController;
    use App\Http\Controllers\Admin\PlasterController;
    use App\Http\Controllers\Admin\FeedController;
    use App\Http\Controllers\Admin\UpdateQuestionController;
    use App\Http\Controllers\FCMController;
    Use App\Events\ChatEvent;
  //paint controller 


use App\Http\Controllers\Auth\LoginFrontController;

//end front controller 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::view('/welcome', 'welcome');
Route::get ( '/payment', function () {
  return view ( 'payment' );
} );
Route::post ( '/call', [UserController::class,'call'] );

Route::get('/', function () {
  return view('welcome');
  // return redirect('https://maler-germany-ali11ib.vercel.app/');
});
Auth::routes();

Route::namespace("Admin")->prefix('admin')->group(function(){
    Route::get('/',[HomeController::class,'index'])->name('admin.home');

    Route::namespace('Auth')->group(function(){
      Route::get('/login',[LoginController::class,'showLoginForm'])->name('admin.login');
      Route::post('/login',[LoginController::class,'login']);
      Route::post('/logout',[LoginController::class,'logout'])->name('admin.logout');
    });
    // paint
      Route::get('/feeds',[FeedController::class,'feeds']);
      //Financial reports  
        Route::get('/financialReport',[FinancialController::class,'financialReport']);
        Route::post('/paymentFilter',[FinancialController::class,'paymentFilter']);
        Route::post('/paymentDetails',[FinancialController::class,'paymentDetails']);
      //Financial reports 
      //admins
        Route::get('/myAdmins',[AdminController::class,'admins']);
        Route::get('/deleteAdmin/{admin_id}',[AdminController::class,'deleteAdmin']);
        Route::post('/addAdmin',[AdminController::class,'addAdmin']);
        Route::post('/updateAdmin/{admin_id}',[AdminController::class,'updateAdmin']);
      //admins
      // start  index
        Route::get('/index',[IndexController::class,'carsReport']);
      //end index
      // start user
        Route::get('/allUser',[UserController::class,'allUser']);
        Route::get('/edituser/{user_id}',[UserController::class,'edituser']);
        Route::post('/updateUser/{user_id}',[UserController::class,'updateUser']);
        Route::get('/addUser',[UserController::class,'addUser']);
        Route::post('/storeUser',[UserController::class,'storeUser']);
        Route::get('/editUser/{user_id}',[UserController::class,'editUser']);
        
      //end user 
      // start provider 
        Route::get('/allprovider',[UserController::class,'allprovider']);
        Route::get('/spicialProvider/{provider_id}',[UserController::class,'spicialProvider']);
        Route::get('/addProvider',[UserController::class,'addProvider']);
        Route::post('/storeProvider',[UserController::class,'storeProvider']);
        Route::get('/requestProvider',[UserController::class,'requestProvider']);
        Route::get('/updateBuisnessProvider',[UserController::class,'updateBuisnessProvider']);
        Route::get('/deleteProvider/{user_id}',[UserController::class,'deleteProvider']);
        Route::post('/acceptProvider/{user_id}',[UserController::class,'acceptProvider']);
        Route::post('/acceptUpdateBuisness/{user_id}',[UserController::class,'acceptUpdateBuisness']);
        Route::get('/editProvider/{provider_id}',[UserController::class,'editProvider']);
        Route::post('/updateProvider/{provider_id}',[UserController::class,'updateProvider']);
        Route::get('/blockProvider/{provider_id}',[UserController::class,'blockProvider']);
        Route::get('/activeProvider/{provider_id}',[UserController::class,'activeProvider']);
        Route::get('/blockedProviders',[UserController::class,'blockedProviders']);
        Route::get('/detailsProvider/{provider_id}',[UserController::class,'detailsProvider']);
        Route::get('/Services',[UserController::class,'Services']);
        Route::post('/addService',[UserController::class,'addService']);
        Route::post('/updateService/{serv_id}',[UserController::class,'updateService']);
        Route::get('/deleteService/{serv_id}',[UserController::class,'deleteService']);
      //end provider 

      Route::get('/emails',[EmailController::class,'emails']);
      Route::post('/sendContact',[EmailController::class,'sendContact']);
    
      // start Package
        Route::get('/allPackage',[PackageController::class,'allPackage']);
        Route::get('/showAddPackage',[PackageController::class,'showAddPackage']);
        Route::post('/addPackage',[PackageController::class,'addPackage']);
        Route::get('/editPackage/{pac_id}',[PackageController::class,'editPackage']);
        Route::post('/updatePackage/{pac_id}',[PackageController::class,'updatePackage']);
        Route::get('/deletePackage/{pac_id}',[PackageController::class,'deletePackage']);
      //end Package 
        Route::get('/report/{pro_id}',[ReportController::class,'report']);
      // about us
        Route::get('/aboutUs',[AboutUsController::class,'aboutUs']);
        Route::post('/updateAboutUs',[AboutUsController::class,'updateAboutUs']);
      // about us 
      // start Tender  
        Route::get('/otherTender',[TenderController::class,'otherTender']);
        Route::get('/otherTenderDetails/{id}',[TenderController::class,'otherTenderDetails']);
        Route::get('/buildingTender',[TenderController::class,'buildingTender']);
        Route::get('/buildingsFloor/{id}',[TenderController::class,'buildingsFloors']);
        Route::get('/insideTender',[TenderController::class,'insideTender']);
        Route::get('/outsideTender',[TenderController::class,'outsideTender']);
        Route::get('/glossyTender',[TenderController::class,'glossyTender']);
        Route::get('/flourTender',[TenderController::class,'flourTender']);
        Route::get('/plasterTender',[TenderController::class,'plasterTender']);
        Route::get('/tenderRooms/{tender_id}',[TenderController::class,'tenderRooms']);
        Route::get('/outsideDetails/{tender_id}',[TenderController::class,'outsideDetails']);
        Route::get('/glossyDetails/{tender_id}',[TenderController::class,'glossyDetails']);
        Route::get('/plasterDetails/{tender_id}',[TenderController::class,'plasterDetails']);
        Route::get('/flourDetails/{tender_id}',[TenderController::class,'flourDetails']);
        Route::get('/dealTenders',[TenderController::class,'dealTenders']);
        Route::get('/roomDetails/{room_id}',[TenderController::class,'roomDetails']);
        Route::get('/tenderInteristing',[TenderController::class,'tenderInteristing']);
        Route::get('/tenderConnected',[TenderController::class,'tenderConnected']);
        Route::get('/dealDetails/{tender_id}',[TenderController::class,'dealDetails']);
        Route::get('/deleteTender/{tender_id}',[TenderController::class,'deleteTender']);
        Route::get('/tenderPrice',[TenderController::class,'tenderPrice']);
        Route::post('/updateTenderPrice/{pri_id}',[TenderController::class,'updateTenderPrice']);
        Route::get('/details/{tender_id}',[TenderController::class,'details']);
        //end Tender 
      // start TypeWork
        Route::get('/allTypeWork',[TypeWorkController::class,'allTypeWork']);
        Route::post('/storeWorkType',[TypeWorkController::class,'storeWorkType']);
        Route::get('/editWorkType/{type_id}',[TypeWorkController::class,'editWorkType']);
        Route::post('/updateWorkType/{type_id}',[TypeWorkController::class,'updateWorkType']);
        Route::get('/deleteTypeWork/{type_id}',[TypeWorkController::class,'deleteTypeWork']);
      //end TypeWork 
      // start branshes
        Route::get('/branshes',[BranshWorkController::class,'branshes']);
        Route::get('/addBransh',[BranshWorkController::class,'addBransh']);
        Route::get('/editBransh/{type_id}',[BranshWorkController::class,'editBransh']);
        Route::post('/storeBransh',[BranshWorkController::class,'storeBransh']);
        Route::post('/updateBransh/{type_id}',[BranshWorkController::class,'updateBransh']);
        Route::get('/deleteBransh/{type_id}',[BranshWorkController::class,'deleteBransh']);
      //end branshes 
      // category
        Route::get('/categories',[CategoryController::class,'categories']);
        Route::post('/addCat',[CategoryController::class,'addCategory']);
        Route::post('/updateCat/{cat_id}',[CategoryController::class,'updateCategory']);
        Route::get('/deleteCat/{cat_id}',[CategoryController::class,'deleteCategory']);
      //category 
      //services
        Route::get('/services',[ServiceController::class,'services']);
        Route::post('/addSer',[ServiceController::class,'addService']);
        Route::post('/updateSer/{ser_id}',[ServiceController::class,'updateService']);
        Route::get('/deleteSer/{ser_id}',[ServiceController::class,'deleteService']);
      //services
      //building type
        Route::get('/buildings',[BuildingTypeController::class,'buildings']);
        Route::post('/addBuild',[BuildingTypeController::class,'addBuildingType']);
        Route::post('/updateBuil/{ser_id}',[BuildingTypeController::class,'updateBuildingType']);
        Route::get('/deleteBuil/{ser_id}',[BuildingTypeController::class,'deleteBuildingType']);
      //building type 
      //floar
        Route::get('/floars',[FloarController::class,'floars']);
        Route::post('/addFlo',[FloarController::class,'addFloar']);
        Route::post('/updateFlo/{ser_id}',[FloarController::class,'updateFloar']);
        Route::get('/deleteFlo/{ser_id}',[FloarController::class,'deleteFloar']);
      //floar
      // start notifications 
        Route::get('/notifications',[NotificationController::class,'notifications']);
        Route::get('/notificationText',[NotificationController::class,'notificationText']);
        Route::get('/deleteNot/{not_id}',[NotificationController::class,'deleteNotification']);
        Route::post('/updateNotText/{type_id}',[NotificationController::class,'updateNotText']);
        Route::post('/addNotText',[NotificationController::class,'addNotText']);
      //end notifications 
      // start address
        Route::get('/address',[AdressController::class,'address']);
        Route::post('/updateAdress/{add_id}',[AdressController::class,'updateAdress']);
        Route::get('/deleteAddress/{add_id}',[AdressController::class,'deleteAddress']);
      // end address 
      // start material
        Route::get('/material',[MaterialController::class,'material']);
        Route::post('/addMaterial',[MaterialController::class,'addMaterial']);
        Route::post('/updateMaterial/{mat_id}',[MaterialController::class,'updateMaterial']);
        Route::get('/deleteMaterial/{mat_id}',[MaterialController::class,'deleteMaterial']);
      // end material 
      // start sliders
        Route::get('/sliders',[SliderController::class,'all_sliders']);
        Route::post('/addSlider',[SliderController::class,'addSlider']);
        Route::post('/updateSlider/{sli_id}',[SliderController::class,'updateSlider']);
        Route::get('/deleteSlider/{sli_id}',[SliderController::class,'deleteSlider']);
      // end sliders   
      // reviews
        Route::get('/reviews',[ReviewController::class,'reviews']);
        Route::get('/deleteReview/{rev_id}',[ReviewController::class,'deleteReview']);
      // reviews 
      //blackList 
        Route::get('/blackList',[BlackListController::class,'blackList']);
        Route::post('/addWord',[BlackListController::class,'addWord']);
        Route::post('/updateWord/{word_id}',[BlackListController::class,'updateWord']);
        Route::get('/deleteWord/{word_id}',[BlackListController::class,'deleteWord']);
      //blackList
      //privacy
        Route::get('/privacy',[PrivacyController::class,'privacy']);
        Route::post('/updatePrivacy',[PrivacyController::class,'updatePrivacy']);
        Route::get('/terms',[PrivacyController::class,'terms']);
        Route::post('/updateTerms',[PrivacyController::class,'updateTerms']);
      //privacy
      //color
        Route::get('/colors',[ColorController::class,'colors']);
        Route::post('/addColor',[ColorController::class,'addColor']);
        Route::post('/updateColor/{col_id}',[ColorController::class,'updateColor']);
        Route::get('/deleteColor/{col_id}',[ColorController::class,'deleteColor']);

        Route::get('/colorDegree/{col_id}',[ColorShadeController::class,'colorDegree']);
        Route::post('/addDegree/{col_id}',[ColorShadeController::class,'addDegree']);
      //color
      //payments
        Route::get('/payments',[PaymentController::class,'payments']);
      //payments
      // wall paper
        Route::get('/papers',[PaperController::class,'papers']);
        Route::post('/addPaper',[PaperController::class,'addPaper']);
        Route::post('/updatePaper/{pap_id}',[PaperController::class,'updatePaper']);
        Route::get('/deletePaper/{pap_id}',[PaperController::class,'deletePaper']);
      // wall paper 
      // wall support
        Route::get('/support',[SupportController::class,'support']);
        Route::post('/reply/{id}',[SupportController::class,'reply']);
      // wall support
      // plaster type
        Route::get('/plasterType',[PlasterController::class,'plasterType']);
        Route::get('/deletplasterType/{type_id}',[PlasterController::class,'deletplasterType']);
        Route::post('/storePlasterType',[PlasterController::class,'storePlasterType']);
        Route::post('/updatePlasterType',[PlasterController::class,'updatePlasterType']);
      // plaster type
      // update buessnis and sub and question and answers
      Route::get('/viewBusiness',[UpdateQuestionController::class,'viewBusiness']);
      Route::post('/addBusiness',[UpdateQuestionController::class,'addBusiness']);
      Route::post('/updateBus/{id}',[UpdateQuestionController::class,'updateBus']);
      Route::get('/deleteBusiness/{id}',[UpdateQuestionController::class,'deleteBusiness']);
      Route::post('/addSubBusiness/{id}',[UpdateQuestionController::class,'addSubBusiness']);
      Route::get('/subBusiness/{id}',[UpdateQuestionController::class,'subBusiness']);
      Route::post('/updateSub/{id}',[UpdateQuestionController::class,'updateSub']);
      Route::get('/deleteSub/{id}',[UpdateQuestionController::class,'deleteSub']);
      Route::get('/questionSub/{id}',[UpdateQuestionController::class,'questionSub']);
      Route::post('/addquestion/{id}',[UpdateQuestionController::class,'addquestion']);
      Route::post('/updateQuestion/{id}',[UpdateQuestionController::class,'updateQuestion']);
      Route::get('/deleteQues/{id}',[UpdateQuestionController::class,'deleteQues']);
      Route::get('/answerQuestion/{id}',[UpdateQuestionController::class,'answerQuestion']);
      Route::post('/addAnswer/{id}',[UpdateQuestionController::class,'addAnswer']);
      Route::post('/updateAnswer/{id}',[UpdateQuestionController::class,'updateAnswer']);
      Route::get('/deleteAnswer/{id}',[UpdateQuestionController::class,'deleteAnswer']);
      Route::get('/makeFurnished/{id}',[UpdateQuestionController::class,'makeFurnished']);
      
      
    // paint   
});
Route::get('/fcm',[FCMController::class,'index']);
Route::get('/save-token',[FCMController::class,'saveToken'])->name('save-token');
Route::get('/change-language/{locale}', function ($locale) {
  App::setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});
