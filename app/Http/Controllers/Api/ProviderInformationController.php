<?php

namespace App\Http\Controllers\Api;
    use Illuminate\Routing\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use App\Models\User;
    use Image;
    use App\Models\TenderInterested;
    use App\Models\ProviderImage;
    use App\Models\Notification;
    use App\Models\ProviderService;
    use App\Models\ProviderGallary;
    use App\Models\ServiceProvider;
    use JWTAuth;
    use Tymon\JWTAuth\Exceptions\JWTException;
class ProviderInformationController extends Controller
{
    public function allProvider(){
        $providers = User::where('type','provider')->where('status','1')->paginate(10);
        return response()->json([
            'status'  =>'200',
            'details' =>$providers
        ], 200);
    }    
    public function providerImage(Request $request){
        $provider_id = JWTAuth::authenticate($request->token)->id;
        $provider_image = ProviderImage::where('provider_id',$provider_id)->first();
        if($provider_image == null){
            $provider_image = new ProviderImage;
            $provider_image->provider_id = $provider_id;
            $provider_image->save();
        }
        if($request->file('front_craft_card')){
            $image=$request->file('front_craft_card');
            $input['front_craft_card'] = $image->getClientOriginalName();
            $path = 'images/user/';
            $destinationPath = 'images/user';
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.time().$input['front_craft_card']);
            $name = $path.time().$input['front_craft_card'];
            
            $data['front_craft_card'] =  $name;
            $provider_image = ProviderImage::where('provider_id',$provider_id)->first();
            $provider_image->front_craft_card = $data['front_craft_card'];
            $provider_image->save();
        }
        if($request->file('back_craft_card')){
            $image=$request->file('back_craft_card');
            $input['back_craft_card'] = $image->getClientOriginalName();
            $path = 'images/user/';
            $destinationPath = 'images/user';
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.time().$input['back_craft_card']);
            $name = $path.time().$input['back_craft_card'];
            
