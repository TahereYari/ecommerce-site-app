<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketMessages;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class TicketController extends Controller
{
    public function insertTicket(Request $request) {
    
            $openTicket = Ticket::where('status','0')->where('user_id',auth()->user()->id)->first();
    
            if ($openTicket) {
                $message = new TicketMessages();
                $message->user_id = auth()->user()->id;
            
                $message->ticket_id = $openTicket->id;
                $message->message = $request->message;
                $message->file = $request->file;
                $message->save();
            } else {
                $ticket = new Ticket();
                $ticket->user_id = auth()->user()->id;
                $ticket->save();
                $ticket_id = $ticket->id;
        
                $message = new TicketMessages();
                $message->user_id = auth()->user()->id; 
                $message->ticket_id = $ticket_id;
                $message->message = $request->message;
                $message->file = $request->file;
                $message->save();
            }
            
        
            return redirect()->back();
        
       
    }


    public function closeTicket($id) {
        $ticket = Ticket::where('id',$id)->where('user_id',auth()->user()->id)->first();
        $ticket->status = 1;
        $ticket->save();

        return redirect()->back();
    }


    public function allTickets() {
        $tickets = Ticket::where('user_id',auth()->user()->id)->get();

        // return redirect(route(''));
    }

    public function ticketView($id) {
        $tickettMessages = TicketMessages::where('ticket_id',$id)->get();
        return view('Front.User.ticketView',[
            'tickettMessages' => $tickettMessages
        ]);
    }




    
}
