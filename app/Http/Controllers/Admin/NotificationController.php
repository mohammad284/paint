<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\NotificationText;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function notifications(){
        $all_not = Notification::where('admin_read',null)->update(array('admin_read' => '1'));
        $notifications = Notification::with('send','recive')->orderBy('created_at', 'desc')->paginate(100); 
        return view('dashboard.notification.notifications',compact('notifications'));
    }
    public function deleteNotification($not_id){
        $not = Notification::find($not_id)->delete();
        return redirect()->back()->withErrors('The notice has been removed successfully');
    }
    public function notificationText(){
        $all_texts = NotificationText:: all();
        return view('dashboard.notification.not-text',compact('all_texts'));
    }
    public function updateNotText(Request $request,$type_id){
        $text = NotificationText::find($type_id);
        $data = [
            'not_en' => $request->not_en,
            'not_gr' => $request->not_gr,
        ];
        $text->update($data);
        return redirect()->back()->withErrors('updated successfully');
    }
    public function addNotText(Request $request){
        $data = [
            'not_en' => $request->not_en,
            'not_gr' => $request->not_gr,
            'type' => $request->type,
        ];
        NotificationText::create($data);
        return redirect()->back()->withErrors('added successfully');
    }
}
