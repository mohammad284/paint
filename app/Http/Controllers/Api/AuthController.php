<?php

namespace App\Http\Controllers\Api;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller;
    use Illuminate\Support\Facades\Auth;
    use App\Models\User;
    use App\Models\ProviderImage;
    use App\Models\Notification;
    use App\Models\Package;
    use App\Models\UserDevice;
    use App\Models\userWork;
    use App\Models\WorkLicense;
    use App\Models\BusinessProvider;
    use Validator;
    use Illuminate\Support\Str;
    use Image;
    use Illuminate\Support\Facades\Mail;
    use App\Mail\SendMailable;
    use App\Mail\CodeMail;
class AuthController extends Controller
{
    public $credentials ;
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register','verifyCode']]);
    }

    public function register(Request $request){
            
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'   => ['required', 'string', 'min:8', 'confirmed'],
            'mobile'     => ['required', 'unique:users','digits:10'],
        ]);
        if($request->type == 'provider'){
            $validator = Validator::make($request->all(), [
                'email'   => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'mobile'  => ['required', 'unique:users','digits:10'],
                'works'  => ['required'],
            ]);
            if($validator->fails()){
                $user = User::where('email',$request->email)->first();
                if($user == null ){
                }else{
                    return response()->json([
                        'status' => 200,
                        'details'=> 'email has taken'
                    ]);
                }
                $mobile = User::where('mobile',$request->mobile)->first();
                if($mobile == null){
                }else{
                    return response()->json([
                        'status' => 200,
                        'details'=> 'error entering phone number'
                    ]);
                }
            }
            
        }

        if($validator->fails()){
            $user = User::where('email',$request->email)->first();
            if($user == null ){
            }else{
                return response()->json([
                    'status' => 200,
                    'details'=> 'email has taken'
                ]);
            }
            $mobile = User::where('mobile',$request->mobile)->first();
            if($mobile == null){
            }else{
                return response()->json([
                    'status' => 200,
                    'details'=> 'mobile has taken'
                ]);
            }
        }
        $user =  User::create([
            'first_name'          => $request['first_name'],
            'last_name'           => $request['last_name'],
            'email'               => $request['email'],
            'mobile'              => $request['mobile'],
            'gender'              => $request['gender'], 
            'password'            => Hash::make($request['password']),
            'status'              => '0',
            'type'                => $request->type,
            'street_num'          => $request->street_num,
            'home_num'            => $request->home_num,
            'com_description'     => $request->com_description,
            'work_range'          => $request->work_range,
            'postal_code'         => $request->postal_code,
            'company_name'        => $request->company_name,
            'Legal_form'          => $request->Legal_form,
            'email_permission'    => '1',
            'Guarantee'           => $request->Guarantee
        ])->sendEmailVerificationNotification();
        
        // return $user;
        $user = User::where('email',$request->email)->first();
        if($user->type == 'provider'){

            $works = $request->works;
            foreach($works as $work) {
                $licenses = WorkLicense::where('business_id',$work)->pluck('id');
                    foreach ($licenses as $license){
                        BusinessProvider::insert( [
                            'business_id' => $work,
                            'work_license_id'=> $license,
                            'provider_id' => $user->id,
                            'status'      => '0',
                            'active'      => '0',
                        ]);
                    }
            }
            $image = new ProviderImage;
            $image->provider_id = $user->id;
            $image->save();
            
            $not = [
                'en' => [
                    'notification' => "Request ($user->email) to register as a service provider",
                ],
                'de' => [
                    'notification' => "Fordere ($user->email) an, sich als Dienstanbieter zu registrieren",
                ],
                'sender'  => $user->id,
                'reciver' => '1',
                'status'  => 0,
                'type' => 0
            ];
            Notification::create($not);
            $data = [
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'mobile'=>$request->mobile,
                'address'=>'',
            ];
    
            Mail::to($request->email)->send(new SendMailable($data));
        }else{
            $image = new ProviderImage;
            $image->provider_id = $user->id;
            $image->save();
            $not = [
                'en' => [
                    'notification' => "Request ($user->email) to register as a user",
                ],
                'de' => [
                    'notification' => "Fordern Sie ($user->email) an, sich als Benutzer zu registrieren",
                ],
                'sender'  => $user->id,
                'reciver' => '1',
                'status'  => 0,
                'type' => 0
            ];
            Notification::create($not);
        }
        
        return response()->json([
            'message' => 'please cheak your account',
            'user' => $user
        ], 200);

    }
    
    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);
        $token = auth()->guard('api')->attempt($credentials);

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 200);
        }
        $user = User::where('email',$request->email)->first();

        if($user->email_verified_at == null){
            return response()->json(['error' => 'please verify your email'], 200);
        }
        if($user->type == 'provider' && $user->status == '0'){
            return response()->json(['error' => 'please wait to admin accepted'], 200);
        }
        $user->fb_token = $request->fb_token;
        $user->save();
        return $this->respondWithToken($token);
    }
    
    protected function respondWithToken($token){
    
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 30,
            'user' => auth('api')->user()
        ]);
    }  

    public function refresh() {
        return  $this->respondWithToken(auth()->refresh());
    }

    public function logout(){
        auth()->logout();

        return response()->json(['message' => 'logout successfully']);
    }


}
