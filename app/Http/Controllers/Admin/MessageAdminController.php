<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Messages;
use Illuminate\Http\Request;

class MessageAdminController extends Controller
{
    public function markAsRead($id)
    {
        $message = Messages::find($id);

        if ($message) {
            $message->read = true;
            $message->save();
            // return redirect()->back();
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error'], 404);
    }


    public function messageList() {
        $messages = Messages::orderBy('read', 'asc')  // ابتدا پیام‌های خوانده‌نشده
        ->orderBy('created_at', 'desc')  // سپس مرتب‌سازی بر اساس زمان ایجاد
        ->get();
   
        $unreadMessageCount = Messages::where('read', false)->count();
        return view('Admin.Messages.messageList',[
            'messages' => $messages,
            'unreadMessageCount' => $unreadMessageCount,
        ]);
    }
}
