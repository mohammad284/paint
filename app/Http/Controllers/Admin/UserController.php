<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Mail;
    use Illuminate\Support\Facades\Hash;
    use App\Mail\MailNotify;
    use App\Models\User;
    use App\Models\NotificationText;
    use App\Models\TypeWork;
    use App\Models\Package;
    use App\Models\ProviderImage;
    use App\Models\ProviderCertificate;
    use App\Models\Address;
    use App\Models\Tender;
    use App\Models\ProviderService;
    use App\Models\TenderInterested;
    use App\Models\Notification;
    use App\Models\WorkLicense;
    use App\Models\BusinessProvider;
    use Validator;
    use App\Models\Payment;
    use App\Models\ProviderRole;
    use Image;
    use App\Mail\mailProvider;
    use Stripe;
use Session;
use Stripe\PaymentIntent;
class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function allUser(){
        $users = User::with('postal')->where('type','user')->get();
        return view('dashboard.user.all-user',compact('users'));
    }
    public function addUser(Request $request){
        $postals = Address::all();
        return view('dashboard.user.add-user',compact('postals'));
    }
    public function storeUser(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'   => ['required', 'string', 'min:8', 'confirmed'],
            'mobile'     => ['required', 'unique:users'],
            'postal_code'=> ['required'],
            'gender'     => ['required'],
            'street_num' => ['required'],
            'home_num'   => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user =  User::create([
            'first_name'        => $request['first_name'],
            'last_name'         => $request['last_name'],
            'email'             => $request['email'],
            'mobile'            => $request['mobile'],
            'password'          => Hash::make($request['password']),
            'status'            => '0',
            'type'              => 'user',
            'postal_code'       => $request->postal_code,
            'gender'            => $request->gender,
            'home_num'          => $request->home_num,
            'street_num'        => $request->street_num,
            'email_permission'  => '1'
        ]);
        return redirect()->back()->withErrors('added successfully');
    }
    public function editUser($user_id){
        $user = User::with('postal')->find($user_id);
        $postals = Address::all();
        return view('dashboard.user.edit-user',compact('user','postals'));
    }
    
    public function updateUser(Request $request , $user_id){
        $user = User::find($user_id);
        if ($user->email != $request->email) {
            $simular_email = User::where('email',$request->email)->get();
            if (count($simular_email) > 0) {
                return redirect()->back()->withErrors('message','email has taken');
            }   
        }
        if($request->password == null){
            $validator = Validator::make($request->all(), [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name'  => ['required', 'string', 'max:255'],
                'postal_code'=> ['required'],
                'gender'     => ['required'],
                'street_num' => ['required'],
                'home_num'   => ['required'],
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $data = [
                'first_name'          => $request['first_name'],
                'last_name'           => $request['last_name'],
                'email'               => $request['email'],
                'mobile'              => $request['mobile'],
                'postal_code'         => $request->postal_code,
                'gender'              => $request->gender,
                'home_num'            => $request->home_num,
                'street_num'          => $request->street_num,
            ];
        }else{
            $validator = Validator::make($request->all(), [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name'  => ['required', 'string', 'max:255'],
                'postal_code'=> ['required'],
                'gender'     => ['required'],
                'street_num' => ['required'],
                'home_num'   => ['required'],
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $data = [
                'first_name'          => $request['first_name'],
                'last_name'           => $request['last_name'],
                'email'               => $request['email'],
                'mobile'              => $request['mobile'],
                'password'            => Hash::make($request['password']),
                'postal_code'         => $request->postal_code,
                'gender'              => $request->gender,
                'home_num'            => $request->home_num,
                'street_num'          => $request->street_num,
            ];
        }

        $user->update($data);
        return redirect('/admin/allUser')->withErrors('updated successfully');
    }
    public function allprovider(){
        $app_lan = app()->getLocale();
        if($app_lan == 'en'){ $lan = '1';};
        if($app_lan == 'de'){ $lan = '2';};
        $providers = User::with('postal')->where('type','provider')->where('status','1')->get();
        return view('dashboard.provider.all-provider',compact('providers'));
    }
    public function spicialProvider($provider_id)
    {
        $provider = User::find($provider_id);
        if($provider->spicial == 1){
            $provider->spicial = 0;
        }else{
            $provider->spicial = 1;
        }        
        $provider->save();
        return redirect()->back();
    }
    
    public function addProvider(){
        $postals = Address::all();
        $licenses = WorkLicense::all();
        return view('dashboard.provider.add-provider',compact('postals','licenses'));
    }
    public function storeProvider(Request $request){
            
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'   => ['required', 'string', 'min:8', 'confirmed'],
            'mobile'     => ['required', 'unique:users'],
            'postal_code'=> ['required'],
            'gender'     => ['required'],
            'company_name' => ['required'],
            'Legal_form'   => ['required'],
            'street_num'   => ['required'],
            'home_num'     => ['required'],
            'com_description' => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $provider =  User::create([
            'first_name'          => $request['first_name'],
            'last_name'           => $request['last_name'],
            'email'               => $request['email'],
            'mobile'              => $request['mobile'],
            'gender'              => $request['gender'],
            'password'            => Hash::make($request['password']),
            'status'              => '1',
            'type'                => 'provider',
            'postal_code'         => $request->postal_code,
            'company_name'        => $request->company_name,
            'Legal_form'          => $request->Legal_form,
            'email_permission'    => '1', 
            'home_num'            => $request->home_num,
            'street_num'          => $request->street_num,
            'com_description'     => $request->com_description,
        ]);
        
        $works = $request->works;
            foreach($works as $work) {
                $license = WorkLicense::where('id',$work)->first();
                BusinessProvider::insert( [
                    'business_id' => $license->business_id,
                    'work_license_id'=> $license->id,
                    'provider_id' => $provider->id,
                    'status'      => '1',
                    'active'      => '0',
                ]);
            }
        $image = new ProviderImage;
        $image->provider_id = $provider->id;
        $image->save();
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
            // return response()->json($name);
            
            $data['front_craft_card'] =  $name;
            $provider_image = ProviderImage::where('provider_id',$provider->id)->first();
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
            $provider_image = ProviderImage::where('provider_id',$provider->id)->first();
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

            $provider_image = ProviderImage::where('provider_id',$provider->id)->first();
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

            $provider_image = ProviderImage::where('provider_id',$provider->id)->first();
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

            $provider_image = ProviderImage::where('provider_id',$provider->id)->first();
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

            $provider_image = ProviderImage::where('provider_id',$provider->id)->first();
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

            $provider_image = ProviderImage::where('provider_id',$provider->id)->first();
            $provider_image->image = $data['image'];
            $provider_image->save();
        }
        if($request->work_type == 1 ){
            $role = new ProviderRole;
            $role->provider_id = $provider->id;
            $role->glossy = $request->glossy;
            $role->save();
        }
        return redirect()->back()->withErrors('added successfully');
    }

    public function requestProvider(){
        $providers = User::with('postal','licences.business')
        ->where('type','provider')->where('status','0')->get();
        // return $providers;
        return view('dashboard.provider.request-provider',compact('providers'));
    }
    public function acceptProvider(Request $request,$provider_id) {
        // dd($request);
        foreach($request->works as $licen){
            $work = BusinessProvider::find($licen)->update(['status'=>'1','active'=>'1']);
        }
        
        $provider = User::find($provider_id);
        $provider->status = '1';
        $provider->save();
        foreach($request->certificates as $certifi){
            $certificate = [
                'provider_id' => $provider_id,
                'name'        => $certifi
            ];
            ProviderCertificate::create($certificate);
        }
        

        $acceptProvider_mail = NotificationText::where('type','acceptProvider_mail')->first();
        $acceptProvider_firebase = NotificationText::where('type','acceptProvider_firebase')->first();
        $token = $provider->fb_token;
        $from = "AAAAL7BzUWM:APA91bG_nBPSECAHlYl5Zo3eEX9jPI2_Td-dS4YasibBb2UsV2Tpof0PfsA2h2NQhfAqoHrg26Vm1Br6LitLIU5YhkhVfh1saVvijb5Qr01FcScZShEoK-E_ZDqVcSXO_N7YizeApqqA";
        $msg = array
              (
                'body'  =>  "$acceptProvider_firebase->not_gr" ,
                'title' =>  "$acceptProvider_firebase->not_en",
                'receiver' => 'erw',
                'icon'  => "https://image.flaticon.com/icons/png/512/270/270014.png",/*Default Icon*/
                'sound' => 'mySound'/*Default sound*/
              );

        $fields = array
                (
                    'to'        => $token,
                    'notification'  => $msg
                );

        $headers = array
                (
                    'Authorization: key=' . $from,
                    'Content-Type: application/json'
                );
        //#Send Reponse To FireBase Server 
        $ch = curl_init();
            curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
            curl_setopt( $ch,CURLOPT_POST, true );
            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );
        $data = [
            'first_name' => $provider->first_name,
            'last_name'  => $provider->last_name,
            'mobile'     => $provider->mobile,
            'title'      => 'Welcome to Maler',
            'data_en'    =>  "$acceptProvider_mail->not_en" ,
            'data_gr'    =>  "$acceptProvider_mail->not_gr",
        ];

        
        Mail::to($provider->email)->send(new mailProvider($data));
        return redirect()->back();

    }

    public function updateBuisnessProvider()
    {
        $providers = User::with('licences.business')->
        wherehas('licences' , function($query){
            $query->where('status','0');
        })
        ->where('status','1')->get();
        return view('dashboard.provider.update-buisness-provider',[
            'providers' => $providers
        ]);
    }
    public function acceptUpdateBuisness(Request $request,$provider_id)
    {
        // dd($request) ;
        foreach($request->works as $licen){
            $work = BusinessProvider::find($licen)->update(['status'=>'1','active'=>'1']);
        }
        return redirect()->back();
    }
    public function deleteProvider($provider_id){
        $provider = User::find($provider_id)->delete();
        $nots = Notification::where('reciver',$provider_id)->delete();
        return redirect()->back()->withErrors('deleted successfully');
    }
    public function editProvider($provider_id){

        $provider = User::with('postal','provider_role')->find($provider_id);
        $postals = Address::all();
        // return($provider);
        return view('dashboard.provider.edit-provider',compact('provider','postals'));
    }
    public function updateProvider(Request $request , $user_id){
        $user = User::find($user_id);
        if ($user->email != $request->email) {
            $simular_email = User::where('email',$request->email)->get();
            if (count($simular_email) > 0) {
                return redirect()->back()->withErrors('email has taken');
            }  
        }
        if($request->password == null){
            $validator = Validator::make($request->all(), [
                'first_name'   => ['required', 'string', 'max:255'],
                'last_name'    => ['required', 'string', 'max:255'],
                'Legal_form'   => ['required'],
                'company_name' => ['required'],
                'work_type'    => ['required'],
                'gender'       => ['required'],
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $data = [
                'first_name'     => $request['first_name'],
                'last_name'      => $request['last_name'],
                'email'          => $request['email'],
                'mobile'         => $request['mobile'],
                'postal_code'    => $request->postal_code,
                'work_type'      => $request->work_type,
                'gender'         => $request->gender,
                'company_name'   => $request->company_name,
                'Legal_form'     => $request->Legal_form,
                'card_type'      => $request->card_type,
                'card_time'      => $request->card_time,
                'card_num'       => $request->card_num,
                'card_name'      => $request->card_name,
                'bank_name'      => $request->bank_name,
                'home_num'       => $request->home_num,
                'street_num'     => $request->street_num,
                'work_range'     => $request->work_range,
                'com_description'=> $request->com_description,
            ];
        }else{
            $validator = Validator::make($request->all(), [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name'  => ['required', 'string', 'max:255'],
                'password'   => ['required', 'string', 'min:8', 'confirmed'],
                'mobile'     => ['required', 'unique:users'],
                'address'    => ['required'],
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $data = [
                'first_name'     => $request['first_name'],
                'last_name'      => $request['last_name'],
                'email'          => $request['email'],
                'mobile'         => $request['mobile'],
                'password'       => Hash::make($request['password']),
                'address'        => $request->address,
                'postal_code'    => $request->postal_code,
                'work_type'      => $request->work_type,
                'gender'         => $request->gender,
                'company_name'   => $request->company_name,
                'card_type'      => $request->card_type,
                'card_time'      => $request->card_time,
                'card_num'       => $request->card_num,
                'card_name'      => $request->card_name,
                'bank_name'      => $request->bank_name,
                'home_num'       => $request->home_num,
                'street_num'     => $request->street_num,
                'work_range'     => $request->work_range,
                'com_description'=> $request->com_description,
            ];
        }
        $user->update($data);
        if($request->work_type == 1 ){
            $role = ProviderRole::where('provider_id',$user->id)->first();
            if($role == null){
                $role = new ProviderRole;
                $role->provider_id = $user_id;
                $role->glossy = $request->glossy;
                $role->save();
            }else{
                $role->glossy = $request->glossy;
                $role->save();
            }
        }
        return redirect('/admin/allprovider')->withErrors('updated successfully');
    }
    public function blockProvider($provider_id){
        $provider = User::where('id',$provider_id)->first();
        $provider->status = '2';
        $provider->save();
        $blockProvider_mail = NotificationText::where('type','blockProvider_mail')->first();
        $blockProvider_firebase = NotificationText::where('type','blockProvider_firebase')->first();
        $data = [
            'first_name'=>$provider->first_name,
            'last_name'=>$provider->last_name,
            'mobile'=>$provider->mobile,
            'title'=> 'block in Maler',
            'data_gr' => " $blockProvider_mail->not_gr",
            'data_en' => " $blockProvider_mail->not_gr",
        ];

        Mail::to($provider->email)->send(new mailProvider($data));
        $token = $provider->fb_token;
        // $token = "e46i2AQhvpA:APA91bFovur3_2c2T66kMdDrwNXluRHALJvbx6x_j29SLKOQPUSEhWyCsrGKUpIfqnbBS1jUCEz75ny-ZV_VcP0RTy4T6xwe9bUlJn_Ao1pg_KmyxnhXrZyeT88SdGXUxVehBJ1djn7U";  
        $from = "AAAAL7BzUWM:APA91bG_nBPSECAHlYl5Zo3eEX9jPI2_Td-dS4YasibBb2UsV2Tpof0PfsA2h2NQhfAqoHrg26Vm1Br6LitLIU5YhkhVfh1saVvijb5Qr01FcScZShEoK-E_ZDqVcSXO_N7YizeApqqA";
        $msg = array
              (
                'body'  =>  "$blockProvider_firebase->not_gr" ,
                'title' =>  "$blockProvider_firebase ->not_en",
                'receiver' => 'erw',
                'icon'  => "https://image.flaticon.com/icons/png/512/270/270014.png",/*Default Icon*/
                'sound' => 'mySound'/*Default sound*/
              );

        $fields = array
                (
                    'to'        => $token,
                    'notification'  => $msg
                );

        $headers = array
                (
                    'Authorization: key=' . $from,
                    'Content-Type: application/json'
                );
        //#Send Reponse To FireBase Server 
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );
        return redirect()->back()->with;
    }
    public function activeProvider($provider_id){
        $provider = User::where('id',$provider_id)->first();
        $provider->status = '1';
        $provider->save();
        $activeProvider_mail = NotificationText::where('type','activeProvider_mail')->first();
        $activeProvider_firebase = NotificationText::where('type','activeProvider_firebase')->first();
        $data = [
            'first_name'=>$provider->first_name,
            'last_name'=>$provider->last_name,
            'mobile'=>$provider->mobile,
            'title'=> 'active in Maler',
            'data_en' => "$activeProvider_mail->not_en",
            'data_gr' => "$activeProvider_mail->not_gr",
        ];

        Mail::to($provider->email)->send(new mailProvider($data));
        $token = $provider->fb_token;
        // $token = "e46i2AQhvpA:APA91bFovur3_2c2T66kMdDrwNXluRHALJvbx6x_j29SLKOQPUSEhWyCsrGKUpIfqnbBS1jUCEz75ny-ZV_VcP0RTy4T6xwe9bUlJn_Ao1pg_KmyxnhXrZyeT88SdGXUxVehBJ1djn7U";  
        $from = "AAAAL7BzUWM:APA91bG_nBPSECAHlYl5Zo3eEX9jPI2_Td-dS4YasibBb2UsV2Tpof0PfsA2h2NQhfAqoHrg26Vm1Br6LitLIU5YhkhVfh1saVvijb5Qr01FcScZShEoK-E_ZDqVcSXO_N7YizeApqqA";
        $msg = array
              (
                'body'  =>  "$activeProvider_firebase->not_gr" ,
                'title' =>  "$activeProvider_firebase->not_en",
                'receiver' => 'erw',
                'icon'  => "https://image.flaticon.com/icons/png/512/270/270014.png",/*Default Icon*/
                'sound' => 'mySound'/*Default sound*/
              );

        $fields = array
                (
                    'to'        => $token,
                    'notification'  => $msg
                );

        $headers = array
                (
                    'Authorization: key=' . $from,
                    'Content-Type: application/json'
                );
        //#Send Reponse To FireBase Server 
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );
        return redirect()->back();
    }
    public function blockedProviders(){
        $providers = User::with('package')->where('type','provider')->where('status','2')->get();
        return view('dashboard.provider.blocked-provider',compact('providers'));
    }
    public function detailsProvider ($provider_id){
        $provider = User::with('postal','images','licences.business','certificates')
        ->find($provider_id);
        $licences = BusinessProvider::where('provider_id',$provider_id)
        ->get();
        $tenders = Tender::where('user_id',$provider_id)->count();
        $interested = TenderInterested::where('provider_id',$provider_id)->where('status','interested')->count();
        $connecteds  = TenderInterested::where('provider_id',$provider_id)->where('status','connected')->count();
        $deals  = TenderInterested::where('provider_id',$provider_id)->where('status','deal')->count();
        $payments = Payment::where('user_id',$provider_id)->sum('payment');
        $send_offers = TenderInterested::with('user','tender')->where('provider_id',$provider_id)->get();
        // return $provider;
        return view('dashboard.provider.details-provider',compact('provider','tenders','interested','connecteds','deals','payments','send_offers','licences'));
    }
    public function Services(){
        $services =  ProviderService::all();
        return view('dashboard.provider.service',compact('services'));
    }
    public function addService(Request $request){
        $data = [
            'en' => [
                'service' => $request -> service_en,
            ],
            'de' => [
                'service' => $request -> service_gr,
            ],
        ];
        ProviderService::create($data);
        return redirect()->back()->withErrors('Provider services have been added successfully');
    }
    public function updateService(Request $request,$serv_id){
        $service = ProviderService::find($serv_id);
        $data = [
            'en' => [
                'service' => $request -> service_en,
            ],
            'de' => [
                'service' => $request -> service_gr,
            ],
        ];
        
        $service->update($data);
        return redirect()->back()->withErrors('Provider services have been successfully modified');
    }
    public function deleteService($serv_id){
        $service = ProviderService::find($serv_id)->delete();
        return redirect()->back()->withErrors('deleted successfully');
    }

    
}
