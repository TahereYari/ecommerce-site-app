<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competiotion extends Model
{
    use HasFactory;
    protected $fillable  =['title','description'];

    public function competiotionsAnswers()
    {
        return $this->hasMany(CompetiotionsAnswer::class);
    }

    public function competiotionsWiners()
    {
        return $this->hasMany(CompetetionWiner::class);
    }
}
