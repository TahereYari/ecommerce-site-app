<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class requestProduct extends Model
{
    use HasFactory;
    const STATUSES = ['unreviewed', 'inreview', 'reviewed'];

    public function user()
    {
        return $this->belongsTo(User::class)->first();
    }
}