            $data['back_craft_card'] =  $name;
            $provider_image = ProviderImage::where('provider_id',$provider_id)->first();
            $provider_image->back_craft_card = $data['back_craft_card'];
            $provider_image->save();
        }
        if($request->file('back_work_certificate')){
            $image=$request->file('back_work_certificate');
            $input['back_work_certificate'] = $image->getClientOriginalName();
            $path = 'images/user/';
            $destinationPath = 'images/user';
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.time().$input['back_work_certificate']);
            $name = $path.time().$input['back_work_certificate'];
            
            $data['back_work_certificate'] =  $name;

            $provider_image = ProviderImage::where('provider_id',$provider_id)->first();
            $provider_image->back_work_certificate = $data['back_work_certificate'];
            $provider_image->save();
        }
        if($request->file('front_work_certificate')){
            $image=$request->file('front_work_certificate');
            $input['front_work_certificate'] = $image->getClientOriginalName();
            $path = 'images/user/';
            $destinationPath = 'images/user';
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.time().$input['front_work_certificate']);
            $name = $path.time().$input['front_work_certificate'];
            
            $data['front_work_certificate'] =  $name;

            $provider_image = ProviderImage::where('provider_id',$provider_id)->first();
            $provider_image->front_work_certificate = $data['front_work_certificate'];
            $provider_image->save();
        }
        if($request->file('front_CR')){
            $image=$request->file('front_CR');
            $input['front_CR'] = $image->getClientOriginalName();
            $path = 'images/user/';
            $destinationPath = 'images/user';
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.time().$input['front_CR']);
            $name = $path.time().$input['front_CR'];
            
            $data['front_CR'] =  $name;

            $provider_image = ProviderImage::where('provider_id',$provider_id)->first();
            $provider_image->front_CR = $data['front_CR'];
            $provider_image->save();
        }
        if($request->file('back_CR')){
            $image=$request->file('back_CR');
            $input['back_CR'] = $image->getClientOriginalName();
            $path = 'images/user/';
            $destinationPath = 'images/user';
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.time().$input['back_CR']);
            $name = $path.time().$input['back_CR'];
            
            $data['back_CR'] =  $name;

            $provider_image = ProviderImage::where('provider_id',$provider_id)->first();
            $provider_image->back_CR = $data['back_CR'];
            $provider_image->save();
        }
        if($request->file('image')){
            $image=$request->file('image');
            $input['image'] = $image->getClientOriginalName();
            $path = 'images/user/';
            $destinationPath = 'images/user';
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.time().$input['image']);
            $name = $path.time().$input['image'];
            
            $data['image'] =  $name;

            $provider_image = ProviderImage::where('provider_id',$provider_id)->first();
            $provider_image->image = $data['image'];
            $provider_image->save();
        }
        return response()->json([
            'status' => 200,
            'details' => 'added successfully'
        ]);
    }
    public function providerDetails(Request $request){
        // $provider_id   = JWTAuth::authenticate($request->token);
        if($request->user_id == 0){
            $provider = User::with('images','package','postal','user_review','user_review.user.images','gallary','licences.main_work.icons','licences.business','certificates')
            ->find($request->provider_id);
        }else{
            $connecting = TenderInterested::where('user_id',$request->user_id)->where('provider_id',$request->provider_id)->first();
            if($connecting == null || $connecting->status != 'deal'){
                $provider = User::select('id','first_name','last_name','rate','company_name','Legal_form','postal_code')
                ->with('images','postal','user_review','user_review.user.images','gallary','licences.main_work.icons','licences.business','certificates')
                ->find($request->provider_id);
                $user = User::with('images','postal','user_review','user_review.user.images','gallary','last_deal:id,user_id,created_at')
                ->select('id','first_name','last_name','rate','postal_code')
                ->withCount('tender','user_deal')
                ->find($request->user_id);
            }else{
                $provider = User::with('images','package','postal','user_review','user_review.user.images','gallary','licences.main_work.icons','licences.business','certificates')
                ->find($request->provider_id);
            }
            return response()->json([
                'details' => $provider,
                'user' => $user
            ]);
        }
        
        return response()->json([
            'details' => $provider
        ]);
    }
    public function addToGallary(Request $request){
        $provider   = JWTAuth::authenticate($request->token);
        if($request->file('image')){
            $path = 'images/gallary/';
            $files=$request->file('image');

            foreach($files as $file) {
 
                $input['image'] = $file->getClientOriginalName();
                $destinationPath = 'images/gallary/';
                
                $img = Image::make($file->getRealPath());
                $img->resize(800, 750, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path.$input['image']);
                $name = $path.$input['image'];
                ProviderGallary::insert( [
                    'image'=>  $name,
                    'provider_id'=> $provider->id,
                ]);

            }
        }
        return response()->json([
            'details' => 'added successfully'
        ]);
    }
    public function deleteFromGallary(Request $request){
        // ارسال التوكن 
        $provider_id   = JWTAuth::authenticate($request->token)->id;
        $image = ProviderGallary::where('provider_id',$provider_id)->where('id',$request->id)->delete();
        return response()->json([
            'details' => 'deleted successfully',
        ]);
    }
    public function providerServices(){
        $services = ProviderService::all();
        return response()->json([
            'details' => $services
        ]);
 
    }
    public function addServices (Request $request){
        // ابعت التوكن بدال provider _id
        $provider_id = JWTAuth::authenticate($request->token)->id;
        $services = explode(',', $request->services);
        foreach($services as $service){
            $data = [
                'provider_id' => $provider_id,
                'service_id' => $service
            ];
            ServiceProvider::create($data);
        }
        return response()->json([
            'details' => 'added sucessfully'
        ]);
    }
    public function updateService(Request $request){
        $provider_id = JWTAuth::authenticate($request->token)->id;
        $service = ServiceProvider::where('provider_id',$provider_id)->delete();
        $services = explode(',', $request->services);
        foreach($services as $service){
            $data = [
                'provider_id' => $provider_id,
                'service_id' => $service
            ];
            ServiceProvider::create($data);
        }
        return response()->json([
            'details' => 'updated sucessfully'
        ]);
 
    }
    public function deleteService(Request $request){
        $provider_id = JWTAuth::authenticate($request->token)->id;
        $service = ServiceProvider::where('provider_id',$provider_id)
        ->where('id',$request->service_id)
        ->delete();
        return response()->json([
            'details' => 'deleted successfully'
        ]);
    }
    public function providerInterest(Request $request){
        $provider_id = JWTAuth::authenticate($request->token)->id;
        $interests = TenderInterested::with('tender')
        ->where('provider_id',$provider_id)
        ->where('status','interested')
        ->get();
        return response()->json([
            'details' => $interests
        ]);
    }
    public function providerConnect(Request $request){
        $provider_id = JWTAuth::authenticate($request->token)->id;
        $connecting = TenderInterested::with('tender','user')
        ->with(['review_tender'=>function($q) use ($provider_id) {
            
            return $q->where('provider_id',$provider_id)->orwhere('user_id',$provider_id);
        }])
        ->where('provider_id',$provider_id)
        ->whereIn('status',['connected','deal'])
        ->get();
        return response()->json([
            'details' => $connecting
        ]);
    }
    public function providerRequested(Request $request){
        $provider_id = JWTAuth::authenticate($request->token)->id;
        $interests = TenderInterested::with('tender')
        ->where('provider_id',$provider_id)
        ->where('status','interested')
        ->where('offer',null)
        ->get();
        return response()->json([
            'details' => $interests
        ]);
    }
}
