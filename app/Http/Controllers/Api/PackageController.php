<?php

namespace App\Http\Controllers\Api;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use App\Models\Tender;
    use App\Models\TypeWork;
    use App\Models\TenderInterested;
    use App\Models\Notification;
    use App\Models\User;
    use App\Models\NotificationText;
    use App\Models\Payment;
    use App\Models\Package;
class PackageController extends Controller
{
    public function allPackage(){
        $packages = Package::all();
        return response()->json([
            'status'  =>'200',
            'details' => $packages 
        ]);
    }
    public function subPackage(Request $request ){
        $user    = User::find($request->user_id);
        $package = Package::find($request->package_id);
        $user->package_id = $request->package_id;
        $user->rest_of_package = $user->rest_of_package + $package->name;
        $user->save();
        $payments = [
            'user_id'   => $user->id,
            'payment'   => $package->price,
            'package_id'=> $package->id
        ];
        Payment::create( $payments);
        $not_text = NotificationText::where('type','subPackage_not')->first();
        $not = [
            'en' => [
                'notification' => "($user->email) : $not_text->not_en ",
            ],
            'de' => [
                'notification' => "($user->email) : $not_text->not_gr",
            ],
            'sender'  => $user->id,
            'reciver' => '1',// admin email
            'status'  => 0,
            'type' => 0
        ];
        Notification::create($not);
        return response()->json([
            'details' => 'subscription successfully'
        ]);
    }
}
