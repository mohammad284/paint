<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//paint
    use App\Http\Controllers\Api\AuthController;
    use App\Http\Controllers\Api\TenderController;
    use App\Http\Controllers\Api\ProviderInformationController;
    use App\Http\Controllers\Api\TypeWorkController;
    use App\Http\Controllers\Api\chatController;
    use App\Http\Controllers\Api\PackageController;
    use App\Http\Controllers\Api\ReviewController;
    use App\Http\Controllers\Api\SliderController;
    use App\Http\Controllers\Api\AdvertisingController;
    use App\Http\Controllers\Api\AddressController;
    use App\Http\Controllers\Api\MaterialController;
    use App\Http\Controllers\Api\PrivacyController;
    use App\Http\Controllers\Api\ColorController;
    use App\Http\Controllers\Api\UserController;
    use App\Http\Controllers\Api\AboutUsController;
    use App\Http\Controllers\Api\NotificationController;
    use App\Http\Controllers\Api\EmailController;
    use App\Http\Controllers\Api\ReportController;
    use App\Http\Controllers\Api\PaperController;
    use App\Http\Controllers\Api\PdfController;
    use App\Http\Controllers\Api\PaymentController;
    use App\Http\Controllers\Api\SupportController;
    use App\Http\Controllers\VerificationController;
    use App\Http\Controllers\Api\BusinessController;
    use App\Http\Controllers\Api\FeedController;
    //paint

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post ( '/call', [PaymentController::class,'call'] );

Route::get('/email/resend',[VerificationController::class,'resend'])->name('verification.resend');
Route::get('/email/verify/{id}',[VerificationController::class,'verify'])->name('verification.verify');


