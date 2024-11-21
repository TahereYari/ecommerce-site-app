<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketMessages extends Model
{
    use HasFactory;
    protected $fillable=['user_id','ticket_id','message','file'];

    public function Ticket() {
        return $this->belongsTo(Ticket::class)->first();
    }

     public function user() {
        return $this->belongsTo(User::class)->first();
     }
}
