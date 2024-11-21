<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketMessages;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    public function ticketList() {
        $openTickets = Ticket::where('status',0)->get();
        $closeTickets = Ticket::where('status',1)->get();

        return view('Admin.Ticket.ticketList',[
            'openTickets' =>$openTickets,
            'closeTickets' =>$closeTickets,
        ]);

    }


    public function ticketMessages($id)  {
        $ticketMessages = TicketMessages::where('ticket_id',$id)->orderBy('created_at','desc')->get();
        $ticket = Ticket::where('id',$id)->first();

        return view('Admin.Ticket.ticketMessages',[
            'ticketMessages' =>$ticketMessages,
            'ticket' =>$ticket,
        ]);
    }


    public function markAsRead($id)
    {
        $message = TicketMessages::find($id);

        if ($message) {
            $message->read = true;
            $message->save();
            // return redirect()->back();
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error'], 404);
    }


    public function insertTicket(Request $request) {
    
        // $openTicket = Ticket::where('id',$id)->first();

        $message = new TicketMessages();
        $message->user_id = auth()->user()->id; 
        $message->ticket_id = $request->ticketId;
        $message->message = $request->message;
     
        $message->save();
    
        return redirect()->back();
    
   
}
}