Route::group([ 'middleware' => 'api' , 'prefix' => 'auth' ] , function() {
    Route::post('/register' , [AuthController::class , 'register']);
    Route::post('/login' , [AuthController::class , 'login']);
    Route::post('/logout' , [AuthController::class , 'logout']);
    Route::post('/refresh' , [AuthController::class , 'refresh']);
    Route::post('/verifyCode', [AuthController::class, 'verifyCode']);
});
//paint
        Route::get('/all_business',[BusinessController::class,'all_business']); // الاقسام الرئيسية والفرعية
        Route::post('/provider_business',[BusinessController::class,'provider_business']); // كل مستخدم مع الاعمال المرخصة
        Route::post('/questions' ,[BusinessController::class , 'questions']);
        // اضافة الاساسيات والفرعيات والاسئلة والاجوبة
        Route::post('/add_business' ,[BusinessController::class , 'add_business']);
        Route::post('/add_sub' ,[BusinessController::class , 'add_sub']);
        Route::post('/add_question' ,[BusinessController::class , 'add_question']);
        Route::post('/add_answer' ,[BusinessController::class , 'add_answer']);
        Route::get('/updateMoreIcon' ,[BusinessController::class , 'updateMoreIcon']);
        Route::get('/storeSameSub/{id}' ,[BusinessController::class , 'storeSameSub']);
        #####################################
        ### without token 
        // UserController
            Route::post('/forgetPassword',[ UserController::class ,'forgetPassword']);
            Route::get('/works_licenses',[ UserController::class ,'works_licenses']);
        // TenderController
            Route::get('/categories' , [TenderController::class ,'categories']);
            Route::get('/services' , [TenderController::class ,'services']);
            Route::get('/buildingType' , [TenderController::class ,'buildingType']);
            Route::get('/floarType' , [TenderController::class ,'floarType']);
            Route::post('/editOtherTender' , [TenderController::class ,'editOtherTender']);
            Route::post('/archiveTender' , [TenderController::class ,'archiveTender']);
            Route::post('/removeInterested' , [TenderController::class ,'removeInterested']);
            Route::post('/offerRejected' , [TenderController::class ,'offerRejected']);
            Route::post('/storeBuildingTender' , [TenderController::class ,'storeBuildingTender']);//building
            Route::post('/storeGlossyFloreTender' , [TenderController::class ,'storeGlossyFloreTender']);//GlossyFlore
            Route::post('/storePlasterTender' , [TenderController::class ,'storePlasterTender']);//plaster
            Route::post('/connected' , [TenderController::class ,'connected']);
            Route::post('/tenderFile' , [TenderController::class ,'tenderFile']);
            Route::get('/plasterTypes' , [TenderController::class ,'plasterTypes']);//plasterTypes
            Route::post('/tenderImage' , [TenderController::class ,'tenderImage']);
            Route::post('/deleteImage' , [TenderController::class ,'deleteImage']);
            Route::post('/deleteFile' , [TenderController::class ,'deleteFile']);
            Route::post('/tenderFile' , [TenderController::class ,'tenderFile']);
            Route::post('/updateInterested' ,[TenderController::class , 'updateInterested']);
        // ProviderInformationController
            Route::post('/providerImage',[ ProviderInformationController::class ,'providerImage']);
            Route::post('/deleteFromGallary',[ ProviderInformationController::class ,'deleteFromGallary']);
            Route::get('/providerServices',[ ProviderInformationController::class ,'providerServices']);

        Route::get('/aboutUs' ,[AboutUsController::class , 'aboutUs']);
        Route::post('/readNot' ,[NotificationController::class , 'readNot']);

        Route::post('/lastMessages' ,[chatController::class , 'lastMessages']);
        Route::post('/sendChatAttach' ,[chatController::class , 'sendChatAttach']);
        
        Route::post('/review_details' ,[ReviewController::class , 'review_details']);
        Route::get('/deleteReview/{review_id}',[ReviewController::class , 'deleteReview']);
        Route::post('/makeTenderPdf' ,[PdfController::class , 'makeTenderPdf']);
        Route::post('/replies' ,[ReviewController::class , 'replies']);                
        
        #### with token
        Route::group(['middleware' => ['jwt.verify']], function() {
            Route::post('/addFeed',[ FeedController::class ,'add_feed']);
            Route::post('/editProfile',[ UserController::class ,'editProfile']);
            Route::post('/myProfile',[ UserController::class ,'myProfile']);
            Route::post('/updatePassword',[ UserController::class ,'updatePassword']);
            Route::post('/deleteAccount',[ UserController::class ,'deleteAccount']);
            Route::post('/refreshFBtoken', [UserController::class, 'refreshFB']);
            Route::post('/add_dis_active_business' ,[BusinessController::class , 'add_dis_active_business']);

            // start provider information profile
                Route::get('/allProvider',[ProviderInformationController::class,'allProvider']);
                Route::post('/providerDetails',[ ProviderInformationController::class ,'providerDetails']);
                Route::post('/addToGallary',[ ProviderInformationController::class ,'addToGallary']);
                Route::post('/addServices',[ ProviderInformationController::class ,'addServices']);
                Route::post('/updateService',[ ProviderInformationController::class ,'updateService']);
                Route::post('/deleteService',[ ProviderInformationController::class ,'deleteService']);                
                Route::post('/providerInterest', [ProviderInformationController::class, 'providerInterest']);
                Route::post('/providerConnect', [ProviderInformationController::class, 'providerConnect']);
                Route::post('/providerRequested', [ProviderInformationController::class, 'providerRequested']);
            //start tender
                Route::post('/storeOtherTender' , [TenderController::class ,'storeOtherTender']);
                Route::post('/tenderOffers' , [TenderController::class ,'tenderOffers']);
                Route::post('/startTender' , [TenderController::class ,'startTender']);
                Route::post('/deleteTender' , [TenderController::class ,'deleteTender']);

                Route::post('/searchProvider' , [TenderController::class ,'searchProvider']);
                Route::post('/sendInterested' ,[TenderController::class , 'sendInterested']);
                Route::post('/allInterested' , [TenderController::class ,'allInterested']);
                Route::post('/myTenders' , [TenderController::class ,'myTenders']);
                Route::post('/tenderDetails' , [TenderController::class ,'tenderDetails']);
                
                Route::post('/closeDeal' , [TenderController::class ,'closeDeal']);
                Route::post('/rejectDeal' , [TenderController::class ,'reject_deal']);
                
                Route::post('/storeTender' , [TenderController::class ,'storeTender']);
                Route::post('/updateTender' , [TenderController::class ,'updateTender']);
                Route::post('/allTenders' , [TenderController::class ,'all_tenders']);
                Route::post('/archive' , [TenderController::class ,'archive']);
                Route::post('/tasks' , [TenderController::class ,'tasks']);
                Route::post('/myChats' , [TenderController::class ,'myChats']);
            //end tender
            // start chat
                Route::post('/sendMessage' ,[chatController::class , 'sendMessage']);
                Route::post('/conversations' ,[chatController::class , 'conversations']);
                Route::post('/getMessage' ,[chatController::class , 'getMessage']);
                Route::post('/changeConversationStatus' ,[chatController::class , 'changeConversationStatus']);

            //end chat
            // start Review
                Route::post('/addReview' ,[ReviewController::class , 'addReview']);
                Route::post('/reply_review' ,[ReviewController::class , 'reply_review']);
                Route::get('/userReview' ,[ReviewController::class , 'userReview']);
            //end Review
            // reports  allReport
                Route::post('/makeReportPdf' ,[PdfController::class , 'makeReportPdf']);                
            //reports Record

            //notification
                // Route::post('/senderNotification' ,[NotificationController::class , 'senderNot']);
                Route::post('/myNotification' ,[NotificationController::class , 'reciveNot']);
            //notification
        });
    // end provider information  profile
    // start work type
        Route::get('/allTypeWork' , [TypeWorkController::class , 'all_TypeWork']);
    // end work type
    // address
        Route::get('/postalCode' , [AddressController::class , 'postalCode']);
        Route::post('/getMultiZip' , [AddressController::class , 'getMultiZip']);
    //address
    // material
        Route::get('/materials' , [MaterialController::class , 'materials']);
    //material
        Route::get('/email' , [EmailController::class ,'mail']);

    // colors
        Route::get('/colors' , [ColorController::class ,'colors']);
    // colors

    //privacy
        Route::get('/privacy',[PrivacyController::class,'privacy']);
        Route::get('/terms',[PrivacyController::class,'terms']);
    //privacy
    // start slider
        Route::get('/sliders' ,[SliderController::class , 'sliders']);
        Route::post('/addSlider' ,[SliderController::class , 'addSlider']);
    // end slider
    // start Package
        Route::get('/allPackage' ,[PackageController::class , 'allPackage']);
        Route::post('/subPackage' ,[PackageController::class , 'subPackage']);
    //end Package
    
    // wall paper
        Route::get('/papers',[PaperController::class,'papers']);
        Route::get('/translate',[PaperController::class,'translate']);
    // wall paper

    //  support
        Route::post('/support',[SupportController::class,'support']);
    // support
    Route::get('/pdfEmail' ,[PdfController::class , 'pdfEmail']);
    Route::post('/reports' ,[ReportController::class , 'reports']);
    Route::post('/allReport' ,[ReportController::class , 'allReport']);
    Route::post('/tenderRecord' ,[ReportController::class , 'tenderRecord']);

//paint

