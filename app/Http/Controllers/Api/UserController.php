<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Password;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use App\Models\User;
    use Image;
    use JWTAuth;
    use Tymon\JWTAuth\Exceptions\JWTException;
    use Illuminate\Support\Facades\Validator;
    use App\Models\TenderInterested;
    use App\Models\ProviderImage;
    use App\Models\Review;
    use App\Models\Tender;
    use App\Models\Notification;
    use Illuminate\Support\Facades\Storage;
    use App\Models\WorkLicense;
    use App\Models\UserDevice;
    use Illuminate\Database\Eloquent\SoftDeletes;
class UserController extends Controller
{
    protected $user;

    public function myProfile(Request $request){
        $token   = JWTAuth::authenticate($request->token);
        $user_id = $token->id;
        $user         = User::with('certificates')->withCount('user_review')->find($user_id);
        $user_review  = Review::where('user_id',$user_id)->avg('rate');
        $tenders      = Tender::where('user_id',$user_id)->where('status','!=','Draft')->count();
        $interestings = TenderInterested::where('user_id',$user_id)->where('status','interested')->orwhere('provider_id',$user_id)->where('status','interested')->count();
        $deals        = TenderInterested::where('user_id',$user_id)->where('status','deal')->orwhere('provider_id',$user_id)->where('status','deal')->count();
        $last_deal    = TenderInterested::where('user_id',$user_id)->where('status','deal')->orwhere('provider_id',$user_id)->where('status','deal')->latest('id')->first();
        return response()->json([
            'user' =>$user,
            'user_reviews'=>$user_review,
            'tenders'=>$tenders,
            'interestings'=>$interestings,
            'deals'=>$deals,
            'last_deal'=>$last_deal
        ]);
    }
    public function editProfile(Request $request){
        $user = JWTAuth::authenticate($request->token);
        if ($user->email != $request->email) {
            $simular_email = User::where('email',$request->email)->get();
            if (count($simular_email) > 0) {
                return response()->json(['message' => 'email has taken']);
            }   
            $user->status = '0';
            $user->save();
        }
        if ($user->mobile != $request->mobile) {
            $simular_mobile = User::where('mobile',$request->mobile)->get();
            if (count($simular_mobile) > 0) {
                return response()->json(['message' => 'mobile has taken']);
            }   
        }
        $data = [ 
            'first_name'      => $request->first_name,
            'last_name'       => $request->last_name,
            'email'           => $request->email,
            'mobile'          => $request->mobile,
            'postal_code'     => $request->postal_code,
            'gender'          => $request->gender,
            'street_num'      => $request->street_num,
            'home_num'        => $request->home_num,
            'com_description' => $request->com_description,
            'work_range'      => $request->work_range,
            'company_name'    => $request->company_name,
            'Guarantee'       => $request->Guarantee
        ];
        $user->update($data);
        return response()->json([
            'status' => 200,
            'details'=> $user
        ]);
    }
    public function updatePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password'   => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => 'password doesnt matched','status' => 201], 201);
        }
        $user = JWTAuth::authenticate($request->token);
        $hashedPassword = $user->password;
        if (\Hash::check($request->old_password , $hashedPassword )) {
            $user->password = bcrypt($request->password);
            User::where( 'id' , $user->id)->update( array( 'password' =>  $user->password));
            return response()->json([
                'details' => 'password updated successfully',
                'status' => 200
            ],200);
        }else{
            return response()->json(['error' => 'old password doesnt matched','status' => 202], 202);
            
        }
    }
    public function deleteAccount(Request $request){
        $validator = Validator::make($request->all(), [
            'password'   => ['required'],
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => 'password doesnt matched','status' => 201], 201);
        }
        $token   = JWTAuth::authenticate($request->token);
        $user_id = $token->id;
        $user    = User::find($user_id);
        $hashedPassword = $user->password;

        if (\Hash::check($request->password , $hashedPassword )) {
            $user->delete();
            return response()->json([
                'details' => 'deleted successfully',
                'status' => 200
            ],200);
        }else{
            return response()->json(['error' => 'password doesnt matched','status' => 201], 201);
            
        }
        
    }
    public function refreshFB(Request $request){
        $user = JWTAuth::authenticate($request->token);
        $user->fb_token = $request->fb_token;
        $user->save();
        return response()->json('updated successfully');
    }
    public function forgetPassword() {
        $credentials = request()->validate(['email' => 'required|email']);
        $user = User::where('email',$credentials['email'])->first();
        if($user ==null){
            return response()->json('Email is not registered');
        }
        Password::sendResetLink($credentials);
        return response()->json(["msg" => 'Reset password link sent on your email id.']);
    }
    public function verifyCode(Request $request)
    {
        $email = $request->email;
        $code = $request->code;
        $user = User::where('email',$email)->where('deleted_at',null)->first();
        $user_info = UserDevice::where('user_id',$user->id)->first();
        if($user_info->code == $code){
            $user_info-> id_device = $request->id_device;
            $user_info->save();
            return response()->json([
                'details' => 'ok'
            ]);
        }else{
            return response()->json([
                'details' => 'Please check the code'
            ]);
        }
    }
    public function works_licenses(){
        $licenses = WorkLicense::all();
        return response()->json([
            'details' => $licenses
        ]);
    }
}
