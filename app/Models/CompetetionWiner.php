<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetetionWiner extends Model
{
    use HasFactory;
    public function competetion()
    {
        return $this->belongsTo(Competiotion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
