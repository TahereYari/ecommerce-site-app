<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetiotionsAnswer extends Model
{
    use HasFactory;
    protected $fillable  =['user_id','competiotion_id','answer','file'];

    public function competiotion()
    {
        return $this->belongsTo(Competiotion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
